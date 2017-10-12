<?php
/**
 * Download
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


if(isset($_REQUEST['platform']) && in_array($_REQUEST['platform'],array('pc','mac'))){
	define('PLATFORM',$_REQUEST['platform']);
}

require_once('core_gamesite.php');

Site_Parse::page_start(true);

if(!isset($_GET['games'])){
    $_GET['games'] ='new-download';
	$request = 'glrelease';
}else if($_GET['games'] == 'new-download'){
	$request = 'glrelease';
}else if($_GET['games'] == 'top-download'){
	$request = 'glrank';
}else{
	$request = strtolower($_GET['games']);
}

/**
 * List of all Valid Game Genre Short names
 * @var array $genreSnames
 */

$genreSnames = Genre::getGenreListSnames();

if(!in_array($request, $genreSnames)){

	$location = 'error.php?invalid';
	header("Location: {$location}");
	exit;
}

/**
 * set feature css class
 * newdownload | topdownload
 *
 */

Site_Parse::setTag('featureclass',($request=='glrelease') ? 'newgame' : 'topgame');

/**
 * set feature text
 */

Site_Parse::setTag('featuretext',Site_Language::display(($request=='glrelease') ? 'featured_download_newgame' : 'featured_download_topgame'));

/**
 * get the genre Id based on the request and set the genre information
 */

$genreInfo = Genre::getGenreInfoBySname($request);

if(!defined('SUBFEATUREGAMES_AMOUNT')){
	define('SUBFEATUREGAMES_AMOUNT','8');
}

/**
 * processPageRequest
 */
$sd = new Site_Download();
$sd->processPageRequest($request,$genreInfo);

/**
 * load the main layout
 */

if(!Site_Parse::is_template('main')){
	if(!Site_Parse::load_template(Configuration::get('theme_path').'main_platforms.html','main')){
		Site_Parse::load_template(Configuration::get('default_theme_path').'main_platforms.html','main');
	}
}

/**
 * parse the main layout
 */

Site_Parse::render_template('main',array(),FALSE);

/**
 * cleanup
 */

for($i=0; $i<=(SUBFEATUREGAMES_AMOUNT+1); $i++){
	Site_Parse::removeTag('GAME'.$i.'');
}

Site_Parse::removeTag('CAPTION');
Site_Parse::removeTag('TEXT');
Site_Parse::removeTag('GENRELIST');
Site_Parse::unload_template('main');	
Site_Parse::page_end();
?>