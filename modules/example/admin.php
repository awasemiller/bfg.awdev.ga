<?php
/**
 * SGS Module: Example
 * File: admin.php
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
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package PNP Tools
 * @subpackage SGS
 *
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */
require_once('../../core_gamesite.php');
Site_PageCache::$cacheable = false;
Site_Parse::page_start();
	/**
	 * set admin display mode if it is not already set
	 */
	if(!defined('ADMINDISPLAY')){
		define('ADMINDISPLAY',TRUE);
	}

	/**
	 * security
	 */
	if(!SGS_ADMIN){
		Site_Admin::adminLogin();
		Site_Parse::page_end();
		exit;
	}

	/**
	 * load language file
	 */
	if(is_file(Configuration::get('module_path').'example/language/'.LOCALE.'_language.php')){
		Site_Language::loadLanguageFile(Configuration::get('module_path').'example/language/'.LOCALE.'_language.php');
	}else{
		Site_Language::loadLanguageFile(Configuration::get('module_path').'example/language/en_language.php');
	}

	/**
	 * Default query
	 */
	$query ='prefs';

	/**
	 * load functions file and data
	 */
	require_once(Configuration::get('module_path').'example/functions.php');

	/**
	 * options nav
	 */
	$options = array(
		array('query'=>'default','text'=>Site_Language::display('example_admin_options_default')),
		array('query'=>'prefs','text'=>Site_Language::display('example_admin_options_prefs')),
		array('query'=>'data','text'=>Site_Language::display('example_admin_options_data'))
		);

	/**
	 * error messages
	 */
	$message = '';

	/**
	 * example_prefs save process from pref_form
	 */
	if(isset($_POST['example_prefs'])){

		foreach($_POST as $key => $value){
			/**
			 * clean your post values here
			 */
			$tmp[$key] = $value;
		}

		/**
		 * build your storage array
		 */
		$exampleData = array('example_item'=>$tmp['example_item'],'example_caption'=>$tmp['example_caption']);

		/**
		 * write pref data and display messages
		 */
		 if(Site_Modules::savePrefs('example',$exampleData)){
				$message[] = Site_Language::display('example_prefs_saved');
				$error = FALSE;
		 }else{
				$message[] = Site_Language::display('example_prefs_failed');
				$error = FALSE;
		 }
	}

	/**
	 * example_data save process from data_form
	 */
	if(isset($_POST['example_data'])){

		foreach($_POST as $key => $value){
			/**
			 * clean your post values here
			 */
			$tmp[$key] = $value;
		}

		/**
		 * build your storage array
		 */
		$exampleData = array('example_text'=>$tmp['example_text']);

		/**
		 * write data and display messages
		 */
		 if(writeExample($exampleData)){
				$message[] = Site_Language::display('example_prefs_saved');
				$error = FALSE;
		 }else{
				$message[] = Site_Language::display('example_data_failed');
				$error = FALSE;
		 }
	}

	/**
	 * Display Messages
	 */
	$text = Site_Admin::messages($message);



	if(!SGS_QUERY){

		$text = '<p>This is an example module which can be use to create your own custom modules.</p>';
		$text .='<p>Please select a link from the options menu on the right.</p>';
	}

	/**
	 * example prefs form
	 */
	if(isset($_GET['prefs'])){

		/**
		 * load module prefs
		 */

		$prefs = Site_Modules::loadPrefs('example');

		/**
		 * start form
		 */
		Site_Forms::start_form('pref_form', SGS_SELF.'?'.SGS_QUERY, 'post');
		Site_Forms::add_plain_html('<table>');

		/**
		 * select items
		 */
		$items = array(
					array(''=>Site_Language::display('example_pref_item_0')),
					array('value1'=>Site_Language::display('example_pref_item_1')),
					array('value2'=>Site_Language::display('example_pref_item_2')),
					array('value3'=>Site_Language::display('example_pref_item_3'))
				);

		/**
		 * select box
		 */
		Site_Forms::add_plain_html('<tr><td>');
		Site_Forms::add_select_item('example_item', $items, isset($prefs['example_item']) ? stripslashes(htmlentities($prefs['example_item'])) : '', Site_Language::display('example_pref_select_label').':',  'textbox','','');
		Site_Forms::add_plain_html('</td></tr>');

		/**
		 * text box
		 */
		Site_Forms::add_plain_html('<tr><td>');

		Site_Forms::add_input_data('example_caption', isset($prefs['example_caption']) ? stripslashes(htmlentities($prefs['example_caption'])) : '', Site_Language::display('example_pref_input_label'), "textbox", '50');

		Site_Forms::add_plain_html('</td></tr>');

		/**
		 * submit button
		 */
		Site_Forms::add_plain_html('<tr><td>');
		Site_Forms::add_hidden_data('example_prefs', 'true');
		Site_Forms::add_button('submit', Site_Language::display('example_forms_submit'),'submit', 'button');
		Site_Forms::add_plain_html('</td></tr></table>');

		/**
		 * close form
		 */
		$text .= Site_Forms::return_form();
	}


	if(isset($_GET['data'])){

		/**
		 * Load Data file
		 */
		$data = readExample();

		/**
		 * start form
		 */
		Site_Forms::start_form('data_form', SGS_SELF.'?'.SGS_QUERY, 'post');
		Site_Forms::add_plain_html('<table>');

		/**
		 * text box
		 */
		Site_Forms::add_plain_html('<tr><td>');
		Site_Forms::add_text_data('example_text', (isset($_POST['example_text']) ? stripslashes(htmlentities($_POST['example_text'])) : stripslashes(htmlentities($data['example_text']))), Site_Language::display('example_data_text_label').':', 'textbox');
		Site_Forms::add_plain_html('</td></tr>');

		/**
		 * submit button
		 */
		Site_Forms::add_plain_html('<tr><td>');
		Site_Forms::add_hidden_data('example_data', 'true');
		Site_Forms::add_button('submit', Site_Language::display('example_forms_submit'), 'submit', 'button');
		Site_Forms::add_plain_html('</td></tr></table>');

		/**
		 * close form
		 */
		$text .= Site_Forms::return_form();
	}

	/**
	 * render page
	 */
	Site_Admin::renderAdmin($options,$text);
?>