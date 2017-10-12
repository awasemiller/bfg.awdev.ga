<?php
/**
 * SGS Admin Area admin
 * File: admin.php
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
	Site_Admin::adminLogin();
	Site_Parse::page_end();
	exit;
}

if(is_file(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_admin.php')){
	Site_Language::loadLanguageFile(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_admin.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('language_path').'en/admin/en_admin.php');
}

if(!defined('ADMIN_ICONPATH')){
	define('ADMIN_ICONPATH',SGS_BASE_URL.'images/admin/icons/');
}

$pages = array(array('query'=>'default','text'=>'Admin Fontpage'));

$sidebar ='<ul class="siteinfo">';

if(is_array($siteconfig)){

	$sidebar .= '<li><strong>'.Site_Language::display('sitename').'</strong> '.Configuration::get('sitename').'</li>'.
	            '<li><strong>'.Site_Language::display('sgs_version').'</strong> '.Configuration::get('sgs_version').'</li>'.
	            '<li><strong>'.Site_Language::display('phpversion').'</strong> '.phpversion().'</li>'.	
	            '<li><strong>'.Site_Language::display('language').'</strong> '.Configuration::get('locale').'</li>'.
	/*			'<li><strong>'.Site_Language::display('platform').'</strong> '.Configuration::get('platform').'</li>'. */
				'<li><strong>'.Site_Language::display('template').'</strong> '.Configuration::get('theme').'</li>';
}

$sidebar .='</ul>';

$admin_caption = Site_Language::display('welcome').': '.SGS_USERNAME;

$pages = array(
	array('page'=>'admin.php','query'=>'','text'=>$admin_caption),
	array('page'=>'siteconfig.php','query'=>'default','text'=>Site_Language::display('nav_siteconfig'),'description'=>Site_Language::display('nav_siteconfig_desc'),'icon'=>ADMIN_ICONPATH.'sitesettings.png'),
	array('page'=>'custompage.php','query'=>'view','text'=>Site_Language::display('nav_custompage'),'description'=>Site_Language::display('nav_custompage_desc'),'icon'=>ADMIN_ICONPATH.'custompage.png'),
	array('page'=>'modules.php','query'=>'modules','text'=>Site_Language::display('nav_modules'),'description'=>Site_Language::display('nav_modules_desc'),'icon'=>ADMIN_ICONPATH.'cmodules.png'),
	array('page'=>'info.php','query'=>'general','text'=>Site_Language::display('nav_info'),'description'=>Site_Language::display('nav_info_desc'),'icon'=>ADMIN_ICONPATH.'phpinfo.png')
);

$text = '';

$installFileExists = is_file(SGS_WEB_ROOT.'install.php');
$configFileWritable = is_writable(SGS_WEB_ROOT.'config.php');

if($installFileExists || $configFileWritable ){
    
    $copy = 'Please';
    
    if($installFileExists){

        $copy .= ' delete the install.php from your server';
    }

    if($configFileWritable){ 
        if($installFileExists){
            $copy .= ' and';
        } 
        $copy .= ' chmod your config file to 644';  
    }  
    $copy .= '.';
    $text = '<p'.((defined('ERRORCLASS') && ERRORCLASS !='') ? ' class="'.ERRORCLASS.'"' : ' class="error"').' style="margin:10px; padding:10px 30px;">'.$copy.'</p>';
}

$text .= Site_Admin::mainLinks($pages);

    
Site_Admin::renderAdmin($pages,$text,$sidebar,Site_Language::display('site_info'));
?>