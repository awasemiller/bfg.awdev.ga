<?php
/**
 * Site Main Navigation
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
 * Site Main Navigation
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
class Site_MainNavigation {


        public static function render()
        {
                 $Site_MainNavigation = array();
              
                 $Site_MainNavigation[] = array('name'=>'pc',
                 'href'=>
                     Configuration::get('seo') == true ? SGS_BASE_URL.'download-games.html' : 
                     SGS_BASE_URL.'download-games.php', 
                 'linktext'=>Site_Language::display('main_nav_pc_downloads')
                 );
                 
                 if(Configuration::get('locale') =='en'){
                 
                     $Site_MainNavigation[] = array('name'=>'mac',
                     'href'=>
                         Configuration::get('seo') == true ? SGS_BASE_URL.'new-mac-download-games.html' : 
                         SGS_BASE_URL.'download-games.php?games=new-download&amp;platform=mac', 
                     'linktext'=>Site_Language::display('main_nav_mac_downloads')
                     );                
                 }
                 
                 if(!Configuration::get('ganenabled')){
                 
                     $Site_MainNavigation[] = array('name'=>'og',
                     'href'=>
                         Configuration::get('seo') == true ? SGS_BASE_URL.'online-games.html' : 
                         SGS_BASE_URL.'online-games.php', 
                     'linktext'=>Site_Language::display('main_nav_online_games')
                     );                 
                 
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
				
				$totalLinks = count($Site_MainNavigation);
				$l=0;
				foreach($Site_MainNavigation as $link){
				    
				    $l++;
					$class = ((PLATFORM ==''.$link['name'].'') ? ((LINKCLASS_SEL != '') ? ' class="'.LINKCLASS_SEL.'' : '') : ((LINKCLASS != '') ? ' class="'.LINKCLASS.'' : ''));
					if($class !=''){
						$class .= ($l ==  $totalLinks && defined('LINKCLASS_LAST')) ? ' '.LINKCLASS_LAST.'"' : '"';
					}
					$NavigationRendered .= substr(PRE_LINK,0,-1).''.$class.'><a'.$class.' href="'.$link['href'].'" '.(isset($link['accesskey']) ? 'accesskey="'.$link['accesskey'].'"': '').'>'.LINK_ICON.$link['linktext'].'</a>'.POST_LINK;

				}

				$NavigationRendered .= POST_GAME_LINKS;            
            
			return	$NavigationRendered;

        }   
}
?>