<?php
/**
 * SGS Module: Example
 * File: menu_example.php
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
if(!defined('SGS_INIT')){ exit; }

/**
 * load example prefs
 */
$prefs = Site_Modules::loadPrefs('example');

/**
 * load language file
 */
if(is_file(Configuration::get('module_path').'example/language/'.LOCALE.'_language.php')){
	Site_Language::loadLanguageFile(Configuration::get('module_path').'example/language/'.LOCALE.'_language.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('module_path').'example/language/en_language.php');
}

/**
 * load example functions
 */

 require_once(Configuration::get('module_path').'example/functions.php');

/**
 * load example data
 */

$data = readExample();


if(isset($prefs['example_caption']) && $prefs['example_caption'] !=''){
	$caption = $prefs['example_caption'];
}else{
	$caption = Site_Language::display('example_menu_caption');
}

if(isset($data['example_text']) && $data['example_text'] !=''){
	$text = stripslashes($data['example_text']);
}else{
	$text = Site_Language::display('example_menu_text');
}

echo Site_Parse::render_content($caption, $text,'example');

?>