<?php
/**
 * SGS Module: featuredareas
 * File: menu_featured_area.php
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
	if(is_file(Configuration::get('module_path').'featuredareas/language/'.LOCALE.'_language.php')){
		Site_Language::loadLanguageFile(Configuration::get('module_path').'featuredareas/language/'.LOCALE.'_language.php');
	}else{
		Site_Language::loadLanguageFile(Configuration::get('module_path').'featuredareas/language/en_language.php');
	}

	$prefs = Site_Modules::loadPrefs('featuredareas');

	if(isset($prefs['featuredareas_caption']) && $prefs['featuredareas_caption'] != '') {
		$caption = stripslashes($prefs['featuredareas_caption']);
	} else {
		$caption = Site_Language::display('featuredareas_menu_caption');
	}

Site_Parse::render_content($caption, Site_Navigation::nav($options = array('return'=>'all')),'menu_featuredareas');

?>
