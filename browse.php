<?php
/**
 * Browse Archive
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

    if(isset($_REQUEST['platform']) && in_array($_REQUEST['platform'],array('pc','mac','og'))){
    	define('PLATFORM',$_REQUEST['platform']);
    }

	require_once('core_gamesite.php');

    Site_Parse::page_start(true);
    
	$requestvars = array('genre','sort','order','from','view','locale','platform');

	foreach($_REQUEST as $key=>$value){
		if(in_array($key,$requestvars)){
			$request[$key] = strtolower($value);
		}
	}
	
	if (Configuration::get('ganenabled') && (PLATFORM =='og')) {
        header("Location: index.php");
	    exit;    
	} 
	   
	if(PLATFORM =='og'){
		$game_class = new Site_Online();
	}else{
		$game_class = new Site_Download();
	}

	if(!Site_Parse::is_template('games')){
		if(!Site_Parse::load_template(Configuration::get('theme_path').'games.html','games')){
			Site_Parse::load_template(Configuration::get('default_theme_path').'games.html','games');
		}
	}

	if(!Site_Parse::is_template('main')){
		if(!Site_Parse::load_template(Configuration::get('theme_path').'main_browse.html','main')){
			Site_Parse::load_template(Configuration::get('default_theme_path').'main_browse.html','main');
		}
	}

	if(!isset($request['sort'])){
		$request['sort'] = 'date';
	}

	if(!isset($request['order'])){
		$request['order'] = 'desc';
	}
	

	if(!isset($request['genre']) || (isset($request['genre']) && $request['genre'] =='all')){
		$request['genre'] = 'all';
		$genrekey = 'all';
	}else{
		$genreInfo = Genre::getGenreInfoBySname($request['genre']);
		$genrekey = $genreInfo['genreid'];
	}

	if(!isset($request['from'])){
		$request['from']='0';
	}

	if(!isset($request['view'])){
		if(Configuration::get('browseviewtotal')){
			$request['view'] = Configuration::get('browseviewtotal');
		}else{
			$request['view']='10';
		}
	}

	$total = $game_class->getGameCounts(array('genre'=>$genrekey));
	
	
	if($total < $request['from']){
		$request['from'] = 0;
	}

	if($total >=1){

		switch($request['sort']){

			case 'date':

				$games = $game_class->getDateList($request['view'],$request['from'],array('genre'=>$genrekey, 'sort'=>($request['order'] == 'asc') ? SORT_ASC : SORT_DESC));

			break;

			case 'rank':

				if(PLATFORM == 'og'){

				    $games = $game_class->getCountList($request['view'],$request['from'],array('genre'=>$genrekey, 'sort'=>($request['order'] == 'asc') ? SORT_ASC : SORT_DESC));
			    					
				}else{
					$games = $game_class->getRankList($request['view'],$request['from'],array('genre'=>$genrekey, 'sort'=>($request['order'] == 'asc') ? SORT_ASC : SORT_DESC));
				}
				

			break;

			case 'name':

				$games = $game_class->getNameList($request['view'],$request['from'],array('genre'=>$genrekey, 'sort'=>($request['order'] == 'asc') ? SORT_ASC : SORT_DESC));

			break;
		}

		/**
		 * SORTLIST
		 */

		$select_genre = array(array('all'=>Site_Language::display('select_genre_all')));

		$allowedGenre = Genre::getPrimaryGenreList();
		
		foreach($allowedGenre as $key=>$genre){
			
			$count = $game_class->getGameCounts(array('genre'=>$genre['genreid']));
	
			
			if($count > 0){
				array_push($select_genre,array($genre['sname']=>$genre['name']));
			}
		}

		
		$sortList = $game_class->sortList(array('url'=>((defined('SEO') && SEO == TRUE) ? 'browse.html': 'browse.php'),'select_genre'=>$select_genre));

		$gameList = '';

		foreach($games as $game){

			$game = $game_class->gameInfo($game);

			if(defined('GAMES_TEMPLATE_RENDER') && GAMES_TEMPLATE_RENDER == 'plain'){
				$gameList .= Site_Parse::render_template('games',$game, TRUE);
			}else{
				$gameList .= Site_Parse::render_content($game['gamename'], Site_Parse::render_template('games',$game, TRUE), $id='', $class='', TRUE);
			}
		}

		if(defined('SEO') && SEO == TRUE){
            $paginate = Site_Paginate::nextprev('browse', $request['from'], $request['view'], $total,  '-'.$request['view'].'-'.LOCALE.'-'.PLATFORM.'.html', "-".$request['genre']."-".$request['sort']."-".$request['order']."-", true,true);
		}else{
			$paginate = Site_Paginate::nextprev(''.$_SERVER['PHP_SELF'].'', $request['from'], $request['view'], $total, '', "genre=".$request['genre']."&amp;sort=".$request['sort']."&amp;order=".$request['order']."&amp;view=".$request['view'].'&amp;locale='.LOCALE.'&amp;platform='.PLATFORM."&amp;from=", true);
		}

		
		$info = Genre::getGenreInfoBySname($request['genre']);
		
		$browseCaption = Site_Language::display('browse_caption');

		
		$browseListCaption = Site_Parse::parse_layout(Site_Language::display('browseListCaption'),array('GENRENAME'=>$info['name']));
		$browseInfo = Site_Parse::parse_layout(Site_Language::display('browseinfo'),array('info1'=>($request['from'] + 1),'info2'=>((($request['from'] + 1 + $request['view']) < $total) ? ($request['from'] +  $request['view']) : $total),'info3'=>$total));

		Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - '.$browseCaption);
		Site_Parse::setTag('DESCRIPTION', Configuration::get('description').' '.$browseCaption);
		Site_Parse::setTag('KEYWORDS', Configuration::get('keywords').' '.strip_tags($browseListCaption));

		Site_Parse::render_template('main',array('SORTLIST'=>$sortList,'BROWSE_CAPTION'=>$browseCaption,'BROWSE_LIST_CAPTION'=>$browseListCaption,'PAGINATE'=>$paginate,'BROWSEINFO'=>$browseInfo,'GAMES'=>$gameList));

	}else{

		$location = SGS_BASE_URL.'error.php?nogames';
		header("Location: {$location}");
		exit;
	}

	Site_Parse::page_end();

?>