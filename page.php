<?php
/**
 * Page
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
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */
	require_once('core_gamesite.php');

    Site_Parse::page_start(true);
    
	if(
	    isset($_GET['id']) && 
	    is_file(Configuration::get('custom_path').(isset($_GET['tmplocale']) ? $_GET['tmplocale'] : LOCALE).'_'.$_GET['id'].'.page') && 
	    is_readable(Configuration::get('custom_path').(isset($_GET['tmplocale']) ? $_GET['tmplocale'] : LOCALE).'_'.$_GET['id'].'.page')
	    )
	{

		$page = unserialize(file_get_contents(Configuration::get('custom_path').(isset($_GET['tmplocale']) ? $_GET['tmplocale'] : LOCALE).'_'.$_GET['id'].'.page'));

		Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - '.htmlentities(html_entity_decode(stripslashes($page['caption']))));
		Site_Parse::setTag('CURRENTPAGE', htmlentities(html_entity_decode(stripslashes($page['caption']))));

		/** set page description */
		Site_Parse::setTag('DESCRIPTION', Configuration::get('description').(isset($page['description']) ? ', '.htmlentities(html_entity_decode(str_replace("\n",'',stripslashes($page['description'])))) : ''));

		/** set page keywords */
		Site_Parse::setTag('KEYWORDS', Configuration::get('keywords').(isset($page['keywords']) ? ', '.htmlentities(html_entity_decode(str_replace("\n",'',stripslashes($page['keywords'])))) : ''));

		$caption = Site_Parse::parse_codes(stripslashes($page['caption']));
		$text = Site_Parse::parse_codes(stripslashes($page['content']));

		$pageinfo = array('author'=>$page['author'],'cmon'=>ucfirst(date('F',$page['date'])),'cday'=>date('jS',$page['date']),'cyear'=>date('Y',$page['date']),'chour'=>date('h',$page['date']),'cmin'=>date('i',$page['date']), 'csec'=>date('s',$page['date']),'cmeridiem'=>date('a',$page['date']));

		/** load pageinfo template */
		if(!Site_Parse::is_template('pageinfo')){
			if(!Site_Parse::load_template(Configuration::get('theme_path').'main_pageinfo.html','pageinfo')){
				Site_Parse::load_template(Configuration::get('default_theme_path').'main_pageinfo.html','pageinfo');
			}
		}

		$text .= Site_Parse::render_template('pageinfo',$pageinfo,true);

		Site_Parse::setTag('CURRENTPAGE', $caption);

		Site_Parse::render_content(trim($caption), trim($text),$page['filename'],$page['filename']);

		if(Configuration::get('sitecomments')){
			if(isset($page['allow_comments']) && $page['allow_comments'] == true){
				Site_Comments::renderComments('page',$_GET['id'],false);
			}
		}

	}else{

		$location = 'error.php?404';
		header("Location: {$location}");
		exit;
	}

	Site_Parse::page_end();
?>