<?php
/**
 * SGS Module: Online
 * File: menu_onlinegames_top.php
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
	 * menu name var
	 */
	$menu_name = 'online_top';

	/**
	 * load language
	 */

	if(is_file(Configuration::get('module_path').'online/language/'.LOCALE.'_language.php')){
		Site_Language::loadLanguageFile(Configuration::get('module_path').'online/language/'.LOCALE.'_language.php');
	}else{
		Site_Language::loadLanguageFile(Configuration::get('module_path').'online/language/en_language.php');
	}
	/**
	 * load prefs
	 */

	$prefs = Site_Modules::loadPrefs('online');

	/**
	 * set amount
	 */
	if(isset($prefs['menu_'.$menu_name.'_amount']) && $prefs['menu_'.$menu_name.'_caption'] != ''){
			$amount = $prefs['menu_'.$menu_name.'_amount'];
	}else{
			$amount = '5';
	}
	

	/**
	 * set caption
	 */
	if(isset($prefs['menu_'.$menu_name.'_caption']) && $prefs['menu_'.$menu_name.'_caption'] != '') {
		$caption = stripslashes(str_replace('{NUMBER}',$amount,$prefs['menu_'.$menu_name.'_caption']));
	} else {
		$caption = str_replace('{NUMBER}',$amount, Site_Language::display('menu_'.$menu_name.'_caption'));
	}

	/**
	 * query our count list
	 */

	$games = Site_Online::getCountList($amount,'0',array('genre'=>'all', 'sort'=>SORT_DESC));

	$text = '';

	if($games){

		foreach($games as $game){

			$game = Site_Online::gameInfo($game);

			$game['link'] = Site_Elements::anchorTag($game['play_url'], $game['gamename']);
			$game['image'] = Site_Elements::anchorTag($game['play_url'], Site_Elements::imageTag($game['small'], $game['gamename'],'',''));

			$text .= '<dl>';
			$text .= '<dt>'.$game['image'].'</dt>';
			$text .= '<dd>'.$game['link'].'</dd>';
			$text .= '<dd>'.number_format($game['playercount']).' players</dd>';
			$text .= '</dl>';

		}
		
		Site_Parse::render_content($caption, $text,'menu_'.$menu_name);
	}
?>