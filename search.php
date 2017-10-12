<?php
/**
 * Search
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


if (Configuration::get('ganenabled')  && (PLATFORM =='og')) {
    header("Location: index.php");
    exit;    
}

	if(!Site_Parse::is_template('games')){
		if(!Site_Parse::load_template(Configuration::get('theme_path').'games.html','games')){
			Site_Parse::load_template(Configuration::get('default_theme_path').'games.html','games');
		}
	}

	if(!Site_Parse::is_template('main')){
		if(!Site_Parse::load_template(Configuration::get('theme_path').'main_search.html','main')){
			Site_Parse::load_template(Configuration::get('default_theme_path').'main_search.html','main');
		}
	}

	Site_Parse::setTag('CURRENTPAGE','Search');

	if(!isset($_REQUEST['search']) && isset($_GET)){
		$searchterm = array_keys($_GET);
		if(isset($searchterm[0]) && $searchterm[0] !=''){
			//$_REQUEST['search'] = $searchterm[0];
		}
	}

	if(isset($_REQUEST['search'])){

		$gamesearch = $_REQUEST['search'];

		/**
		 * TODO which game list or other object to search based on type request
		 */
		if(PLATFORM =='og'){
			$game_class = new Site_Online();
		}else{
			$game_class = new Site_Download();
		}
	
		$games = $game_class->getNameList($return='all',$from='0',$options=array());

		if(!is_array($games)){
			/**
			 * If we were unable to load the game name list, something went very wrong with our game archive.
			 * We'll redirect the user to the error page.
			 */
			$location = SGS_BASE_URL.'error.php?nogames';
			header("Location: {$location}");
			exit;
		}

		function search_replace($searchterm, $searchcontent){
			return str_ireplace($searchterm, '<span style="color:red;">'.$searchterm.'</span>', $searchcontent);
		}

		if(isset($_GET['from'])){
			$from=$_GET['from'];
		}else{
			$from='0';
		}

		if(Configuration::get('searchviewtotal')){
			$view = Configuration::get('searchviewtotal');
		}else{
			$view='10';
		}

		$i='0';
		$viewtotal='1';
		$gamelist = '';

		if($gamesearch !=''){

			$cur = array();

			foreach ($games as $game)
			{
				$found = FALSE;
				$game = array_change_key_case($game, CASE_LOWER);
				$gamesearch  = strtolower($gamesearch);

				if($game['releasedate'] == '0000-00-00 00:00:00'){
					unset($game['releasedate']);
				}
				
				if(isset($game['gamename']) && sgs_eregi($gamesearch, $game['gamename'])){
					$game['gamename'] = search_replace($gamesearch, $game['gamename']);
					
					$found['gamename'] = TRUE;
				}

				if(isset($game['shortdesc']) && sgs_eregi($gamesearch, $game['shortdesc'])){
					$game['shortdesc'] = search_replace($gamesearch, $game['shortdesc']);
					$found['shortdesc'] = TRUE;
				}

				if(isset($game['meddesc']) && sgs_eregi($gamesearch, $game['meddesc'])){
					$game['meddesc'] = search_replace($gamesearch, $game['meddesc']);
					$found['meddesc'] = TRUE;
				}

				if(isset($game['longdesc']) && sgs_eregi($gamesearch, $game['longdesc'])){
					$game['longdesc'] = search_replace($gamesearch, $game['longdesc']);
					$found['longdesc'] = TRUE;
				}

				if(!isset($game['gameid'])  || !$game['gameid']){
					$found = FALSE;
				}

				if($found){

					if($i>= $from && $viewtotal <= $view){

						$game = Site_Game::gameInfo($game);
						
						if(defined('GAMES_TEMPLATE_RENDER') && GAMES_TEMPLATE_RENDER == 'plain'){
							$gamelist .= Site_Parse::render_template('games',$game, TRUE);
						}else{
							$gamelist .= Site_Parse::render_content($game['gamename'], Site_Parse::render_template('games',$game, TRUE), $id='', $class='', TRUE);
						}
					 	++$viewtotal;
					}

					if(!isset($cur['gamename'])){
						// set info for description and keywords for this query
						$cur['gamename'] = isset($game['gamename']) ? strip_tags($game['gamename']) : '';
						$cur['shortdesc'] = isset($game['shortdesc']) ? strip_tags($game['shortdesc']) : '';
						$cur['caption'] = isset($info['caption']) ? $info['caption'] : '';
						$cur['text'] = isset($info['text']) ? $info['text'] : '';
					}

					++$i;
				}else{
					unset($game);
				}
				unset($found);
			}
		}

		/**
		 * TAGS Module support
		 */
		if(isset($_POST['search']) && $i>=4 && strlen($gamesearch)>=4){
			if(is_file(Configuration::get('module_path').'tags/functions.php') && is_readable(Configuration::get('module_path').'tags/functions.php')){
				require_once(Configuration::get('module_path').'tags/functions.php');
				if(function_exists('writeTags')){
					writeTags($gamesearch,$i,$type='search');
				}
			}
		}
		unset($games);
	}


	Site_Parse::setTag('DESCRIPTION', htmlentities(html_entity_decode(Configuration::get('description').(isset($cur['gamename']) ? ', '.str_replace("\n",'',$cur['gamename'].', '.$cur['shortdesc'].', '.ucfirst($cur['caption']).', '.$cur['text']) : ''))));

	Site_Parse::setTag('KEYWORDS', htmlentities(html_entity_decode(Configuration::get('keywords').(isset($cur['gamename']) ? ', '.str_replace("\n",'',$cur['gamename'].', '.ucfirst($cur['caption'])) : ''))));

	Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - Search');

	$searchform = '
	<form id="searchFormPage" method="post" action="search.php">
		<p><input type="text" name="search" class="textbox" value="'.(isset($_REQUEST['search']) ? $_REQUEST['search'] : '').'"/>
		<input type="hidden" name="platform" value="'.PLATFORM.'" />

		 <input type="submit" value="Search" class="button" /></p>
	</form>';

    Site_Forms::start_form('searchFormMenu', SGS_BASE_URL.'search.php', 'post');
    Site_Forms::add_plain_html('<p>');
    Site_Forms::add_input_data('search', isset($_POST['search']) ? $_POST['search'] : (isset($_GET['search']) ? $_GET['search'] : ''), $label='', 'textbox search');
        
    $platform = isset($_POST['platform']) ? $_POST['platform'] : (isset($_GET['platform']) ? $_GET['platform'] : 'pc');
    
    $availabePlatforms = array();

    array_push($availabePlatforms , array('pc'=>'PC Games'));
    
    if (Configuration::get('ganenabled')) {
        array_push($availabePlatforms ,array('mac'=>'MAC Games'));

    }else{
        if(LOCALE=='en'){
            array_push($availabePlatforms ,array('mac'=>'MAC Games'));
        }
        array_push($availabePlatforms ,array('og'=>'Online Games'));
        
    }
    
    Site_Forms::add_select_item('platform',$availabePlatforms, $platform); 
    
    Site_Forms::add_button('searchButton', Site_Language::display('page_search_button'), 'submit', 'button');
    Site_Forms::add_plain_html('</p>');
    $searchform = Site_Forms::return_form();	
	

	if(isset($_REQUEST['search']) && $_REQUEST['search'] !=''){
		if($i <= '0' && isset($_REQUEST['search'])){
			$searchmessage = $i.' '.Site_Language::display('page_search_message_try');
		}else if($i >= '0' && isset($_REQUEST['search'])){

			Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - Search for '.$_REQUEST['search']);
			$searchmessage = Site_Parse::parse_layout(Site_Language::display('page_search_message_results'),array('START_NUMBER'=>($from + 1),'END_NUMBER'=>((($from + 1 + $view) < $i) ? ($from +  $view) : $i),'TOTAL_NUMBER'=>$i,'SEARCH_TERM'=>$_REQUEST['search']));


		}


		$paginate = '';
		
		if($gamesearch !='' || $i < 0){
			if(defined('SEO') && SEO == TRUE){
                 $paginate = Site_Paginate::nextPrev('search', $from, $view, $i, '-'.$view.'.html', "-".$gamesearch."-".PLATFORM."-", true,true);
			}else{
				$paginate = Site_Paginate::nextPrev(''.$_SERVER['PHP_SELF'].'', $from, $view, $i, '', "search=".$gamesearch."&amp;platform=".PLATFORM."&amp;from=", true);
			}
		/**
		 * TODO add locale and platform to query string
		 */

			$_SESSION['lastsearch'] = SGS_PAGE.'?search='.$_REQUEST['search'].'&from='.$from;

		}

	}else{

		$i='0';
		$searchmessage = $i.' '.Site_Language::display('page_search_message_try');
		$paginate = '';
		$gamelist ='';
	}

	if(!isset($_REQUEST['search'])){
		$searchmessage = '';
	}

	Site_Parse::render_template('main',array('SEARCHCAPTION'=>Site_Language::display('page_search_caption'),'SEARCHFORM'=>$searchform,'SEARCHMESSAGE'=>$searchmessage,'PAGINATE'=>$paginate,'GAMES'=>$gamelist));

	Site_Parse::page_end();
?>