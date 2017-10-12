<?php
/**
 * SGS Module: Login
 * File: menu_login.php
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

if(is_file(Configuration::get('module_path').'login/language/'.LOCALE.'_language.php')){
	Site_Language::loadLanguageFile(Configuration::get('module_path').'login/language/'.LOCALE.'_language.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('module_path').'login/language/en_language.php');
}

if(!SGS_ADMIN){

	Site_Parse::render_content(Site_Language::display('menu_login_sign_in'), Site_Auth::loginForm(),'loginmenu');

}else{

	if(!defined('PRE_LOGIN_LINKS')){
		define('PRE_LOGIN_LINKS', '<ul>');
		define('POST_LOGIN_LINKS', '</ul>');
		define('PRE_LOGIN_LINK', '<li>');
		define('POST_LOGIN_LINK', '</li>');
		define('LOGIN_LINK_ICON','');
		define('LOGIN_LINKCLASS', '');
		define('LOGIN_LINKCLASS_SEL', 'current');
		define('LOGIN_LINKCLASS_LAST', 'last');
	}

	$href[0] = Configuration::get('admin_base_url').'index.php';
	$href[1] = Configuration::get('sgs_base_url').'index.php?logout';

	$loginlinks[0] = array('name'=>'adminarea','href'=>$href[0], 'linktext'=>Site_Language::display('menu_login_admin_area'));
	$loginlinks[1] = array('name'=>'logout','href'=>$href[1], 'linktext'=>Site_Language::display('menu_login_sign_out'));


	$text = PRE_LOGIN_LINKS;

	$lastlink = count($loginlinks);
	$l = '0';

	$loginSelect = '';

	foreach($loginlinks as $link){
		$class = (($loginSelect ==''.strtolower($link['name']).'') ? ((LOGIN_LINKCLASS_SEL != '') ? 'class="'.LOGIN_LINKCLASS.' '.LOGIN_LINKCLASS_SEL.'"' : '') : ((LOGIN_LINKCLASS != '') ? 'class="'.LOGIN_LINKCLASS.'"' : ''));
		$text .= substr(PRE_LOGIN_LINK,0,-1).' '.$class.'><a href="'.$link['href'].'">'.LOGIN_LINK_ICON.$link['linktext'].'</a>'.POST_LOGIN_LINK;
		$l++;
	}

	$text .= POST_LOGIN_LINKS;

	Site_Parse::render_content(Site_Language::display('menu_login_welcome'), $text,'menu_login');
}
?>