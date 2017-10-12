<?php
 /**
 * SGS Admin Area pmodules
 * File: pmodules.php
 *
 * Used to preview module locations
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
require_once('../core_gamesite.php');

Site_Parse::page_start();
if(!SGS_ADMIN){
	echo '<script>parent.location="modules.php"</script>';
	exit;
}

if(is_file(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_modules.php')){
	Site_Language::loadLanguageFile(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_modules.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('language_path').'en/admin/en_modules.php');
}

/**
 * custom moduleEdit button styles
 */
$style ='<style>
.moduleEdit{
	display:block;
	height:24px;
    margin:0px;
	text-align:center;
}
.moduleEdit img{
	float:none;
	margin:1px;
	padding:2px;
	border:1px solid #d5d5d5;
	border-top:1px solid #e0e0e0;
	border-left:1px solid #e0e0e0;
	background-color: #ededed;
}
.moduleEdit img:hover{
	border:1px solid #e0e0e0;
	border-top:1px solid #d5d5d5;
	border-left:1px solid #d5d5d5;
	background-color: #f6f6f6;
}
</style>
</head>';
/**
 * reset main template parse tags
 */
Site_Parse::setTag('SITENAME', '[SITENAME]');
Site_Parse::setTag('SITETAG', '[SITETAG]');
Site_Parse::setTag('DISCLAIMER', '[DISCLAIMER]');
/**
 * load the theme layout and add our module button styles
 */
$layout = file_get_contents(Configuration::get('theme_path').$_GET['layout'].'.html',TRUE);
$layout = str_replace('</head>' ,$style, $layout);
/**
 * override default admin template layout with the above template
 */
Site_Parse::set_template($layout, 'admin');
define('PAGETEMPLATE', $_GET['layout']);
/**
 * set caption and content
 */
$caption = Site_Language::display('admin_modules_module_preview');$text = Site_Language::display('admin_modules_current_template').' <strong>'.PAGETEMPLATE.'</strong>';
Site_Parse::render_content($caption, $text,'','');
Site_Parse::page_end();
?>
