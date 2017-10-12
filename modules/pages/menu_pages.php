<?php
/**
 * SGS Module: Pages
 * File: menu_pages.php
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

	$prefs = Site_Modules::loadPrefs('pages');
	/**
	 * load language file
	 */
	if(is_file(Configuration::get('module_path').'pages/language/'.LOCALE.'_language.php')){
		Site_Language::loadLanguageFile(Configuration::get('module_path').'pages/language/'.LOCALE.'_language.php');
	}else{
		Site_Language::loadLanguageFile(Configuration::get('module_path').'pages/language/en_language.php');
	}

	if(isset($prefs['page_caption']) && $prefs['page_caption'] != '') {
		$caption = stripslashes($prefs['page_caption']);
	} else {
		$caption = Site_Language::display('pages_caption');
	}

	$text = '';
	$existing = Site_CustomPage::getCustompages();

	$pageList= FALSE;

	if(count($existing)>=1){

		if(!defined('PRE_PAGE_LINKS')){
			define('PRE_PAGE_LINKS', '<ul>');
			define('POST_PAGE_LINKS', '</ul>');
			define('PRE_PAGE_LINK', '<li>');
			define('POST_PAGE_LINK', '</li>');
			define('PAGE_LINK_ICON','');
			define('PAGE_LINKCLASS', 'linkclass');
			define('PAGE_LINKCLASS_SEL', 'current');
			define('PAGE_LINKCLASS_LAST', 'last');
		}

		$text = PRE_PAGE_LINKS;

		$name = strtolower((SGS_PAGE =='page.php') ? (isset($_GET['id']) ? $_GET['id'] : '') : '');

		$lastlink = count($existing);

		$l = '1';



		$search = Site_Language::$locales;

		foreach($search as $key=>$word){
			$search[$key] = $word.'_';
		}

		foreach($existing as $page){

			if(sgs_eregi(LOCALE.'_',$page)){

				$pageList= TRUE;


				$pagename = Site_CustomPage::cleanPageName($page);

				$page = str_replace($search,'',$page);

				$last = (intval($lastlink) == $l) ? ' '.PAGE_LINKCLASS_LAST : '';
				$class = ($name ==strtolower($page) ? 'class="'.PAGE_LINKCLASS_SEL.$last.'"' : 'class="'.PAGE_LINKCLASS.$last.'"');

				if(Configuration::get('seo') == true){
					$text .= substr(PRE_PAGE_LINK,0,-1).' '.$class.'>'.Site_Elements::anchorTag(SGS_BASE_URL.$page.'.html', $pagename, '','','',$pagename,'').POST_PAGE_LINK;
				}else{
					$text .= substr(PRE_PAGE_LINK,0,-1).' '.$class.'>'.Site_Elements::anchorTag(SGS_BASE_URL.'page.php?id='.$page, $pagename, '','','',$pagename,'').POST_PAGE_LINK;
				}

				$l++;
			}
		}

		$text .= POST_PAGE_LINKS;

		if($pageList){
			Site_Parse::render_content($caption, $text,'menu_pages');
		}
	}

?>