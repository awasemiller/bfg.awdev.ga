<?php
/**
 * SGS Module: Language EN language file
 * File: language/en_language.php
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

//Enable this feature by setting multilanguage to enable in Site Settings > Languages
$language = array(
	/**
	 * module language
	 */
	'language_caption'=>'Select Language',
	'language_adminMessage'=>'This module will not display unless mulitlanguage is enabled.<br />
	Enable this feature by setting <a href="#" onClick=\'parent.location="'.Configuration::get('admin_base_url').'siteconfig.php?language"\'>multilanguage</a> to enable in <a href="#" onClick=\'parent.location="'.Configuration::get('admin_base_url').'siteconfig.php?language"\'>Site Settings > Languages</a>.'

	);

?>