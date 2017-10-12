<?php
/**
 * SGS Module: search
 * File: menu_search.php
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

if(is_file(Configuration::get('module_path').'search/language/'.LOCALE.'_language.php')){
	Site_Language::loadLanguageFile(Configuration::get('module_path').'search/language/'.LOCALE.'_language.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('module_path').'search/language/en_language.php');
}
/**
if(SGS_PAGE =='news.php'){
	$searchType = 'news';
}else if(SGS_PAGE =='page.php'){
	$searchType = 'pages';
}else{
	$searchType = 'games';
}
*/
$caption = Site_Language::display('menu_search_caption');
Site_Forms::start_form('searchFormMenu', SGS_BASE_URL.'search.php', 'post');
Site_Forms::add_plain_html('<p>');
Site_Forms::add_input_data('search', isset($_POST['search']) ? $_POST['search'] : (isset($_GET['search']) ? $_GET['search'] : ''), $label='', 'textbox search');

$availabePlatforms = array();

array_push($availabePlatforms , array('pc'=>'PC Games'));

if (Configuration::get('ganenabled')) {
    array_push($availabePlatforms ,array('mac'=>'MAC Games'));

}else{
    if(LOCALE=='en'){
        array_push($availabePlatforms ,array('mac'=>'MAC Games'));
    }
    array_push($availabePlatforms ,array('og'=>'Online Games'));    
}

Site_Forms::add_select_item('platform',$availabePlatforms, PLATFORM); 


Site_Forms::add_button('searchButton', Site_Language::display('menu_search_button'), 'submit', 'button');
Site_Forms::add_plain_html('</p>');
$text = Site_Forms::return_form();
Site_Parse::render_content($caption, $text,'menu_search');
?>