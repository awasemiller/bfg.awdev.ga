<?php
/**
 * SGS Admin Area Custom pages
 * File: custompage.php
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
require_once('../core_gamesite.php');
Site_Parse::page_start();

if(!SGS_ADMIN){
	Site_Admin::adminLogin();
	Site_Parse::page_end();
	exit;
}

if(is_file(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_custompage.php')){
	Site_Language::loadLanguageFile(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_custompage.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('language_path').'en/admin/en_custompage.php');
}
	$options = array(
		array('query'=>'default','text'=>Site_Language::display('custompage_opt_default')),
		array('query'=>'view','text'=>Site_Language::display('custompage_opt_view')),
		array('query'=>'create','text'=>Site_Language::display('custompage_opt_new')),
		array('query'=>'edit','text'=>Site_Language::display('custompage_opt_edit'),'nolink'=>true)
		);

	$custompages = array();
	$custompage = array();
	$custompage['filename'] = '';
	$custompage['caption'] = '';
	$custompage['content'] = '';
	$custompage['allow_comments'] = '';

	$message = array();
	$error = FALSE;

	/** retrieve the list of current pages */
	$existing = Site_CustomPage::getCustompages();

	/** create new page method */
	if(isset($_POST['create'])){

		$file['filename'] = isset($_POST['filename']) ? $_POST['filename'] : Site_Language::display('custompage_file_new');
		$file['filename'] = str_replace(' ','-',$file['filename']);

		if(Site_CustomPage::checkPage($_POST['tmplocale'].'_'.$file['filename'].'.page')){
			$message[] = Site_Language::display('custompage_msg_file_exists');
			$error = TRUE;
		}else{
			$data = array('filename'=>$file['filename'],'caption'=>$_POST['caption'],'content'=>$_POST['content'],'author'=>isset($_POST['author']) ? $_POST['author'] : SGS_USERNAME,'allow_comments'=>isset($_POST['allow_comments']) ? $_POST['allow_comments'] : '','date'=>isset($_POST['date']) ? $_POST['date'] : '','locale'=>isset($_POST['tmplocale']) ? $_POST['tmplocale'] : '');
			$data = serialize($data);

			if(Site_CustomPage::writePage($data,$_POST['tmplocale'].'_'.$file['filename'].'.page')){
				$message[] = str_replace('{FILENAME}',$file['filename'],Site_Language::display('custompage_msg_file_created'));
				$error = FALSE;
			}else{
				$message[] = str_replace('{FILENAME}',$file['filename'],Site_Language::display('custompage_msg_unable_to_write'));
				$error = TRUE;
			}
		}

		$text = Site_Admin::messages($message);

		if($error == FALSE){
			$text .= '<p>'.Site_Elements::anchorTag('?view', 'Continue', '','button','','','').'</p>';

			Site_Admin::renderAdmin($options,$text);
			exit;
		}
	}

	/**
	 *  Delete page method
	 */
	if(isset($_GET['delete'])){


		if(!isset($_GET['confirm'])){

			$text = '<p>'.str_replace('{FILENAME}',$_GET['delete'],Site_Language::display('custompage_msg_confirm_delete')).'<br /> '.Site_Elements::anchorTag('?delete='.$_GET['delete'].'&amp;tmplocale='.$_GET['tmplocale'].'&amp;confirm', Site_Language::display('custompage_btn_confirm'), '','button','','','').'</p>';

			Site_Admin::renderAdmin($options,$text);

			exit;
		}

		if(Site_CustomPage::deletePage($_GET['tmplocale'].'_'.$_GET['delete'].'.page')){
			$message[] = str_replace('{FILENAME}',$_GET['delete'],Site_Language::display('custompage_msg_file_deleted'));
			$error = FALSE;
		}else{
			$message[] = str_replace('{FILENAME}',$_GET['delete'],Site_Language::display('custompage_msg_unable_to_delete'));
			$error = TRUE;
		}

		$text = Site_Admin::messages($message);

		if(isset($_POST['tmplocale']) && in_array($_POST['tmplocale'], array_values(Site_Language::$locales))){
			// destroy locale cookie to set default language
			setcookie('locale', $_POST['locale'], (time() - 3600),'/');
		}

		$text .= '<p>'.Site_Elements::anchorTag('?view', Site_Language::display('custompage_btn_continue'), '','button','','','').'</p>';
		Site_Admin::renderAdmin($options,$text);
		exit;

	}

	/**
	 * Update page method
	 */
	if(isset($_POST['update'])){

		$date = array('filename'=>$_POST['filename'],'caption'=>$_POST['caption'],'content'=>$_POST['content'],'description'=>$_POST['description'],'keywords'=>$_POST['keywords'],'author'=>isset($_POST['author']) ? $_POST['author'] : SGS_USERNAME,'allow_comments'=>isset($_POST['allow_comments']) ? $_POST['allow_comments'] : '','date'=>isset($_POST['date']) ? $_POST['date'] : '','locale'=>isset($_POST['tmplocale']) ? $_POST['tmplocale'] : '');
		$date = serialize($date);

		if(Site_CustomPage::writePage($date,$_POST['tmplocale'].'_'.$_POST['filename'].'.page')){
			$message[] = str_replace('{FILENAME}',$_POST['filename'],Site_Language::display('custompage_msg_file_saved'));
			$error = FALSE;
		}else{
			$message[] = str_replace('{FILENAME}',$_POST['filename'],Site_Language::display('custompage_msg_error_saving'));
			$error = TRUE;
		}

		$text = Site_Admin::messages($message);
		$text .= '<p>'.Site_Elements::anchorTag('?view', 'Continue', '','button','','','').'</p>';
		Site_Admin::renderAdmin($options,$text);
		exit;
	}

	/**
	 * edit page method
	 */
	if(isset($_GET['edit']) || isset($_GET['create'])){

		$file['filename'] = isset($_GET['edit']) ? $_GET['edit'] : Site_Language::display('custompage_file_new');

		if(isset($_GET['edit'])){
			if(Site_CustomPage::checkPage($_GET['tmplocale'].'_'.$file['filename'].'.page')){
				$file = file_get_contents(Configuration::get('custom_path').$_GET['tmplocale'].'_'.$file['filename'].'.page');
				$file =	unserialize($file);

			}else{

				$message[] = str_replace('{FILENAME}',$_GET['edit'],Site_Language::display('custompage_msg_unable_to_edit'));
				$error = TRUE;
				unset($_GET['edit']);
			}
		}

		/**
		 * check for values, if they do not exist we'll assign default ones here
		 * filename should have been set above
		 */
		$file['filename'] = isset($file['filename']) ? $file['filename'] : Site_Language::display('custompage_file_new');
		$file['caption'] = isset($file['caption']) ? $file['caption'] : Site_Language::display('custompage_file_caption');
		$file['content'] = isset($file['content']) ? $file['content'] : Site_Language::display('custompage_file_content');
		$file['description'] = isset($file['description']) ? $file['description'] : Site_Language::display('custompage_file_meta_desc');
		$file['keywords'] = isset($file['keywords']) ? $file['keywords'] : Site_Language::display('custompage_file_meta_key');

	 	$file['author'] = isset($file['author']) ? $file['author'] : SGS_USERNAME;
	 	$file['allow_comments'] = isset($file['allow_comments']) ? $file['allow_comments'] : '';
	 	$file['date'] = isset($file['date']) ? $file['date'] : time();

	 	// check for locale removed
	  	// $file['locale'] = isset($file['locale']) ? $file['locale'] : LOCALE;

		$text = Site_Admin::messages($message);
		/**
		 * start form
		 */
		Site_Forms::start_form('custompage', SGS_SELF.'?'.SGS_QUERY, 'post');
		Site_Forms::add_plain_html('<table '.(defined('TABLE_CLASS') ? 'class="'.TABLE_CLASS.'"' : '').' cellpadding="0" cellspaceing="0">');

		/**
		 * check to see if we are editing an existing file or creating a new one
		 */
		if(isset($_GET['edit'])){
			/** if edit user cannot change the file name */
			Site_Forms::add_plain_html('<tr><td>');

			Site_Forms::add_hidden_data('filename', $file['filename'],Site_Language::display('custompage_label_name'));
		}else{
			Site_Forms::add_plain_html('<tr><td>');
			Site_Forms::add_input_data('filename', (isset($_POST['filename']) ? stripslashes($_POST['filename']) : stripslashes($file['filename'])), Site_Language::display('custompage_label_name'), 'textbox');
		}

		Site_Forms::add_plain_html('</td></tr><tr><td>');

		/** caption */
		Site_Forms::add_input_data('caption', (isset($_POST['caption']) ? stripslashes($_POST['caption']) : stripslashes($file['caption'])), Site_Language::display('custompage_label_caption'), 'textbox');
		Site_Forms::add_plain_html('</td></tr><tr><td>');

		/** content */
		Site_Forms::add_text_data('content', (isset($_POST['content']) ? stripslashes($_POST['content']) : stripslashes($file['content'])), Site_Language::display('custompage_label_content'), 'textbox');
		Site_Forms::add_plain_html('</td></tr><tr><td>');
		
		foreach(Site_Language::$locales as $key=>$value){
			$select[] = array($value=>Site_Language::display($value));
		}
	
		Site_Forms::add_select_item('tmplocale', $select, isset($_POST['tmplocale']) ? $_POST['tmplocale'] : (isset($file['locale']) ? $file['locale'] : Configuration::get('locale')), Site_Language::display('custompage_label_default_language'), 'textbox');
		Site_Forms::add_plain_html('</td></tr><tr><td>');

		/** description */
		Site_Forms::add_input_data('description', (isset($_POST['description']) ? stripslashes($_POST['description']) : stripslashes($file['description'])), Site_Language::display('custompage_label_meta_desc'), 'textbox');
		Site_Forms::add_plain_html('</td></tr><tr><td>');
		/** keywords */
		Site_Forms::add_input_data('keywords', (isset($_POST['keywords']) ? stripslashes($_POST['keywords']) : stripslashes($file['keywords'])), Site_Language::display('custompage_label_meta_key'), 'textbox');
		Site_Forms::add_plain_html('</td></tr><tr><td>');
		/** author */
		Site_Forms::add_hidden_data('author', isset($_POST['author']) ? $_POST['author'] : $file['author']);
		/** allow comments */

		Site_Forms::add_check_box('allow_comments', array(1),(isset($_POST['allow_comments']) ? $_POST['allow_comments'] : isset($file['allow_comments']) ? $file['allow_comments'] : ''),Site_Language::display('custompage_label_allow_comments'),($siteconfig['sitecomments'] == false ? 'textbox-disable' : 'textbox'),($siteconfig['sitecomments'] == false ? TRUE : FALSE));

		if($siteconfig['sitecomments'] == false){
			Site_Forms::add_plain_html(str_replace('{LINK}',Configuration::get('admin_base_url'),Site_Language::display('custompage_msg_comments_disabled')));
		}

		Site_Forms::add_plain_html('</td></tr><tr '.(defined('TABLE_FOOTER_CLASS') ? 'class="'.TABLE_FOOTER_CLASS.'"' : '').' cellpadding="0" cellspaceing="0"><td>');
		/** file date */
		Site_Forms::add_hidden_data('date', isset($_POST['date']) ? $_POST['date'] : isset($file['date']) ? $file['date'] : time());

		if(isset($_GET['edit'])){
			Site_Forms::add_hidden_data('update', 'true');
		}else{
			Site_Forms::add_hidden_data('create', 'true');
		}
		Site_Forms::add_button('submit', Site_Language::display('custompage_btn_submit'), 'submit', 'button');
		Site_Forms::add_plain_html('</td></tr></table>');

		$text .= Site_Forms::return_form();

		Site_Admin::renderAdmin($options,$text);
		exit;
	}

	/**
	 * default view pages
	 */
	if(!SGS_QUERY || isset($_GET['view'])){
		if(count($existing) >=1){
			$text = '<table '.(defined('TABLE_CLASS') ? 'class="'.TABLE_CLASS.'"' : '').' cellpadding="0" cellspaceing="0">
						<tr>
							<th '.(defined('TABLE_CLASS') ? 'class="'.TABLE_HEADER_CLASS.'"' : '').' style="width:50%">'.Site_Language::display('custompage_th_pages').'</th>
							<th '.(defined('TABLE_CLASS') ? 'class="'.TABLE_HEADER_CLASS.'"' : '').' style="width:50%">'.Site_Language::display('custompage_th_options').'</th>
							<th '.(defined('TABLE_CLASS') ? 'class="'.TABLE_HEADER_CLASS.'"' : '').' style="width:50%">'.Site_Language::display('custompage_th_lang').'</th>
								</tr>';

			if(defined('ODD_CLASS') && defined('EVON_CLASS')){
				$class = EVON_CLASS;
				$evon = EVON_CLASS;
				$odd = ODD_CLASS;
			}else{
				$class = 'evon';
				$evon = 'evon';
				$odd = 'odd';
			}

			foreach($existing as $page){

				$class = ($class == $odd ? $evon : $odd);
				$pagename = Site_CustomPage::cleanPageName($page);
				$page = explode('_', $page);



/*
 *
 * $pagename = Site_CustomPage::cleanPageName($page);
 */

				$text .= '<tr '.($class !='' ? 'class="'.$class.'"': '').'>
							<td style="width:33%"> '.Site_Elements::anchorTag(SGS_BASE_URL.'page.php?id='.$page[1].'&amp;tmplocale='.$page[0], $pagename, '','','',$pagename,'').'</td>
							<td style="width:33%">'.Site_Elements::anchorTag('?edit='.$page[1].'&amp;tmplocale='.$page[0], 'Edit').' '.Site_Elements::anchorTag('?delete='.$page[1].'&amp;tmplocale='.$page[0], 'Delete').'</td>
							<td style="width:33%">'.Site_Elements::imageTag(SGS_BASE_URL.'images/flags/'.$page[0].'.gif').'</td>
						</tr>';
			}
			$text .='</table>';
		}else{
			$text = '<p>'.Site_Language::display('custompage_msg_no_pages').' '.Site_Elements::anchorTag('?create', Site_Language::display('custompage_msg_create_new'), '','','','','').'</p>';
		}

		Site_Admin::renderAdmin($options,$text);
		exit;
	}

Site_Admin::renderAdmin($options,$text);
?>