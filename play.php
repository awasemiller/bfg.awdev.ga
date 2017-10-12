<?php
/**
 * Play
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

define('PLATFORM','og');
require_once('core_gamesite.php');

if (Configuration::get('ganenabled')) {
    header("Location: index.php");
    exit;    
}

Site_Parse::page_start(true);

if(!isset($_GET['id'])){
	header("Location: error.php");
	exit;
}

$Site_Online = new Site_Online();
$game = $Site_Online->getGame($_GET['id']);


$game = $Site_Online->gameinfo($game);

$gameData = array();
$gameData['name'] = $game['gamename'];
$gameData['src'] = $game['med'];
$gameData['href'] = Parsing::parseTemplate(Configuration::get('game_url'), $game, array(), true);
$gameData = implode(',',$gameData);

$game['assetname'] = substr($game['foldername'], strpos($game['foldername'], "_") + 1);

if(!$game){
	header("Location: error.php?nogames");
	exit;
}

Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - '.$game['gamename']);
Site_Parse::setTag('DESCRIPTION', htmlentities(strip_tags(html_entity_decode(Configuration::get('description').' - '.$game['gamename']))));
Site_Parse::setTag('KEYWORDS', htmlentities(strip_tags(html_entity_decode(Configuration::get('keywords').', '.$game['genrename'].', '.$game['gamename']))));

$game['width'] = 700;
$game['height'] = 600;
$game['bgcolor'] = '#ffffff';

Cache::setFile($game['play_og'],array('ext'=>'dom','lifetime'=>1));

if(Cache::needNewFile($game['play_og'])){

    $dom = @file_get_contents($game['play_og']);
    
    if($dom && (strlen($dom) > 0)){
        Cache::save($game['play_og'], $dom);
    }
    
}else{
    
  $dom =  Cache::load($game['play_og']);

}

if ($dom && strstr($dom,'.swf')) {

    preg_match('#width=".*?"#', $dom, $width);                
    preg_match('#height=".*?"#', $dom, $height);
    preg_match('#bgcolor=".*?"#', $dom, $bgcolor);
    
    if (isset($width[0]) && isset($height[0])) {
      
        $width = str_replace(array('width="', '"'), '', $width[0]);
        $height = str_replace(array('height="', '"'), '', $height[0]);                           
        $bgcolor = str_replace(array('bgcolor="', '"'), '', isset($bgcolor[0]) ? $bgcolor[0] : '#000000');

        if (!strstr($bgcolor,"#")) {
            $bgcolor = '#000000';
        }
        
        $width = !is_array($width) ? intval($width) : 640;
        
        $height = !is_array($height) ? intval($height) : 480;

        if ($width <= 100 ) {
            $width = 640;
        }

        if ($height <=  100 ) {
            $height = 480;
        }                            
        
        if (($width > 0) && ($height > 0)) {
            $game['validated'] = "yes";    
        }     

        $game['width'] = $width;
        $game['height'] = $height;
        $game['bgcolor'] = $bgcolor;

    }      
}


/**
 * This is not complete
 * Templating contained in this file will change in the future.
 */

$Template = '<h1 style="text-align:center; padding:20px 0px 0px 0px;">'.$game['gamename'].'</h1><h2 id="Module_GamePlayButton" style="background-image:url('.$game['feature'].');" gameid="'.$game['gameid'].'" data="'.$gameData.'">'.Site_Language::display('page_play_getting_your_online_game').'</h2>';
$game['width'] = $game['width'] + 20;
$game['height'] = $game['height'] + 20;    
$Template .= '<div id="Module_GameContainerWrapper" style="width:'.($game['width'] + 20).'px; height:'.($game['height'] + 10).'px; margin:0px auto;"><div id="Module_GameContainer" style="width:'.$game['width'].'px; height:'.$game['height'].'px; margin:0px auto; background-color:'.$game['bgcolor'].';"><iframe id="Module_GameContainerIframe" style="overflow: hidden;'.(isset($game['left']) ? ' left:'.$game['left'].'px;' : '').(isset($game['top']) ? ' top:'.$game['top'].'px;' : '').'" src="'.$game['play_og'].'" width="'.$game['width'].'" height="'.$game['height'].'" frameborder="0" scrolling="no" scrollbar="no"></iframe></div></div><br /><br />';
echo Parsing::parseTemplate($Template, $game, array());
Site_Parse::page_end();
?>