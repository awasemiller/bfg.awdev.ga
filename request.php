<?php
/**
 * Request
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
define('PAGE_CACHE', FALSE);

if(isset($_GET['gtype']) && in_array($_GET['gtype'],array('pc','mac'))){
	define('GAMETYPE',$_GET['gtype']);
}

require_once('core_gamesite.php');

$game = $sl->class['site_download']->getGame(intval($_GET['gameid']));

if(!$game){
	header("Location: error.php?nogames");
	exit;
}

$sl->class['site_parse']->settag('PAGETITLE', SITENAME.' - '.($_REQUEST['type'] == 'download' ? $sl->class['site_language']->display('download') : $sl->class['site_language']->display('buy')).' - '.(isset($game['gamename']) ? $game['gamename'] : '' ));

if(is_file(g_THEME_DIR.'download.css')){
	$style = '&amp;style='.g_ABSOLUTE.g_THEME_DIR.'download.css';
}else{
	$style='';
}

$url = IFRAMESERVER.'/download-games/'.$game['gameid'].'/'.(GAMETYPE =='mac' ? 'mac/': '').$game['foldername'].'/'.$_REQUEST['type'].'_pnp.html?channel=affiliates&amp;identifier='.MYBFGIDENTIFIER.(isset($_SESSION['src']) ? '&amp;src='.$_SESSION['src'] : '').$style;

$request['IFRAME'] = '<iframe id="requestframe" src="'.$url.'" frameborder="0"></iframe>';

$request['BACKBUTTON'] = $sl->class['site_elements']->anchorTag($sl->class['site_game']->backLink(), '<span>Back</span>', '', $class='btn btn_back', '', 'Go Back', '');

if(!$sl->class['site_parse']->is_template('main')){
	if(!$sl->class['site_parse']->load_template(g_THEME_DIR.'main_request.html','main')){
		$sl->class['site_parse']->load_template(g_DEFAULT.'main_request.html','main');
	}
}

$sl->class['site_parse']->render_template('main',$request);

$sl->class['site_parse']->page_end();

?>