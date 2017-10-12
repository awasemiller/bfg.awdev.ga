<?php
/**
 * SGS Module: Online
 * File: menu_onlinegames_total.php
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

	

	$menu_name = 'online_total';

	if(is_file(Configuration::get('module_path').'online/language/'.LOCALE.'_language.php')){
		Site_Language::loadLanguageFile(Configuration::get('module_path').'online/language/'.LOCALE.'_language.php');
	}else{
		Site_Language::loadLanguageFile(Configuration::get('module_path').'online/language/en_language.php');
	}

	$prefs = Site_Modules::loadPrefs('online');

	if(isset($prefs['menu_'.$menu_name.'_caption']) && $prefs['menu_'.$menu_name.'_caption'] != '') {
		$caption = stripslashes($prefs['menu_'.$menu_name.'_caption']);
	} else {
		$caption = Site_Language::display('menu_'.$menu_name.'_caption');
	}

	$playcount = Site_Online::getTotalPlayersOnline();

	$text = '<ul>';

	if($playcount){
		$text .= '<li>'.Site_Language::display('menu_online_total_text').': '.number_format($playcount).'</li>';
	}else{
		$text .= '<li>'.Site_Language::display('menu_online_total_text').': 0</li>';
	}

	$text .= '<li>'.Site_Elements::anchorTag((Configuration::get('seo') == true ? SGS_BASE_URL.'online-games.html' : SGS_BASE_URL.'online-games.php'), Site_Language::display('menu_all_play_online'),'','').'</li>';

	$text .= '</ul>';

	Site_Parse::render_content($caption, $text,'menu_'.$menu_name);

?>