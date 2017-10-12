<?php
/**
 * SGS Module: Browse
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
if(is_file(Configuration::get('module_path').'browse/language/'.LOCALE.'_language.php')){
	Site_Language::loadLanguageFile(Configuration::get('module_path').'browse/language/'.LOCALE.'_language.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('module_path').'browse/language/en_language.php');
}

/**
 * default query
 */
$query ='prefs2';

/**
 * load functions file and data
 */

require_once(Configuration::get('module_path').'browse/functions.php');

/**
 * options nav
 */
$options = array(
	array('query'=>'default','text'=>Site_Language::display('browse_admin_options_default')),
	array('query'=>'prefs','text'=>Site_Language::display('browse_admin_options_prefs'))
	);

/**
 * error messages
 */
$message = '';

	/**
	 * browse_prefs save process from pref_form
	 */
	if(isset($_POST['browse_prefs'])){

		foreach($_POST as $key => $value){
			/**
			 * clean your post values here
			 */
			$tmp[$key] = $value;
		}

		/**
		 * build your storage array
		 */
		$browseData = array('browse_caption'=>$tmp['browse_caption']);

		/**
		 * write pref data and display messages
		 */
		 if(Site_Modules::savePrefs('browse',$browseData)){
				$message[] = Site_Language::display('browse_prefs_saved');
				$error = FALSE;
		 }else{
				$message[] = Site_Language::display('browse_prefs_failed');
				$error = FALSE;
		 }
	}

	/**
	 * Display Messages
	 */
	$text = Site_Admin::messages($message);


	/**
	 * load module prefs
	 */
	$prefs = Site_Modules::loadPrefs('browse');

	/**
	 * browse prefs form
	 */
	if(!SGS_QUERY || isset($_GET['prefs'])){

		/**
		 * start form
		 */
		Site_Forms::start_form('browse_form', SGS_SELF.'?'.SGS_QUERY, 'post');
		Site_Forms::add_plain_html('<table>');

		/**
		 * text box
		 */
		Site_Forms::add_plain_html('<tr><td>');
		Site_Forms::add_input_data('browse_caption', (isset($prefs['browse_caption']) ? stripslashes(htmlentities($prefs['browse_caption'])) : ''), Site_Language::display('browse_pref_input_label').':', "textbox");
		Site_Forms::add_plain_html('</td></tr>');

		/**
		 * submit button
		 */
		Site_Forms::add_plain_html('<tr><td>');

		Site_Forms::add_hidden_data('browse_prefs', 'true');
		Site_Forms::add_button('submit', Site_Language::display('browse_forms_submit'), 'submit', 'button');
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