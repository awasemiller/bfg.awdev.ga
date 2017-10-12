<?php
/**
 * Template ravenhearst 2-0
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
/**
 * Custom template functions and configuration options.
 */
if(!defined('SGS_INIT')){ exit; }

// SGS VERSION
$sgs_version = '1.0';

// Game Nav Settings also used for featured areas module
define('PRE_GAME_LINKS', '<ul>');
define('POST_GAME_LINKS', '</ul>');
define('PRE_LINK', '<li>');
define('POST_LINK', '</li>');
define('LINK_ICON','');
define('LINKCLASS', '');
define('LINKCLASS_SEL', 'current');
define('LINKCLASS_LAST', 'last');
// GAMENAV AMOUNT TO DISPLAY mixed [ all, numeric value, default 7 ] 
// define('GAMENAV_AMOUNT', 'all');


// Genre List Settings
define('GENRELINK_CLASS','genrelink');
define('GENRELINK_NO_MULTICLASS',TRUE); // disable odd evon classes on links
define('ODD_CLASS','row-a');
define('EVON_CLASS','row-b');
define('GENRE_STYLE','table'); // table | list | none
define('GENRECOLUMNS','2');

// genre list settings
define('PRE_GENRE_LIST','<ul>'."\n");
define('POST_GENRE_LIST','</ul>'."\n");
define('PRE_GENRE_LINK','<li class="{CLASS}">'."\n");
define('POST_GENRE_LINK','</li>'."\n");

// genre table settings
define('GENRE_TABLE_OPEN','<table style="width:500px">');
//define('GENRE_TABLE_HEADER','<tr><th colspan="2"><h3>{GENRELIST_CAPTION}</h3></th></tr>');
define('PRE_COLUMN_1',"\n  ".'<tr class="{CLASS}">'."\n  ".'<td class="first">'."\n");
define('POST_COLUMN_1','</td>'."\n");
define('PRE_COLUMN_2','<td style="width:50%">'."\n");
define('POST_COLUMN_2','</td></tr>'."\n");
define('GENRE_TABLE_CLOSE','</table>');
// Sort List Setting
/*define('SORTLIST_OPEN','<p>');
define('SORTLIST_CLOSE','</p>');
*/
// Browse Menu Settings
/*define('PRE_BROWSE_LINKS', '<ul>');
define('POST_BROWSE_LINKS', '</ul>');
define('PRE_BROWSE_LINK', '<li>');
define('POST_BROWSE_LINK', '</li>');
define('BROWSE_LINK_ICON','');
define('BROWSE_LINKCLASS', '');
define('BROWSE_LINKCLASS_SEL', 'current');
define('BROWSE_LINKCLASS_LAST', 'last');
*/

// BULLETS
define('PRE_BULLET_POINTS', '<ul>');
define('POST_BULLET_POINTS', '</ul>');
define('PRE_BULLET', '<li>');
define('POST_BULLET', '</li>');

// SYSTEM REQUIREMENTS

define('PRE_REQUIREMENTS_HEADER', '<strong>');
define('POST_REQUIREMENTS_HEADER', '</strong><br />');
define('PRE_REQUIREMENTS', '<div class="align-left">');
define('POST_REQUIREMENTS', '</div>');
define('PRE_REQUIREMENT', '');
define('POST_REQUIREMENT', '<br />');
define('PRE_REQUIREMENT_LABEL', '<strong>');
define('POST_REQUIREMENT_LABEL', '</strong>');


// ERROR CLASS
define('ERRORCLASS', 'errors');
// IMG CLASSES


// PAGINATION
define('PRE_PAGINATION','<div class="block"><div class="text">');
define('POST_PAGINATION','</div></div>');

if(is_file(Configuration::get('module_path').'login/language/'.LOCALE.'_language.php')){
	Site_Language::loadLanguageFile(Configuration::get('module_path').'login/language/'.LOCALE.'_language.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('module_path').'login/language/en_language.php');
}

if(!SGS_ADMIN){
	$prepage = Site_Elements::anchorTag(SGS_BASE_URL.'login.php', Site_Language::display('menu_login_sign_in'));
}else{
	$prepage = Site_Language::display('menu_login_welcome').' | '.Site_Elements::anchorTag(Configuration::get('admin_base_url').'index.php', Site_Language::display('menu_login_admin_area')).' | '.Site_Elements::anchorTag(SGS_BASE_URL.'?logout', Site_Language::display('menu_login_sign_out'));
}
Site_Parse::setTag('PREPAGE', Site_Parse::parse_layout($prepage,array('SGS_USERNAME'=>SGS_USERNAME)));

Site_Parse::setTag('GAME_PLATFORM_MENU',createMainNav());

function createMainNav()
{
   
    ob_start();
    contentstyle(
    	'Platforms',
        Site_Parse::parse_layout(
								'{MAINNAV}',
                                array()
                                ),
        'game_platform_menu',
        '',
        'sidebar'
    );
    
    $nav = ob_get_contents();

    ob_end_clean();
    
    return $nav;
}


function contentstyle($caption,$text,$id='',$class='',$style=''){
	 if($style == 'search'){

		echo '<div '.($id !='' ? 'id="utility'.$id.'" ' : '').'>'."\n";

		if($caption){
			echo '<h4>'.$caption.'</h4>'."\n";
		}
		if($text){
			echo $text."\n";
		}
		echo '</div>'."\n";

	}else if($style=='sidebar'){

		echo '<!-- start '.$id.' module -->'."\n";
		echo '<div '.($id !='' ? 'id="sidebar_'.$id.'" ' : '').($class !='' ? 'class="block '.$class.'" ' : 'class="block"').'>'."\n";
		echo '	<div class="block_bottom">'."\n";
		echo '		<div class="block_top">'."\n";

		if($caption){
			echo '			<h4>'.$caption.'</h4>'."\n";
		}

		if($text){
			echo '			<div class="text">'.$text.'</div>'."\n";
		}

		echo '		</div>'."\n";
		echo '	</div>'."\n";
		echo '</div>'."\n";
		echo '<!-- end '.$id.' module -->'."\n";

	}else{

		echo '<!-- start main block -->'."\n";
		echo '<div'.($id !='' ? ' id="main_'.$id.'" ' : '').' class="block">'."\n";

		if($caption){
			echo '<h3>'.$caption.'</h3>'."\n";
		}

		if($text){
			echo '<div class="text">'.$text.'</div>'."\n";
		}

		echo '</div>'."\n";
		echo '<!-- end main block -->'."\n";

	}
}
