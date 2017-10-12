<?php
/**
 * Error
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


require_once('core_gamesite.php');

Site_Parse::page_start(false);
$helpurls = '<ul>
<li><a href="'.SGS_BASE_URL.'search.php">Search</a></li>
<li><a href="'.SGS_BASE_URL.'browse.php?genre=all&sort=date&order=desc&platform=pc">Browse Archive</a></li></ul>';

Site_Parse::setTag('PAGETITLE', Configuration::get('sitename').' - Oops!');

switch(SGS_QUERY){

	case '404':
		$caption = 'Oops!';
		$text ='<strong>The page you are looking for does not exist on our website.</strong><br />One of these pages may help you find what you are looking for:';
		$text .= $helpurls;
		break;

	case 'nogames':

		$caption = 'Game Request Error!';
		$text = 'The was an error processing your game request.';
		break;

	case 'onvalid':

		$caption = 'Invalid Request!';
		$test = '';
		break;


	default:
		$caption = 'Server Error!';
 		$text ='<strong>The Server was unable to process your request.</strong>';
}

Site_Parse::render_content($caption, $text,'error');

Site_Parse::page_end();
?>
