<?php
/**
 * Site Map
 *
 * Copyright (c) 2007 - 2010 Big Fish Games, Inc.
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
 * @version 0.9
 * @package PNP Tools
 * @subpackage SGS
 * @copyright Copyright (c) 2007 - 2010 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

require_once('core_gamesite.php');

$caption = 'Sitemap';
$text = '';
$cpage = array();

$sl->class['site_parse']->settag('PAGETITLE', SITENAME.' - '.$caption);

	/**
	 * Custom Pages
	 */
	$existing = $sl->class['site_custompage']->get_custompages();

	$locals = $sl->class['site_language']->locals;

	foreach($existing as $page){
		if(sgs_eregi(LOCAL.'_',$page)){
			array_push($locals,'_');
			$page = str_replace($locals,'',$page);
			$pagename = str_replace('-', ' ',$page);
			if(defined('SEO') && SEO == TRUE){
				$cpage[g_BASE_DIR.$page.'.html'] = $pagename;
			}else{
				$cpage[g_BASE.'page.php?id='.$page] = $pagename;
			}
		}
	}

$pagearray = array(
// area caption => array(caption,url)
// Index Pages
	/*$sl->class['site_language']->display('nav_caption')=>array(
		g_BASE.'index.php?games=newrelease'=>$sl->class['site_language']->display('nav_newrelease'),
		g_BASE.'index.php?games=newrelease'=>$sl->class['site_language']->display('nav_newrelease'),
		g_BASE.'index.php?games=toprank'=>$sl->class['site_language']->display('nav_toprank'),
		g_BASE.'index.php?games=action'=>$sl->class['site_language']->display('nav_action'),
		g_BASE.'index.php?games=card'=>$sl->class['site_language']->display('nav_card'),
		g_BASE.'index.php?games=mahjong'=>$sl->class['site_language']->display('nav_mahjong'),
		g_BASE.'index.php?games=puzzle'=>$sl->class['site_language']->display('nav_puzzle'),
		g_BASE.'index.php?games=word'=>$sl->class['site_language']->display('nav_word')),*/
// Browse Pages
	/*$sl->class['site_language']->display('browse_menu_caption')=>array(
		g_BASE.'browse.php?sort=date&amp;order=desc&amp;genre=All'=>$sl->class['site_language']->display('browse_menu_all'),
		g_BASE.'browse.php?sort=date&amp;order=desc&amp;genre=Action'=>$sl->class['site_language']->display('browse_menu_action'),
		g_BASE.'browse.php?sort=date&amp;order=desc&amp;genre=Card'=>$sl->class['site_language']->display('browse_menu_card'),
		g_BASE.'browse.php?sort=date&amp;order=desc&amp;genre=Mahjong'=>$sl->class['site_language']->display('browse_menu_mahjong'),
		g_BASE.'browse.php?sort=date&amp;order=desc&amp;genre=Puzzle'=>$sl->class['site_language']->display('browse_menu_puzzle'),
		g_BASE.'browse.php?sort=date&amp;order=desc&amp;genre=Word'=>$sl->class['site_language']->display('browse_menu_word')),
*/
// Custom Pages
	'Pages'=>$cpage,
	$sl->class['site_language']->display('page_search_caption')=>array(
	g_BASE.'search.php'=>'search')
);


if(!defined('PRE_MAP_LINKS')){
	define('PRE_MAP_CAPTION', '<h4>');
	define('POST_MAP_CAPTION', '</h4>');
	define('PRE_MAP_LINKS', '<ul>');
	define('POST_MAP_LINKS', '</ul>');
	define('PRE_MAP_LINK', '<li>');
	define('POST_MAP_LINK', '</li>');
	define('MAP_LINK_ICON','');
}

foreach($pagearray as $main=>$section){
	$text .= PRE_MAP_CAPTION.$main.POST_MAP_CAPTION;

	$text .= PRE_MAP_LINKS;
	foreach($section as $uri=>$content){
		$text .= PRE_MAP_LINK.$sl->class['site_elements']->anchorTag($uri, MAP_LINK_ICON.' '.$content, $id='', $class='', $js='', $title='', $target='', $rel='').POST_MAP_LINK;
	}
	$text .= POST_MAP_LINKS;
}
$sl->class['site_parse']->render_content($caption, $text,'sitmap','sitmap');

$sl->class['site_parse']->page_end();
?>