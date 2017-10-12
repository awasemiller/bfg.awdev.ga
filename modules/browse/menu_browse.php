<?php
/**
 * SGS Module: Browse
 * File: menu_browse.php
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



	if(is_file(Configuration::get('module_path').'browse/language/'.LOCALE.'_language.php')){
		Site_Language::loadLanguageFile(Configuration::get('module_path').'browse/language/'.LOCALE.'_language.php');
	}else{
		Site_Language::loadLanguageFile(Configuration::get('module_path').'browse/language/en_language.php');
	}

	if(PLATFORM =='og'){
		$game_class = new Site_Online();
	}else{
		$game_class = new Site_Download();
	}

	$prefs = Site_Modules::loadPrefs('browse');

	if(isset($prefs['browse_caption']) && $prefs['browse_caption'] != '') {
		$caption = stripslashes($prefs['browse_caption']);
	} else {
		$caption = Site_Language::display('browse_menu_caption');
	}

	$sort = (isset($_REQUEST['sort']) ? strtolower($_REQUEST['sort']) : (isset($_REQUEST['sort']) ? strtolower($_REQUEST['sort']) : 'date'));
	$order = (isset($_REQUEST['order']) ? strtolower($_REQUEST['order']) : (isset($_REQUEST['order']) ? strtolower($_REQUEST['order']) : 'desc'));
	$genre = (isset($_REQUEST['genre']) ? strtolower($_REQUEST['genre']) : (isset($_REQUEST['genre']) ? strtolower($_REQUEST['genre']) : 'all'));
	$view = (isset($_REQUEST['view']) ? $_REQUEST['view'] : (defined('BROWSEVIEWTOTAL') ? BROWSEVIEWTOTAL : '10'));

	$browselinks = array();
	$browselinks[] = array('name'=>'all','href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'browse-all-'.$sort.'-'.$order.'-0-'.$view.'-'.LOCALE.'-'.PLATFORM.'.html' : SGS_BASE_URL.'browse.php?genre=all&amp;sort='.$sort.'&amp;order='.$order.'&amp;platform='.PLATFORM), 'linktext'=>Site_Language::display('browse_menu_all'));

	$primaryGenre = Genre::getPrimaryGenreList();
	

	foreach($primaryGenre as $key=>$genre){

		$count = $game_class->getGameCounts(array('genre'=>$genre['genreid']));		

		if($count > 0){
			array_push($browselinks,array('name'=>$genre['sname'],'href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'browse-'.$genre['sname'].'-'.$sort.'-'.$order.'-0-'.$view.'-'.LOCALE.'-'.PLATFORM.'.html' : SGS_BASE_URL.'browse.php?genre='.$genre['sname'].'&amp;sort='.$sort.'&amp;order='.$order.'&amp;platform='.PLATFORM), 'linktext'=>$genre['name']));
		}
	}

	if(!defined('PRE_BROWSE_LINKS')){
		define('PRE_BROWSE_LINKS', '<ul>');
		define('POST_BROWSE_LINKS', '</ul>');
		define('PRE_BROWSE_LINK', '<li>');
		define('POST_BROWSE_LINK', '</li>');
		define('BROWSE_LINK_ICON','');
		define('BROWSE_LINKCLASS', 'browselink');
		define('BROWSE_LINKCLASS_SEL', 'current');
		define('BROWSE_LINKCLASS_LAST', 'last');
	}

	$text = PRE_BROWSE_LINKS;

	$lastlink = count($browselinks);
	$l = '0';
	foreach($browselinks as $link){

		if(defined('MODULE_CACHE') && MODULE_CACHE == TRUE && $explicit_cache){
			$selopt = TRUE;
		}else if(!defined('MODULE_CACHE') || (defined('MODULE_CACHE') && MODULE_CACHE == FALSE)){
			$selopt = TRUE;
		}else{
			$selopt = FALSE;
		}

		$class = (($genre ==''.strtolower($link['name']).'' && eregi('browse', SGS_PAGE) && $selopt) ? ((BROWSE_LINKCLASS_SEL != '') ? 'class="'.(BROWSE_LINKCLASS !='' ? BROWSE_LINKCLASS.' ' : '').BROWSE_LINKCLASS_SEL.'"' : '') : ((BROWSE_LINKCLASS != '') ? 'class="'.BROWSE_LINKCLASS.'"' : ''));


		$text .= substr(PRE_BROWSE_LINK,0,-1).' '.$class.'>'.Site_Elements::anchorTag($link['href'], BROWSE_LINK_ICON.$link['linktext']).POST_BROWSE_LINK;
		$l++;
	}

	/**
	 * TODO Add Game Type option links
	 */

	$text .= POST_BROWSE_LINKS;

Site_Parse::render_content($caption, $text,'menu_browse');

?>
