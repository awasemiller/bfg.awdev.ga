<?php
/**
 * Template spring
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
define('LINKCLASS_SEL', 'sel');
define('LINKCLASS_LAST', 'last');
// GAMENAV AMOUNT TO DISPLAY mixed [ all, numeric value, default 7 ] 
//define('GAMENAV_AMOUNT', '7');

// Genre List Settings
define('GENRE_STYLE','list');
define('GENRECOLUMNS','2');
define('PRE_GENRE_LIST',"\n");
define('POST_GENRE_LIST',"\n");
define('PRE_GENRE_LINK','');
define('POST_GENRE_LINK','');

// Paginate Settings
define('PRE_PAGINATATION','');
define('POST_PAGINATATION','');

// BULLETS
define('PRE_BULLET_POINTS', '<ul class="bullets">');
define('POST_BULLET_POINTS', '</ul>');
define('PRE_BULLET', '<li>');
define('POST_BULLET', '</li>');

// SYSTEM REQUIREMENTS
define('PRE_REQUIREMENTS_HEADER', '<strong>');
define('POST_REQUIREMENTS_HEADER', '</strong><br />');
define('PRE_REQUIREMENTS', '<div class="align-left" style="padding-left:45px">');
define('POST_REQUIREMENTS', '</div>');
define('PRE_REQUIREMENT', '');
define('POST_REQUIREMENT', '<br />');
define('PRE_REQUIREMENT_LABEL', '<strong>');
define('POST_REQUIREMENT_LABEL', '</strong>');

// ERROR & SUCCESS CLASS SETTINGS
define('ERRORCLASS', 'error');
define('SUCCESSCLASS', 'success');

/**
 * GAMES_TEMPLATE_RENDER
 * Render games template without contentstyle
 * This will allow for games to display like sgs v0.6 on search and browse pages.
 */
define('GAMES_TEMPLATE_RENDER', 'plain');

/**
 * CONTENTSTYLE
 */
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
			}else{
				echo '<h4>&nbsp;</h4>'."\n";
			}

			if($text){
				echo '<div class="bottom"><div class="text">'.$text.'</div></div>'."\n";
			}
			echo '</div>'."\n";

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