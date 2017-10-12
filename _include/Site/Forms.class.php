<?php
/**
 * Site Forms
 *
 * Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Class Site Forms.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

if(!defined('SGS_INIT')){ exit; }

class Site_Forms {
		/**
		 * form
		 * @var string $form
		 */
		public static $form;

		/**
		 * opened
		 * @var bool $opend
		 */
		public static $opened;


		/**
		 * start_form
		 *
		 * Start a new form element
		 *
		 * @param string $id      required - form ID
		 * @param string $action  required - URI
		 * @param string $method  optional - default post
		 * @param string $enctype optional - NULL
		 * @param string $class   optional - NULL
		 *
		 */
		public static function start_form($id, $action, $method='post', $enctype='', $class='')
		{
			self::$form = "\n".'<form id="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').' method="'.$method.'" action="'.$action.'"'.($enctype !='' ? ' enctype="'.$enctype.'"':'').'>'."\n";
			self::$opened = true;
		}

		/*
		 * add_select_item
		 *
		 * Generate a select list
		 *
		 * @param string $id required - ID and name of select field
		 * @param array $items required - array of select items. Examples: array('value1','value2'); OR array(array('value1'=>'label1'),array('value2'=>'label2'));
		 * @param string $selected required
		 * @param string $label optional - will generate a label for the select list if passed
		 * @param string $class optional - will assign a css class to the select list
		 * @param bool $disable optional - TRUE disable default FALSE
		 */
		public static function add_select_item($id, $items, $selected, $label='', $class='',$disable=FALSE,$js='')
		{
			$id = strtolower($id);

			self::$form .= ($label != '' ? '<label for="'.$id.'">'.ucfirst($label).'</label>' : '')."\n".' <select id="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').($disable ==TRUE ? ' disabled="disabled"':'').' name="'.$id.'"'.($js !='' ? $js :'').'>'."\n\n";
			foreach ($items as $item) {
				if(is_array($item)){

					$key = array_keys($item);
					$value = $key[0];
					$label =$item[$value];
				}else{
					$value = $item;
					$label = $item;
				}
				self::$form .= '<option value="'.$value.'"'.(strtolower($value) == strtolower($selected) ? ' selected="selected"' : '').'>'.ucfirst($label).'</option>'."\n";
			}
			self::$form .= "</select>\n\n";
		}

		/**
		 * add_check_box
		 *
		 * Generate a check box elements
		 *
		 * @param string $id      ID and name of select field
		 * @param array $items    array of select items. Examples: array('value1','value2');
		 * @param string $checked the selected value 
		 * @param string $label   will generate a label for the checkbox group if passed
		 * @param string $class   will assign a css class to each checkbox
		 */

		public static function add_check_box($id, $items, $checked, $label='', $class='',$disable=FALSE)
		{
			$id = strtolower($id);
			self::$form .= ($label != '' ? '<label for="'.$id.'">'.$label.'</label>' : '')."\n\n\n";

			if(is_array($checked)){
				$checkval = array_flip($checked);
			}else{
				$checkval = array($checked=>$checked);
			}

			foreach ($items as $item)
			{

				$name = ((count($items) > 1) ? $id.'[]' : $id);
				$value = $item;
				$label = ((count($items) > 1) ? $item : '');
				if(is_array($checkval) && array_key_exists($value,$checkval)){
					$checked = 'checked="1"';
				}else{
					$checked = '';
				}
				self::$form .= '<input id="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').($disable ==TRUE ? ' disabled="disabled"':'').' name="'.$name.'" type="checkbox" value="'.$value.'"'.$checked.' /> '.ucfirst($label)."\n";
			}

		}

		/**
		 * add_input_data
		 *
		 * Generate a text input field
		 *
		 * @param string $id     ID and name of input field
		 * @param string $value  default empty
		 * @param string $label  will generate a label for the input field
		 * @param string $class  will assign a css class to the input field
		 * @param int $maxlength will assign max char length of the field
		 */

		public static function add_input_data($id, $value='', $label='', $class='', $maxlength='',$disable=FALSE,$js='')
		{
			self::$form .= ($label != '' ? '<label for="'.$id.'">'.ucfirst($label).'</label>' : '')."\n".'<input id="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').' type="text" name="'.$id.'" value="'.$value.'" '.($maxlength !='' ? 'maxlength="'.$maxlength.'" ' : '').($disable ==TRUE ? ' disabled="disabled"':'').($js !='' ? ' '.$js : '').'/>'."\n\n";
		}

		/**
		 * add_private_data
		 *
		 * Generate a pass protected input field
		 *
		 * @param string $id    ID and name of input field
		 * @param string $value default empty
		 * @param string $label will generate a label for the input field
		 * @param string $class will assign a css class to the input field
		 */
		public static function add_private_data($id, $value, $label='', $class='')
		{
			self::$form .= ($label != '' ? '<label for="'.$id.'">'.ucfirst($label).'</label>' : '')."\n".' <input id="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').' type="password" name="'.$id.'" value="'.$value.'" />'."\n\n";
		}

		/**
		 * add_file_data
		 * Generate a file input field
		 *
		 * @param string $id    ID of input field
		 * @param string $name  name of input field
		 * @param string $label will generate a label for the input field
		 * @param string $class will assign a css class to the input field
		 */

		 public static function add_file_data($id, $name, $label='',$class='')
		 {
		 	self::$form .= ($label != '' ? '<label for="'.$id.'">'.ucfirst($label).'</label>' : '')."\n".' <input id="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').' name="'.$name.'" type="file" />';
		 }


		/**
		 * add_text_data
		 *
		 * Generate a textarea field
		 *
		 * @param string $id    ID and name of textarea field
		 * @param string $value default empty
		 * @param string $label will generate a label for the textarea field
		 * @param string $class will assign a css class to the textarea field
		 */

		public static function add_text_data($id, $value, $label='', $class='', $rows='20',$cols='50')
		{
			self::$form .= ($label != '' ? '<label for="'.$id.'">'.ucfirst($label).'</label>' : '')."\n".' <textarea id="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').' name="'.$id.'" rows="'.$rows.'" cols="'.$cols.'">'.$value.'</textarea>'."\n\n";
		}

		/**
		 * add_button
		 *
		 * Generate an input button
		 *
		 * @param string $id required ID of button
		 * @param string $value required - display text
		 * @param string $type optional - default submit will generate a submit button
		 * @param string $class optional - will assign a css class to the input button
		 */

		public static function add_button($id, $value, $type = "submit", $class='')
		{
			$value = ucfirst($value);
			self::$form .= ' <input id="'.$id.'" name="'.$id.'"'.($class != '' ? ' class="'.$class.'"' : '').' type="'.$type.'" value="'.$value.'" />'."\n";
		}

		/**
		 * add_hidden_data
		 * Generate a hidden input field
		 *
		 * @param string $id    required ID and name of input field
		 * @param string $value required field value
		 *
		 */

		public static function add_hidden_data($id, $value,$label='')
		{

			self::$form .= ($label != '' ? '<label for="'.$id.'">'.$label.' '.$value.'</label>' : '')."\n";
			self::$form .= '<input id="'.$id.'" type="hidden" name="'.$id.'" value="'.$value.'" />'."\n";
		}

		/**
		 * add_plain_html
		 * Add html into the current form
		 *
		 * @param string $html_data required - html source
		 *
		 */

		public static function add_plain_html($html_data)
		{
			self::$form .= $html_data;
		}

		/**
		 * return_form
		 * @param none return the for for output to screen
		 */

		public static function return_form()
		{
			if(self::$opened == true) {
				self::$form .= '</form>'."\n";
				self::$opened = false;
			}
			
			return self::$form;
		}

}
?>