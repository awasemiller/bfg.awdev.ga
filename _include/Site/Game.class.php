<?php
/**
 * Site Game
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
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Class Site Game.
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

if(!defined('SGS_INIT')){ exit; }

class Site_Game {

		/**
		 * comment countlist
		 */
		private static $comments;


		/**
		 * getImageAsset
		 *
		 * @param string $name can be any named image found in bfggamexml
		 * @param array $game current game array
		 *
		 * @return mixed string image/flash url | bool False
		 */
		function getImageAsset($name, $game='')
		{
		    
		    $assets = Game_Assets::create($game);
		    
			if(!isset($assets[$name])){
				return false;
			}
			
			return $assets[$name];
		}

		/**
		 * checkValues
		 *
		 * @param array $keys keys to check
		 * @param array $game
		 *
		 * @return bool
		 */
		public static function checkValues($keys,$game){

			foreach($keys as $key){

				if(!array_key_exists($key,$game)){
					return false;
				}
				if(!isset($game[$key]) || $game[$key] == false){
					return false;
				}
			}

			return TRUE;
		}

		/**
		 * cleanFolderName
		 *
		 * @param array $game
		 *
		 * @return string folder name
		 */
		public static function cleanFolderName($game)
		{
			if(!isset($game['foldername'])){
				return false;
			}
			
			$folderNameArray =explode('_',$game['foldername']);
			
			$search = array(array_shift($folderNameArray),'_',':',' - ','  ','');
			$replace = array('','','-','','-','');

			return str_replace($search,$replace, $game['foldername']);

		}

		/**
		 * convertReleaseDate
		 *
		 * @param array $game
		 * @param array $options [ month = string month date format  | day = string day date format | year = string year date format ]
		 *
		 * @return array $game with mon, day and year keys added to array stack
		 */
		public static function convertReleaseDate($game,$options=array())
		{
			if(!isset($game['releasedate'])){
				return $game;
			}

			$date = explode(' ', $game['releasedate']);
			$date = explode('-', $date[0]);
			$timestamp = mktime('0', '0', '0', $date[1], $date[2], $date[0]);

			if(isset($options['month'])){
				$game['mon'] = ucfirst(date($options['month'],$timestamp));
			}else{
				$game['mon'] = ucfirst(date('M',$timestamp));
			}

			if(isset($options['day'])){
				$game['day'] = date($options['day'],$timestamp);
			}else{
				$game['day'] = date('jS',$timestamp);
			}

			if(isset($options['year'])){
				$game['year'] = date($options['year'],$timestamp);
			}else{
				$game['year'] = date('Y',$timestamp);
			}

			return $game;
		}

		/**
		 * gameInfo
		 *
		 * @param array $game
		 *
		 * @return array $game with additional key and value information
		 */
		public static function gameInfo($game)
		{
			
			if(!is_array($game) || !isset($game['gameid']) || !is_numeric($game['gameid'])){
				return false;
			}
			
			$game = array_change_key_case($game, CASE_LOWER);
			
			$gameInfo = new Game_Information((!isset($game['platform']) ? 'pc' : $game['platform']), $locale=LOCALE);

			$game = $gameInfo->get($game);
			
			$game = self::convertReleaseDate($game);
		
			if(isset($game['gamesize'])){			    
				$game['gamesize'] = File::bytesToReadableSize($game['gamesize']);
			}

			/**
			 * if ALTVERSION is turned off lets unset alt game id's to speed things up a bit.
			 */

			if(Configuration::get('altversion') == false){
				unset($game['pcgameid'],$game['macgameid'],$game['oggameid']);
			}
			
			$platform = strtolower($game['platform']);

			$game['gameinfo_url'] = 'gameinfo.php?id='.$game['gameid'].'&amp;foldername='.self::cleanFolderName($game).'&amp;locale='.LOCALE.'&amp;platform='.$platform;

			if(isset($game['hasdownload']) && $game['hasdownload'] =='yes'){

				if($game['platform'] == 'og'){
				
					if(isset($game['download_mac'])){
				        $game['download_url'] = $game['download_mac'];
				    }					
					if(isset($game['download_pc'])){
				        $game['download_url'] = $game['download_pc'];
				    }						
					
				}else{
					if(isset($game['download_'.$game['platform']])){
				        $game['download_url'] = $game['download_'.$game['platform']];
				    }					
					
				}	
    
			}
			
			
			if(isset($game['purchase_game'])){
			    $game['buy_url'] = $game['purchase_game'];
			}

			if (!Configuration::get('ganenabled')) {
    			if($platform =='og'){
    			    if(Configuration::get('seo') == true){
    			        $game['play_url'] = 'play_'.$game['gameid'].'_'.self::cleanFolderName($game).'.html';
    			    }else{
    				    $game['play_url'] = 'play.php?id='.$game['gameid'];
    			    }
    			}else if(isset($game['oggameid'])){
    			    if(Configuration::get('seo') == true){
    			        $game['play_url'] = 'play_'.$game['oggameid'].'_'.self::cleanFolderName($game).'.html';
    			    }else{
    				    $game['play_url'] = 'play.php?id='.$game['oggameid'];
    			    }
    			}
			}
			
			
			/**
			 * SEO gameinfo_url, download_url, buy_url and play_url
			 */

			if(Configuration::get('seo') == true){

				$game['gameinfo_url'] = 'game_'.$game['gameid'].'_'.self::cleanFolderName($game).'_'.LOCALE.'_'.$platform.'.html';
			}

			/**
			 * GAME INFO URL'S AND LINKS
			 */

			$game['link'] = Site_Elements::anchorTag($game['gameinfo_url'], $game['gamename']);
			$game['readmorelink'] = Site_Elements::anchorTag($game['gameinfo_url'], Site_Language::display('read_more'),'','readmore');

			/**
			 * DOWNLOAD URL AND BUTTON
			 */
			
			if($game['hasdownload'] =='yes' && isset($game['download_url'])){
					$game['downloadbutton'] = Site_Elements::anchorTag($game['download_url'], '<span>'.Site_Language::display('btn_download').'</span>', '', $class='btn btn_download', '', Site_Language::display('btn_download').': '.$game['gamename'], '');
			}else{
				$game['download_url'] = NULL;
				$game['downloadbutton'] = NULL;
			}

			/**
			 * BUY URL AND BUTTON
			 */

			if(isset($game['buy_url'])){
					$game['buybutton'] = Site_Elements::anchorTag($game['buy_url'], '<span>'.Site_Language::display('btn_buy').'</span>', '', $class='btn btn_cart', '', Site_Language::display('btn_buy').': '.$game['gamename'], '_blank');
			}else{
				$game['buy_url'] = NULL;
				$game['buybutton'] = NULL;
			}

			/**
			 * PLAY URL AND BUTTON
			 */

			if(isset($game['play_url'])){
				$game['playbutton'] = Site_Elements::anchorTag($game['play_url'], '<span>'.Site_Language::display('btn_play').'</span>', '', $class='btn btn_play', '', 'Play : '.$game['gamename'], '');
			}

			/**
			 * SCREENSHOT LINKS
			 */
                                                                                         
			$game['screenshot1'] = Site_Elements::anchorTag($game['screen1'], Site_Elements::imageTag($game['thumb1'], $game['gamename'],'','','125px', '94px'), 'screen1');
			$game['screenshot2'] = Site_Elements::anchorTag($game['screen2'], Site_Elements::imageTag($game['thumb2'], $game['gamename'],'','','125px', '94px'), 'screen2');
			$game['screenshot3'] = Site_Elements::anchorTag($game['screen3'], Site_Elements::imageTag($game['thumb3'], $game['gamename'],'','','125px', '94px'), 'screen3');
			

			/**
			 * Gametype Icon
			 */

			$game['platformicon'] = Site_Elements::imageTag(SGS_BASE_URL.'images/icons/icon_'.PLATFORM.'_sm.gif', PLATFORM.' game','','icon');

			/**
			 * alversion icons
			 * altversion button
			 * altversion button show mac as altverson when viewing pc or online games
			 */

			
			if(Configuration::get('altversion') && Configuration::get('altversion') == true){

				if(isset($game['macgameid']) || $platform == 'mac'){
					$game['hasmacicon'] = Site_Elements::imageTag(SGS_BASE_URL.'images/icons/icon_mac_sm.gif', 'mac game','','icon');
				}

				if(isset($game['pcgameid']) || $platform == 'pc'){
					$game['haspcicon'] = Site_Elements::imageTag(SGS_BASE_URL.'images/icons/icon_pc_sm.gif', 'pc game','','icon');
				}
				
                if (!Configuration::get('ganenabled')) {
    				if(isset($game['oggameid']) || $platform == 'og'){
    					$game['hasogicon'] = Site_Elements::imageTag(SGS_BASE_URL.'images/icons/icon_og_sm.gif', 'online game','','icon');
    				}
                }
				if(isset($game['macgameid']) && PLATFORM != 'mac'){

					$altversion = 'mac';
					$alttext = 'Available For Mac';

					$game['altversion_url'] = 'gameinfo.php?id='.$game['macgameid'].'&foldername='.self::cleanFolderName($game).'&locale='.LOCALE.'&platform=mac';

					if(Configuration::get('seo') == true){
						$game['altversion_url'] = 'game_'.$game['macgameid'].'_'.self::cleanFolderName($game).'_'.LOCALE.'_mac.html';
					}

				}else if(isset($game['pcgameid']) && PLATFORM != 'pc' && PLATFORM != 'og'){

					$altversion = 'pc';
					$alttext = 'Available For Pc';

					$game['altversion_url'] = 'gameinfo.php?id='.$game['pcgameid'].'&foldername='.self::cleanFolderName($game).'&locale='.LOCALE.'&platform=pc';

					if(Configuration::get('seo') == true){
						$game['altversion_url'] = 'game_'.trim($game['pcgameid']).'_'.self::cleanFolderName($game).'_'.LOCALE.'_pc.html';
					}
				}

				if(isset($game['altversion_url'])){
					$game['altversion'] = Site_Elements::anchorTag($game['altversion_url'], $alttext, $id='btn'.$altversion, $class='btn btn_'.$altversion, $js='', $game['gamename'], $target='', $rel='');
				}
			}

			/**
			 * VIDEO BUTTON
			 */

			
			if(isset($game['video'])){
				$game['video'] = Site_Elements::anchorTag($game['video'], '<span>'.Site_Language::display('btn_video').'</span>', $id='', $class='btn btn_video', '', $title='', $rel='');
			}

			/**
			 * Genre Name
			 */

			if(isset($game['genreid'])){
			    
				$info = Genre::getGenreInfoByID($game['genreid']);
				$game['genrename'] = $info['name'];
			}

			/**
			 * Comment links
			 */

			if(Configuration::get('sitecomments')){
				if(Configuration::get('gamecomments')){

					if(!is_array(self::$comments)){
						self::$comments = Site_Comments::loadCounterFile('game');
					}

					if(array_key_exists($game['gameid'],self::$comments)){
						$game['commentcount'] = self::$comments[$game['gameid']]['count'];
					}

					if(isset($game['commentcount'])){
						$game['commentlink'] = Site_Elements::anchorTag($game['gameinfo_url'].'#comments', Site_Comments::getText('comments_txt').' ('.$game['commentcount'].')','','comments');
					}else{
						$game['commentlink'] = Site_Elements::anchorTag($game['gameinfo_url'].'#comments', Site_Comments::getText('comments_txt').' (0)','','comments');
					}
				}
			}

			return $game;
		}

		/**
		 * gameBullets
		 *
		 * @param array $game array
		 *
		 * @return string html format available bullet descriptions
		 */
		function gameBullets($game)
		{
			
		    $hasBullets = false;
		    
		 	if(!defined('PRE_BULLET_POINTS')){
				define('PRE_BULLET_POINTS', '<ul>');
				define('POST_BULLET_POINTS', '</ul>');
				define('PRE_BULLET', '<li>');
				define('POST_BULLET', '</li>');
			}

			$bullets = array(
						'bullet1'=>isset($game['bullet1']) ? $game['bullet1'] : '',
						'bullet2' =>isset($game['bullet2']) ? $game['bullet2'] : '',
						'bullet3'=>isset($game['bullet3']) ? $game['bullet3'] : '',
						'bullet4'=>isset($game['bullet4']) ? $game['bullet4'] : '',
						'bullet5'=>isset($game['bullet5']) ? $game['bullet5'] : ''
			);

			$bulletpoints = PRE_BULLET_POINTS."\n";

			foreach($bullets as $key=>$bullet){
				if($bullet !='' || $bullet !=null){
				    $hasBullets = true;
					$bulletpoints .= '  '.PRE_BULLET.$bullet.POST_BULLET."\n";
				}
			}

			$bulletpoints .= POST_BULLET_POINTS."\n";
			
			if(!$hasBullets){
			    return null;
			}
			
			return Site_Parse::parse_codes($bulletpoints);
		}

		/**
		 * gameRequirements
		 *
		 * @param array $game array
		 *
		 * @return string html format system requirement descriptions
		 */
		function gameRequirements($game)
		{
			$hasRequirements = false;
			
		 	if(!defined('PRE_REQUIREMENTS')){
				define('PRE_REQUIREMENTS_HEADER', '<h4>');
				define('POST_REQUIREMENTS_HEADER', '</h4>');
				define('PRE_REQUIREMENTS', '<ul>');
				define('POST_REQUIREMENTS', '</ul>');
				define('PRE_REQUIREMENT', '<li>');
				define('POST_REQUIREMENT', '</li>');
				define('PRE_REQUIREMENT_LABEL', '<strong>');
				define('POST_REQUIREMENT_LABEL', '</strong>');
			}

			$requirements = array(
				'sysreqos'=>isset($game['sysreqos']) ? $game['sysreqos'] : '',
				'sysreqmhz' =>isset($game['sysreqmhz']) ? $game['sysreqmhz'] : '',
				'sysreqvideo'=>isset($game['sysreqvideo']) ? $game['sysreqvideo'] : '',
				'sysreqmem'=>isset($game['sysreqmem']) ? $game['sysreqmem'].' MB' : '',
				'sysreq3d'=>isset($game['sysreq3d']) ? $game['sysreq3d'] : '',
				'sysreqdx'=>isset($game['sysreqdx']) ? $game['sysreqdx'] : '',
				'sysreqhd'=>isset($game['sysreqhd']) ? $game['sysreqhd'].' MB' : '',
				'sysreqother'=>isset($game['sysreqother']) ? $game['sysreqother'] : ''
			);

			$sysrequirements = '';

			if(!defined('REQUIREMENTS_HEADER') || defined('REQUIREMENTS_HEADER') && REQUIREMENTS_HEADER !=false){
				$sysrequirements = PRE_REQUIREMENTS_HEADER.Site_Language::display('sysreqs').POST_REQUIREMENTS_HEADER;
			}

			$sysrequirements .= PRE_REQUIREMENTS."\n";

			foreach($requirements as $key=>$requirement){
				if($requirement !='' || $requirement !=null){
				    $hasRequirements = true;
					$sysrequirements .= '  '.PRE_REQUIREMENT.PRE_REQUIREMENT_LABEL.Site_Language::display($key).POST_REQUIREMENT_LABEL.' '.$requirement.POST_REQUIREMENT."\n";
				}
			}

			$sysrequirements .= POST_REQUIREMENTS."\n";
            
			if(!$hasRequirements){
			    return null;
			}
			
			return Site_Parse::parse_codes($sysrequirements);
		}

		/**
		 * sortList
		 *
		 * @param array $options
		 *
		 * @return string html form
		 */
		function sortList($options = array())
		{

			Site_Forms::start_form('sortlist', (isset($options['url']) ? $options['url'] : $_SERVER['PHP_SELF']),'get');
			Site_Forms::add_plain_html(defined('SORTLIST_OPEN') ? SORTLIST_OPEN : '<div>');
            $platform = isset($_POST['platform']) ? $_POST['platform'] : (isset($_GET['platform']) ? $_GET['platform'] : 'pc');
    
           // remove online for gan ,array('og'=>'Online Games')
            //Site_Forms::add_plain_html('<div style="display:block; clear:both">');
            //Site_Forms::add_select_item('platform', array(array('pc'=>'PC'),array('mac'=>'MAC')), $platform, 'Platform','textbox');			
			//Site_Forms::add_plain_html('</div>');
			/**
			 * genre select list
			 */

			if(isset($options['select_genre']) && is_array($options['select_genre'])){
				$select_genre = $options['select_genre'];
			}else{
				$select_genre = array(
					array('all'=>Site_Language::display('select_genre_all')),
					array('action'=>Site_Language::display('select_genre_action')),
					array('card'=>Site_Language::display('select_genre_card')),
					array('jigsaw'=>Site_Language::display('select_genre_jigsaw')),
					array('mahjong'=>Site_Language::display('select_genre_mahjong')),
					array('puzzle'=>Site_Language::display('select_genre_puzzle')),
					array('word'=>Site_Language::display('select_genre_word'))
					);
			}

			Site_Forms::add_select_item('genre', $select_genre, isset($_REQUEST['genre']) ? $_REQUEST['genre'] : 'all',Site_Language::display('label_genre'),'textbox');

			/**
			 * sort select list
			 */
			$select_sort = array(
				array('date'=>Site_Language::display('select_sort_date')),
				array('rank'=>Site_Language::display('select_sort_rank')),
				array('name'=>Site_Language::display('select_sort_name'))
			);

			Site_Forms::add_select_item('sort', $select_sort, isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'date',Site_Language::display('label_sort'),'textbox');

			/**
			 * order select list
			 */
			$select_order = array(
				array('asc'=>Site_Language::display('select_order_asc')),
				array('desc'=>Site_Language::display('select_order_desc'))
			);

			Site_Forms::add_select_item('order', $select_order, isset($_REQUEST['order']) ? $_REQUEST['order'] : 'desc', Site_Language::display('label_order'),'textbox');

			
			
			/**
			 * hidden from
			 */

			
			
			Site_Forms::add_hidden_data('from', isset($_REQUEST['from']) ? $_REQUEST['from'] : '0');

			/**
			 * hidden locale
			 */
			if(isset($_REQUEST['locale']) && in_array(strtolower($_REQUEST['locale']),Site_Language::$locales)){

				Site_Forms::add_hidden_data('locale', $_REQUEST['locale']);
			}

			/**
			 * platform temp platform request
			 */

			if(isset($_REQUEST['platform']) && in_array(strtolower($_REQUEST['platform']),array('pc','mac','og'))){
				Site_Forms::add_hidden_data('platform', $_REQUEST['platform']);
			}

			/**
			 * submit button
			 */
			Site_Forms::add_button('submit', Site_Language::display('select_submit'),'submit','button');
			Site_Forms::add_plain_html(defined('SORTLIST_CLOSE') ? SORTLIST_CLOSE : '</div>');
			return Site_Forms::return_form();
		}


		/**
		 * getGame
		 *
		 * @param array $gameList game list
		 * @param int $gameId
		 * @param string $gameKey alternate gameid key field to search
		 *
		 * @return mixed array game | bool false
		 */

		public static function getGame($gameList,$gameId='',$gameKey='')
		{
			if(!is_array($gameList)){
				return false;
			}

			foreach($gameList as $game){

				if($gameKey !=''){

					if(isset($game[''.$gameKey.'']) && $gameId == $game[''.$gameKey.'']){
						
						unset($gameList); // memory cleanup
							
						return array_change_key_case($game, CASE_LOWER);

					}
				}else{

					if($gameId == $game['gameid']){
							
						unset($gameList); // memory cleanup
							 
						return array_change_key_case($game, CASE_LOWER);
					}
				}
			}	
				 
			unset($gameList); // memory cleanup
				 
			return false;
		}

	

		/**
		 * setFeatureGame
		 *
		 * @param array $game
		 * @return bool
		 */

		function setFeatureGame($game)
		{
  

			if(!is_array($game)){
				return false;
			}

			if(!Site_Parse::is_template('feature')){
				if(!Site_Parse::load_template(Configuration::get('theme_path').'feature.html','feature')){
					Site_Parse::load_template(Configuration::get('default_theme_path').'feature.html','feature');
				}
			}

			$game = self::gameInfo($game);

			if($game){
				$game['number'] = '1';
				if((Configuration::get('feature_flash')== 1) && $game['hasflash'] =='yes' && isset($game['flash'])){

					$game['image'] = Site_Elements::gameFlashObject($game);
		    
				}else{
				    
				    
					$game['image'] = Site_Elements::anchorTag($game['gameinfo_url'], Site_Elements::imageTag($game['feature'], $game['gamename'],'',(defined('FEATURE_IMG_CLASS') ? FEATURE_IMG_CLASS : '')));
				}

				Site_Parse::setTag('GAME1',Site_Parse::render_template('feature',$game,TRUE));
			}
		
			
			Site_Parse::unload_template('feature');
			
			
			unset($game);
			
			return TRUE;
			
			
			
		}
		/**
		 * setSubFeatureGames
		 *
		 * @param array $games
		 *
		 * @return bool
		 */

		public static function setSubFeatureGames($games)
		{
			if(!is_array($games)){
				return false;
			}

			if(!Site_Parse::is_template('subfeature')){
				if(!Site_Parse::load_template(Configuration::get('theme_path').'subfeature.html','subfeature')){
					Site_Parse::load_template(Configuration::get('default_theme_path').'subfeature.html','subfeature');
				}
			}

			$number = 2;

			foreach($games as $game){

				$game = self::gameInfo($game);

				
				$game['number'] = $number;

				if(self::checkValues(array('gamename','gameinfo_url','med'),$game)){
					$game['image'] = Site_Elements::anchorTag($game['gameinfo_url'], Site_Elements::imageTag($game['med'], $game['gamename'],'',(defined('SUBFEATURE_IMG_CLASS') ? SUBFEATURE_IMG_CLASS : '')));
				}
				Site_Parse::setTag('GAME'.$number.'',Site_Parse::render_template('subfeature',$game,TRUE));

				$number++;
			}
			/**
			 * cleanup
			 */
			 
			 
			Site_Parse::unload_template('subfeature');
			unset($games, $game, $number);
			return TRUE;
		}

		/**
		 * genreList
		 *
		 * used to generate formatted game list.
		 *
		 * @param array $gameList list of games
		 * @param string $genreListCaption
		 * @param array $options [platform=>og| return=>TRUE]
		 *
		 * @return array
		 */

		function setGenreList($gameList,$genreListCaption='',$options=array())
		{

		    
		   
			if(!is_array($gameList)){
				return false;
			}

			/**
			 * GENRE LIST
			 *
			 * build an alphabetical Genre List from the current genre
			 *
			 */
			/** check for template genrecolums constant, if not found default to three columns */
			if(!defined('GENRECOLUMNS')){
				define('GENRECOLUMNS', '3');
			}

			$list_total = count($gameList);

			
			/**
			 * Split the gameList) array into three equal genreList arrays by default.
			 * The number of arrays depends on the amount set by the GENRECOLUMNS constant.
			 *
			 * If for some reason our game count is less then the required columns
			 * we'll unset the genre lists.
			 *
			 * We will also shift the key value of the main arrays by 1 so the first genrelist parse tag can be set as {LIST1}
			 */

			if(count($gameList) >= GENRECOLUMNS){
				$genreList = array_chunk($gameList, round($list_total / GENRECOLUMNS));

				foreach($genreList as $key=>$value){
					$newList[($key +1)] = $value;
				}
				$genreList = $newList;

				unset($newList);
			}else{
				$genreList = null;
			}

			if(is_null($genreList)){
			    Site_Parse::setTag('GENRELIST','');
			    return false;
			}
			
			
			
			/** free gameList  were finished with it. */
			unset($gameList);

			/**
			 *  Add extra blank / dummy games to un-equal game arrays.
			 */

			if(is_array($genreList)){

				foreach($genreList as $key=>$value){
					while(count($genreList[1])-count($genreList[''.$key.'']) != 0){
						array_push($genreList[''.$key.''],array('gameid'=>'#','gamename'=>'&nbsp;'));
					}
				}
			}

			if(is_array($genreList)){
				/** set odd evon classes for row color switching */
				if(defined('ODD_CLASS') && defined('EVON_CLASS')){
					$class = EVON_CLASS;
					$evon = EVON_CLASS;
					$odd = ODD_CLASS;
				}else{
					$class = 'evon';
					$evon = 'evon';
					$odd = 'odd';
				}

				/** if the template requires the List genre style */
				if(!defined('GENRE_STYLE') || defined('GENRE_STYLE') && GENRE_STYLE !='table'){

					/** start genrelist list */
					$gamelink = array_fill(0, GENRECOLUMNS+1, NULL);
					/** total number of game rows, used to close list only */
					$rowcount = count($genreList[1]);

				}else{
					/** if the template requires the table genre style */
					/** start genrelist table */
					if(defined('GENRE_TABLE_OPEN')){
						$genretable = GENRE_TABLE_OPEN;
					}else{
						$genretable = '<table style="width:514px">'."\n";
					}

					if(!defined('TDWIDTH')){
						define('TDWIDTH', round((100 / GENRECOLUMNS)));
					}

					if(defined('GENRE_TABLE_HEADER')){
					     /** set table header if it exists, parse caption tag if found in the header */
						$genretable .= Site_Parse::parse_layout(GENRE_TABLE_HEADER,array('GENRELIST_CAPTION'=>$genreListCaption));
					}
				}

				/** The fun begins here :P */
				$mywidth = intval(round(100 / GENRECOLUMNS));
				

				foreach($genreList[1] as $key=>$column){

					$class = ($class == $odd ? $evon : $odd);

					for($i=1; $i<=GENRECOLUMNS;$i++){

						/**
						 * get additional game information
						 */
						$genreList[$i][$key] = $this->gameInfo($genreList[$i][$key]);

						/** if template defined table build table else build list */
						if(defined('GENRE_STYLE') && GENRE_STYLE =='table'){
							/** build table rows */
							/** check for pre column defines */
							if(!defined('PRE_COLUMN_'.$i)){
								define('PRE_COLUMN_'.$i, ($i == 1) ? str_replace('TDVAR', 'style=width:'.$mywidth.'%', '<tr class="{CLASS}">'."\n".'<td TDVAR>'."\n") : str_replace('TDVAR', 'style=width:'.$mywidth.'%', "\n".'<td TDVAR>'."\n"));
							}
							/** check for post column defines */
							if(!defined('POST_COLUMN_'.$i)){
								define('POST_COLUMN_'.$i,($i == 1 && GENRECOLUMNS !=1) ? '</td>'."\n" : (($i != GENRECOLUMNS) ?  '</td>'."\n" : "\n".'</td>'."\n".'</tr>'."\n"));
							}
							/** if we have an empty game we'll add an non breaking space */
							if($genreList[$i][$key]['gameid'] == '#'){
								$genretable .= str_replace('{CLASS}', $class, constant('PRE_COLUMN_'.$i)).'&nbsp;'.constant('POST_COLUMN_'.$i);
							}else{
								$genretable .= str_replace('{CLASS}', $class, constant('PRE_COLUMN_'.$i)).$genreList[$i][$key]['link'].constant('POST_COLUMN_'.$i);
							}

						}else{
							/** build list */
							if(!defined('PRE_GENRE_LIST')){
								define('PRE_GENRE_LIST','<ul>'."\n");
							}
							if(!defined('POST_GENRE_LIST')){
								define('POST_GENRE_LIST','</ul>'."\n");
							}
							if(!defined('PRE_GENRE_LINK')){
								define('PRE_GENRE_LINK','<li>');
							}
							if(!defined('POST_GENRE_LINK')){
								define('POST_GENRE_LINK','</li>');
							}
							if(empty($gamelink[$i])){
								$gamelink[$i] .= PRE_GENRE_LIST;
							}
							/** if we have an empty game we'll add a span and a non-breaking space */
							if($genreList[$i][$key]['gameid'] == '#'){
								$gamelink[$i] .= str_replace('{CLASS}', $class, PRE_GENRE_LINK).'<span>&nbsp;</span>'.POST_GENRE_LINK;
							}else{
								$gamelink[$i] .= str_replace('{CLASS}', $class, PRE_GENRE_LINK).$genreList[$i][$key]['link'].POST_GENRE_LINK;
							}
							if($key+1 == $rowcount){
								$gamelink[$i] .= POST_GENRE_LIST;
							}
						}
					}
				}

				/** if the template genre style is table close it now else close the list */
				if(defined('GENRE_STYLE') && GENRE_STYLE =='table'){

					if(defined('GENRE_TABLE_CLOSE')){
						$genretable .= GENRE_TABLE_CLOSE;
					}else{
						$genretable .= '</table>'."\n";
					}

					/** assign table to list1 parse tag var */
					$gameList['list1'] = $genretable;
					unset($genretable);
				}else{
					/** assign each list to there respective parse tag var */

					foreach($gamelink as $key=>$value){
						$gameList['list'.$key] = $value;
					}
					array_shift($gameList);
					unset($gamelink);
				}
			}

			if(isset($options['return']) && $options['return'] == TRUE){
				return $gameList;
			}

			if(!Site_Parse::is_template('genrelist')){
				if(!Site_Parse::load_template(Configuration::get('theme_path').'genrelist.html','genrelist')){
					Site_Parse::load_template(Configuration::get('default_theme_path').'genrelist.html','genrelist');
				}
			}

			$gameList['genrelistcaption'] = $genreListCaption;

			Site_Parse::setTag('GENRELIST',Site_Parse::render_template('genrelist',$gameList,TRUE));
			
			/**
			 * cleanup
			 */
			Site_Parse::unload_template('genrelist');
			
			
		}

	/**
	 * processPageRequest
	 *
	 * @param string $request
	 * $param int $genreId
	 *
	 * @return void
	 *
	 */
	public function processPageRequest($request,$genreInfo){
    
	        if(!($this instanceof Site_Download) && !($this instanceof Site_Online)){
	            return false;
	        }
			/**
			 * set the page title
			 */

			Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - '.$genreInfo['name']);

			/**
			 * page caption
			 */

			Site_Parse::setTag('CAPTION',Site_Parse::parse_layout(Site_Language::display('featureListCaption'),array('GENRENAME'=>$genreInfo['name'])));

			/**
			 * page text
			 */

			Site_Parse::setTag('TEXT',$genreInfo['description']);

			switch ($request){

				case 'glreleaseog':

					$featureGame = $this->getDateList('1');
        
					$featureGame = $featureGame[0];				
					$this->setFeatureGame($featureGame);
					$this->setSubFeatureGames($this->getDateList(SUBFEATUREGAMES_AMOUNT,'1'));

				break;

				case 'glrankog':
                    
					$featureGame = $this->getCountList('1');
					$featureGame = $featureGame[0];
					$this->setFeatureGame($featureGame);				
					$this->setSubFeatureGames($this->getCountList(SUBFEATUREGAMES_AMOUNT,'1'));

				break;

                case 'glrelease':

					$featureGame = $this->getDateList('1');
        
					$featureGame = $featureGame[0];				
					$this->setFeatureGame($featureGame);
					$this->setSubFeatureGames($this->getDateList(SUBFEATUREGAMES_AMOUNT,'1'));

				break;

				case 'glrank':

					$featureGame = $this->getRankList('1');
					$featureGame = $featureGame[0];
					$this->setFeatureGame($featureGame);				
					$this->setSubFeatureGames($this->getRankList(SUBFEATUREGAMES_AMOUNT,'1'));

				break;

				default:

					if($this instanceof Site_Online) {
    				    // if type og
    					$featureGame = $this->getCountList('1','0', array('genre'=>$genreInfo['genreid']));
    					$featureGame = $featureGame[0];
    					$this->setFeatureGame($featureGame);
    					$this->setSubFeatureGames($this->getCountList(SUBFEATUREGAMES_AMOUNT,'1',array('genre'=>$genreInfo['genreid'])));
				    }else{
				        
					    $featureGame = $this->getRankList('1','0', array('genre'=>$genreInfo['genreid']));
					    $featureGame = $featureGame[0];
					    $this->setFeatureGame($featureGame);
					    $this->setSubFeatureGames($this->getRankList(SUBFEATUREGAMES_AMOUNT,'1',array('genre'=>$genreInfo['genreid'])));
				        
				    }

					$genreListCaption = Site_Parse::parse_layout(Site_Language::display('genreListCaption'),array('GENRENAME'=>$genreInfo['name']));
					$this->setGenreList($this->getNameList('all','0', array('genre'=>$genreInfo['genreid'])),$genreListCaption);
			}

			if(isset($featureGame) && is_array($featureGame)){
				$featureGame = array_change_key_case($featureGame, CASE_LOWER);
			}else{
				$location = SGS_BASE_URL.'error.php?nogames';
				header("Location: {$location}");
				exit;
			}

			/**
			 * set page description
			 */
			Site_Parse::setTag('DESCRIPTION', Configuration::get('description').', '.str_replace("\n",'',(isset($featureGame['gamename']) ? $featureGame['gamename'].', ' : '').(isset($featureGame['shortdesc']) ? $featureGame['shortdesc'].', ' : '').$genreInfo['name'].', '.$genreInfo['description']));
			/**
			 * set page keywords
			 */
			Site_Parse::setTag('KEYWORDS', Configuration::get('keywords').', '.str_replace("\n",'',(isset($featureGame['gamename']) ? $featureGame['gamename'].', ' : '').$genreInfo['name']));

			return true;
	}		

}
?>