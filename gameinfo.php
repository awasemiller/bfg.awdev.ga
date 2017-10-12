<?php
/**
 * Game Info
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
 * @package SGS
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

/**
 * PNP TOOLS  Game Info
 *
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package SGS
 */

if(isset($_REQUEST['platform']) && in_array($_REQUEST['platform'],array('pc','mac','og'))){
	define('PLATFORM',$_REQUEST['platform']);
}

    require_once('core_gamesite.php');

if (Configuration::get('ganenabled')  && (PLATFORM =='og')) {
    header("Location: index.php");
    exit;    
}    
    
    Site_Parse::page_start(true);
	
	/**
	 * redirect url if error occurs
	 */
	$errorLocation = 'error.php?nogames';

	if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

		header("Location: {$errorLocation}");
		exit;
	}

	/**
	 * call for our game data
	 */
	if(PLATFORM =='og'){
	        
        $game_class = new Site_Online();
		$game = $game_class->getGame(intval($_GET['id']));
		
		
		/**
		 * @todo add ability to download pc or mac if they exist
		 */
        /*
		if(isset($game['pcgameid'])){
            $game_class = new Site_Download();
			$dgame = $game_class->getGame($game['pcgameid'],'',array('platform'=>'pc'));

			if(is_array($dgame)){
				unset($game['shortdesc']);
    			unset($game['meddesc']);
     			unset($game['longdesc']);
    			unset( $game['bullet1']);
      			unset($game['bullet2']);
      			unset($game['bullet3']);
      			unset($game['bullet4']);
      			unset($game['bullet5']);

				$game = array_merge($dgame,$game);
			}
		}
		*/

    }else{

		$game_class = new Site_Download();
		$game = $game_class->getGame(intval($_GET['id']));
		
		/**
		 * add ability to play online if the game exists
		 */

	}

	/**
	 * there was an error with our game data, redirect the user
	 */

	if(!is_array($game)){
		header("Location: {$errorLocation}");
		exit;
	}

	/**
	 * if we made it this far we should be good to display some game content
	 */

	/**
	 * load our main layout
	 */
	if(!Site_Parse::is_template('main')){
		if(!Site_Parse::load_template(Configuration::get('theme_path').'main_gameinfo.html','main')){
			Site_Parse::load_template(Configuration::get('default_theme_path').'main_gameinfo.html','main');
		}
	}

	$game = $game_class->gameInfo($game);

	Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - '.$game['gamename']);

	if($genreinfo = Genre::getGenreInfoByID($game['genreid'])){
		/** set page description */
		Site_Parse::setTag('DESCRIPTION', Configuration::get('description').', '.str_replace("\n",'',$game['gamename'].', '.$game['shortdesc'].', '.$genreinfo['name'].', '.$genreinfo['description'] ));
		/** set page keywords */
		Site_Parse::setTag('KEYWORDS', Configuration::get('keywords').', '.str_replace("\n",'',$game['gamename'].', '.$genreinfo['sname']));
	}

	if(isset($game['hasflash']) && $game['hasflash'] =='yes' && isset($game['flash'])){
        $game['image'] = Site_Elements::gameFlashObject($game);	
	}else{
		$game['image'] = Site_Elements::anchorTag($game['gameinfo_url'], Site_Elements::imageTag($game['feature'], $game['gamename'],'',(defined('FEATURE_IMG_CLASS') ? FEATURE_IMG_CLASS : '')));
	}

	Site_Parse::setTag('BULLETPOINTS', $game_class->gameBullets($game));
	Site_Parse::setTag('SYSREQUIREMENTS', $game_class->gameRequirements($game));

	if($game['hasdownload'] =='yes' && isset($game['download_url']) && $game['download_url'] !=''){
		Site_Parse::setTag('GAMEINFO_FREE_TEXT', Site_Language::display('gameinfo_free_text'));
		Site_Parse::setTag('GAMEINFO_TESTED_TEXT', Site_Language::display('gameinfo_tested_text'));
		if(isset($game['gamesize'])){
		    Site_Parse::setTag('GAMESIZE', '('.$game['gamesize'].')');
		}
	}
	unset($game['gamesize']);

	
	if(isset($game['purchase_game'])){
		Site_Parse::setTag('GAMEINFO_UNLIMITED_TEXT', Site_Language::display('gameinfo_unlimited_text'));
	}
	
	Site_Parse::setTag('GAMEINFO_SCREENSHOTS_TEXT', Site_Language::display('gameinfo_screenshots_text'));
	Site_Parse::setTag('GAMEINFO_IMAGE_TEXT', Site_Language::display('gameinfo_image_text'));

	if(Configuration::get('sitecomments') == true){
		if(Configuration::get('gamecomments') == true){
			Site_Parse::setTag('COMMENTS',Site_Comments::renderComments('game',$game['gameid']));
		}
	}
	
	
	//icons/icon_gameclub_med_sm.gif
	
	Site_Parse::render_template('main',$game);

	
	
	Site_Parse::page_end();
?>