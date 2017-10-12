<?php
/**
 * SGS Module: RSS
 * File: functions.php
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
	
function toRSS($string){

	$search = array(" & ", "\n");
	$replace = array(' &amp; ','');

	return str_replace($search,$replace,$string);
}

function create_rss($feed){

	Site_Parse::setTag('G_ABSOLUTE', Configuration::get('module_base_url').'rss/');

	$genre = Genre::getPrimaryGenreListSnames();

	if(!$feed || !in_array($feed, array_merge($genre,array('new-download','top-download')))){
		$sname = 'glrelease';
	}

	if($feed == 'new-download'){
		$feed = 'glrelease';
	}else if($feed == 'top-download'){
		$feed = 'glrank';
	}

	
	
	/**
	 * get the current genreID and information
	 */
	
	$genreInfo = Genre::getGenreInfoBySname($feed);
	
	
	$genreId = $genreInfo['genreid'];
	

	/**
	 * load templates
	 */

	Site_Parse::load_template(Configuration::get('module_path').'rss/templates/item.xml','item');

	Site_Parse::load_template(Configuration::get('module_path').'rss/templates/page.xml','page');

	$domainPath = str_replace(array($config['module_dir'].'/','rss/'),array('',''), SGS_BASE_URL);

	$agent = $_SERVER['HTTP_USER_AGENT'];

	$pubdate = date("r",time());
	
		switch ($feed){

				case 'glrelease':
				    if(PLATFORM=='og'){
				        $games = Site_Online::getDateList('10');
				    }else{
					    $games = Site_Download::getDateList('10');
				    }
				break;

				case 'glrank':
				    if(PLATFORM=='og'){
				        $games = Site_Online::getCountList('10');
				    }else{
					    $games = Site_Download::getRankList('10');
				    }
				break;

				default:
				    
				    if(PLATFORM=='og'){
				        $games = Site_Online::getCountList('10','0', array('genre'=>$genreId));
				    }else{
    				    $games = Site_Download::getRankList('10','0', array('genre'=>$genreId));
				    }
			}

			$search = array(" & ", "\n");
			$replace = array(' &amp; ','');


			Site_Parse::setTag('TITLE', Configuration::get('sitename').' - '.toRSS($genreInfo['name']));
			Site_Parse::setTag('LINK', SGS_BASE_URL);
			Site_Parse::setTag('LANGUAGE',LOCALE);

			Site_Parse::setTag('PUBDATE',$pubdate);

			Site_Parse::setTag('DESCRIPTION', toRSS($genreInfo['description']));

			$items = '';

			foreach($games as $key=>$game){

				unset($games[$key]);

				$game = array_change_key_case($game, CASE_LOWER);
				$game = Site_Game::gameInfo($game);

				$game['itemtitle'] =  $game['gamename'];

				$game['itemreleasedate'] = $game['releasedate'];

				$game['itemlink'] = SGS_BASE_URL.$game['gameinfo_url'];

				$game['itemdescription'] .= str_replace('&','&amp;',$game['longdesc']);

				$items .= Site_Parse::render_template('item',$game,TRUE);
			}
			
			
			return $items;
}
?>