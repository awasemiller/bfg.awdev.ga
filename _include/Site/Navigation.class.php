<?php
/**
 * Site Nav
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
 * Class Site Nav.
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

if(!defined('SGS_INIT')){ exit; }

class Site_Navigation{

		/**
		 * @todo load navigation array should be held in memory once loaded
		 */
		public static $Navigation;
		
		public static $NavigationRendered = null;
		/**
		 * load nav
		 * 
		 * @param void
		 * @return array
		 */
		public static function load_nav(){

			/**
			 * @todo add cache
			 */
			if(is_array(self::$Navigation)){
				return self::$Navigation;
			}
			
		    $sc = new Cache();
		
            $name = 'module_nav_'.LOCALE.'_'.PLATFORM.'_'.Configuration::get('theme_url'); 

           $sc->setFile($name,$options=array('ext'=>'nav','serialize'=>true,'lifetime'=>Configuration::get('lifetime_cache')));
            
			if(isset($_GET['reset']) && $_GET['reset'] =='cache'){

				Cache::expire($name);
			}
                       
            if(!$sc->needNewFile($name)){
              
                self::$Navigation = $sc->load($name);
                return self::$Navigation;
               
            }
        				
			$Navigation = array();
            
			if(PLATFORM =='pc' || PLATFORM =='mac'){
    			/**
    			 * new download link
    			 */
    			$Navigation[] = array('name'=>'new-download','href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'new-'.PLATFORM.'-download-games.html' : SGS_BASE_URL.'download-games.php?games=new-download&amp;platform='.PLATFORM), 'linktext'=>Genre::getGenreNameBySname('glrelease'));
    			/**
    			 * top download link
    			 */
    			$Navigation[] = array('name'=>'top-download','href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'top-'.PLATFORM.'-download-games.html' : SGS_BASE_URL.'download-games.php?games=top-download&amp;platform='.PLATFORM), 'linktext'=>Genre::getGenreNameBySname('glrank'));
    			    
			}else{
    			/**
    			 * new download link
    			 */
    			$Navigation[] = array('name'=>'new-online','href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'new-online-games.html' : SGS_BASE_URL.'online-games.php?games=new-online'), 'linktext'=>Genre::getGenreNameBySname('glreleaseog'));
    			/**
    			 * top download link
    			 */
    			$Navigation[] = array('name'=>'top-online','href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'top-online-games.html' : SGS_BASE_URL.'online-games.php?games=top-online'), 'linktext'=>Genre::getGenreNameBySname('glrankog'));
			    
			}
			
		
			$genreList = Genre::getPrimaryGenreList();

			foreach($genreList as $key=>$genre){

			    
			    if(PLATFORM =='pc' || PLATFORM=='mac'){
			        $count = Site_Download::getGameCounts(array('genre'=>$genre['genreid']));	
			    }else{
			        $count = Site_Online::getGameCounts(array('genre'=>$genre['genreid']));
			    }
			    
				if($count > 0){
				    if(PLATFORM =='pc' || PLATFORM=='mac'){

				        //$Navigation[]= array('name'=>$genre['sname'],'href'=>((defined('SEO') && SEO == true) ? SGS_BASE_URL.'download-'.((defined('ALTVERSION') && ALTVERSION == true)? PLATFORM.'-' : '').$genre['sname'].'-games.html' : SGS_BASE_URL.'download-games.php?games='.$genre['sname'].((defined('ALTVERSION') && ALTVERSION == true) ? '&amp;platform='.PLATFORM : '')), 'linktext'=>$genre['name']);
				        $Navigation[]= array('name'=>$genre['sname'],'href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'download-'.PLATFORM.'-'.$genre['sname'].'-games.html' : SGS_BASE_URL.'download-games.php?games='.$genre['sname'].'&amp;platform='.PLATFORM), 'linktext'=>$genre['name']);
				        
				    }else{
					    $Navigation[]= array('name'=>$genre['sname'],'href'=>(Configuration::get('seo') == true ? SGS_BASE_URL.'online-'.$genre['sname'].'-games.html' : SGS_BASE_URL.'online-games.php?games='.$genre['sname']), 'linktext'=>$genre['name']);
				        
				    }
				}
			}
 
			/**
			 * if we made it this far we need to cache our array
			 * 
			 * set the source and write to file
			 */
			 
			 if(count($Navigation) > 2){
				$sc->save($name,$Navigation);
			 }
			/**
			 * return array
			 */
			 self::$Navigation = $Navigation;
			return self::$Navigation;

		}

		
	/**
		 * @todo rendered navigation should be held in memory once loaded
		 */
				
		/**
		 * nav
		 * @param none
		 * @return string html formatted links
		 */
		public static function nav($options=array())
		{

			//if(!is_null(self::$NavigationRendered)){
			//	return self::$NavigationRendered;
			//}
				
				$Site_Navigation = self::load_nav();

				$return_amount = 7;

				if(isset($options['return'])){
					
					if($options['return']=='all'){
						$return_amount = intval(count($Site_Navigation));
					}else if(is_numeric($options['return'])){
						$return_amount = intval($options['return']);
					}
				}

				if(!defined('PRE_GAME_LINKS')){
					define('PRE_GAME_LINKS', '<ul>');
					define('POST_GAME_LINKS', '</ul>');
					define('PRE_LINK', '<li>');
					define('POST_LINK', '</li>');
					define('LINK_ICON','');
					define('LINKCLASS', '');
					define('LINKCLASS_SEL', 'sel');
					define('LINKCLASS_LAST', 'last');
				}

				$NavigationRendered = PRE_GAME_LINKS;

				/**
				 * 	@todo pref genre ordering by locale	
				 */	

				
				
				$pref = array(
					'new-download'=>0,
				    'top-download'=>1,
					'new-online'=>0,
				    'top-online'=>1,
				    'action'=>2,
				    'mahjong'=>3,
				    'puzzle'=>4,
				    'card'=>5,
				    'word'=>6,
				    'hidden'=>7,
				    'match3'=>8,
				    'marble'=>9,
				    'brain'=>10,
				    'adventure_large'=>11,
				    'adventure'=>12,
				    'time'=>13,
				    'kids'=> 14,
				    'strategy'=>15
			    );
		
								
				$s=0;
				
				
				foreach($Site_Navigation as $key=>$value){
					$navKey[$value['name']] = isset($pref[$value['name']]) ? $pref[$value['name']] : $s;
					$s++;
				}

				array_multisort($navKey,SORT_ASC, SORT_NUMERIC, $Site_Navigation);

			
				$l = 1;

				foreach($Site_Navigation as $link){
					$class = (((isset($_GET['games']) ? $_GET['games'] : NULL) ==''.$link['name'].'') ? ((LINKCLASS_SEL != '') ? ' class="'.LINKCLASS_SEL.'' : '') : ((LINKCLASS != '') ? ' class="'.LINKCLASS.'' : ''));
					if($class !=''){
						$class .= ($l ==  $return_amount && defined('LINKCLASS_LAST')) ? ' '.LINKCLASS_LAST.'"' : '"';
					}
					$NavigationRendered .= substr(PRE_LINK,0,-1).''.$class.'><a'.$class.' href="'.$link['href'].'" '.(isset($link['accesskey']) ? 'accesskey="'.$link['accesskey'].'"': '').'>'.LINK_ICON.$link['linktext'].'</a>'.POST_LINK;
					$l++;

					if($l > $return_amount){
						break;
					}
				}

				$NavigationRendered .= POST_GAME_LINKS;
				//self::$NavigationRendered = $NavigationRendered;
				return $NavigationRendered;
		}

}
?>