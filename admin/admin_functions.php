<?php
/**
 * SGS Admin Area functions
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

/**
 * Admin Nav render style
 */

define('ADMINNAV_STYLE','sidebar');

/**
 * Admin Nav html format
 */

/*
define('PRE_ADMINNAV_LINKS', '<ul>');
define('POST_ADMINNAV_LINKS', '</ul>');
define('PRE_ADMINNAV_LINK', '<li>');
define('POST_ADMINNAV_LINK', '</li>');
define('ADMINNAV_ICON','');
define('ADMINNAVCLASS', 'button');
define('ADMINNAVCLASS_SEL', 'current');
define('ADMINNAVCLASS_LAST', 'last');
*/

/**
 * Admin Option render style
 */

define('OPTIONSNAV_STYLE','sidebar');

/**
 * Admin Options  html format
 */

/*define('PRE_OPTIONSNAV_LINKS', '<ul>');
define('POST_OPTIONSNAV_LINKS', '</ul>');
define('PRE_OPTIONSNAV_LINK', '<li>');
define('POST_OPTIONSNAV_LINK', '</li>');
define('OPTIONSNAV_ICON','');
define('OPTIONSNAVCLASS', 'button');
define('OPTIONSNAVCLASS_SEL', 'current');
define('OPTIONSNAVCLASS_LAST', 'last');
*/

/**
 * table classes
 */

define('TABLE_CLASS','tablecontent');
define('TABLE_HEADER_CLASS','tableheader');
define('TABLE_FOOTER_CLASS','tablefooter');
define('ODD_CLASS','tablerow');
define('EVON_CLASS','tablerow');

/**
 * Error success classes
 */

define('SUCCESSCLASS', 'success');
define('ERRORCLASS', 'error');

/**
 * Admin main content style
 */
define('MAIN_STYLE','default');

/**
 * contentstyle
 *
 */
if(!function_exists('contentstyle')){

	function contentstyle($caption,$text,$id='',$class='',$style=''){

		if($style=='sidebar'){

				echo '<div class="bottom">';
				if($caption){
					echo '<h4 class="top">'.$caption.'</h4>'."\n";
				}
				if($text){
					echo '<div class="text">'.$text.'</div>'."\n";
				}

				echo '</div>';
		}else{
				echo '<div class="bottom">';
				if($caption){
					echo '<h3 class="top">'.$caption.'</h3>'."\n";
				}
				if($text){
					echo '<div class="text">'.$text.'</div>'."\n";
				}

				echo '</div>';
		}

	}
}
?>