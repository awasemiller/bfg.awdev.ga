<?php
/**
 * Template default
 *
 * @template Default
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

// Game Nav Settings also used for featured areas module in some templates
define('PRE_GAME_LINKS', '<ul>');
define('POST_GAME_LINKS', '</ul>');
define('PRE_LINK', '<li>');
define('POST_LINK', '</li>');
define('LINK_ICON','');
define('LINKCLASS', 'nav');
define('LINKCLASS_SEL', 'current');
define('LINKCLASS_LAST', 'last');
// GAMENAV AMOUNT TO DISPLAY mixed [ all, numeric value, default 7 ] 
//define('GAMENAV_AMOUNT', '7');

//define('GENRE_STYLE','table');

// Genre List Settings
define('GENRECOLUMNS','2');
define('PRE_GENRE_LIST','');
define('POST_GENRE_LIST',''."\n");
define('PRE_GENRE_LINK','');
define('POST_GENRE_LINK',''."\n");


// Paginate Settings
define('PRE_PAGINATION','<div class="pagination">');
define('POST_PAGINATION','</div>');

// BULLETS
define('PRE_BULLET_POINTS', '<ul class="bullets">');
define('POST_BULLET_POINTS', '</ul>');
define('PRE_BULLET', '<li>');
define('POST_BULLET', '</li>');

// SYSTEM REQUIREMENTS
define('PRE_REQUIREMENTS_HEADER', '<div class="requirements"><strong>');
define('POST_REQUIREMENTS_HEADER', '</strong>');
define('PRE_REQUIREMENTS', '<br />');
define('POST_REQUIREMENTS', '</div>');
define('PRE_REQUIREMENT', '');
define('POST_REQUIREMENT', '<br />');
define('PRE_REQUIREMENT_LABEL', '<strong>');
define('POST_REQUIREMENT_LABEL', '</strong>');

// COMMENT settings
// comment class used to set the no comment message class to that of your comment.html comment class
define('COMMENT_CLASS','comment');

// ERROR & SUCCESS CLASS SETTINGS
define('ERRORCLASS', 'error');
define('SUCCESSCLASS', 'success');

// MAIN CONTENT STYLE string
define('MAINSTYLE','default_alt');

Site_Parse::setTag('CURRENT_PLATFORM_IMAGE', '<img src="images/icons/icon_'.PLATFORM.'_sm.gif" alt="'.PLATFORM.'" style="border:none" />');

if(!function_exists('contentstyle')){

	function contentstyle($caption,$text,$id='',$class='',$style=''){

		if($style == 'navigation'){
			echo $text."\n";
		}else if($style == 'search'){

			echo '<div>'."\n";

			if($caption){
				echo '<h4>'.$caption.'</h4>'."\n";
			}
			if($text){
				echo $text."\n";
			}
			echo '</div>'."\n";

		}else if($style=='sidebar'){

			echo '<div '.($class !='' ? 'class="sidebar '.$class.'" ' : 'class="sidebar"').'>'."\n";

			if($caption){
				echo '<h4>'.$caption.'</h4>'."\n";
			}
			if($text){
				echo '<div class="bottom"><div class="text">'.$text.'</div></div>'."\n";
			}
			echo '</div>'."\n";

		}else if($style=='sidebar_alt'){

				echo '<div id="'.$id.'" class="alt_bottom">';
				if($caption){
					echo '<h4 class="alt_top">'.$caption.'</h4>'."\n";
				}
				if($text){
					echo '<div class="alt_text">'.$text.'</div>'."\n";
				}

				echo '</div>';

		}else if($style=='default_alt'){

				echo '<div '.(isset($id) ? 'id="'.$id.'"' : '').' class="alt_bottom">';
				if($caption){
					echo '<h3 class="alt_top">'.$caption.'</h3>'."\n";
				}
				if($text){
					echo '<div class="alt_text">'.$text.'</div>'."\n";
				}

				echo '</div>';

		}else{

			if($caption){
				echo '<h3>'.$caption.'</h3>'."\n";
			}
			if($text){
				echo '<div class="text">'.$text.'</div>'."\n";
			}
		}
	}
}
?>