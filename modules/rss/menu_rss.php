<?php
/**
 * SGS Module: RSS
 * File: menu_rss.php
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

	if(is_file(Configuration::get('module_path').'rss/language/'.LOCALE.'_language.php')){
		Site_Language::loadLanguageFile(Configuration::get('module_path').'rss/language/'.LOCALE.'_language.php');
	}else{
		Site_Language::loadLanguageFile(Configuration::get('module_path').'rss/language/en_language.php');
	}

	$caption = Site_Language::display('rss_caption');

	if(!defined('PRE_RSS_LINKS')){
		define('PRE_RSS_LINKS', '<ul>');
		define('POST_RSS_LINKS', '</ul>');
		define('PRE_RSS_LINK', '<li>');
		define('POST_RSS_LINK', '</li>');
		define('RSS_LINK_ICON','<img src="'.SGS_BASE_URL.'images/icons/feed-icon-14x14.png" alt="" />&nbsp;');
		define('RSS_LINKCLASS', '');
		define('RSS_LINKCLASS_SEL', 'current');
		define('RSS_LINKCLASS_LAST', 'last');
	}


	$genre =  Genre::getPrimaryGenreListSnames();

	
	if(PLATFORM=='og'){
	    $feeds = array_merge(array('glreleaseog','glrankog'),$genre);
	}else{
	    $feeds = array_merge(array('glrelease','glrank'),$genre);
	}
	

	$text = PRE_RSS_LINKS;

	$lastlink = count($feeds);
	$l = '0';

	$rssSelect = '';
	
	foreach($feeds as $sname){

		$genreInfo =Genre::getGenreInfoBySname($sname);
		
		if($genreInfo){
			$class = (($rssSelect ==''.strtolower($sname).'') ? ((RSS_LINKCLASS_SEL != '') ? 'class="'.RSS_LINKCLASS.' '.RSS_LINKCLASS_SEL.'"' : '') : ((RSS_LINKCLASS != '') ? 'class="'.RSS_LINKCLASS.'"' : ''));
			$text .= substr(PRE_RSS_LINK,0,-1).' '.$class.'><a href="'.(Configuration::get('seo') == true ? SGS_BASE_URL.'rss/'.$genreInfo['sname'].'-'.PLATFORM.'-'.LOCALE.'.xml' : Configuration::get('module_base_url').'rss/rss.php?feed='.$genreInfo['sname'].'&platform='.PLATFORM.'&locale='.LOCALE).'">'.RSS_LINK_ICON.$genreInfo['name'].'</a>'.POST_RSS_LINK;
		}
		$l++;
	}

	$text .= POST_RSS_LINKS;



Site_Parse::render_content($caption, $text,'menu_rss');

?>