<?php
/**
 * SGS Core Game Site
 * File: core_gamesite.php
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
 * @var double $core_version the current version of this file.
 */

$core_version = 1.0;

if(isset($GLOBALS)){
	unset($GLOBALS);
}

define('SGS_WEB_ROOT', pathinfo(__FILE__,PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR);

$dir_include =  isset($config['dir_include']) ? $config['dir_include'] : '_include';

include_once SGS_WEB_ROOT . $dir_include . DIRECTORY_SEPARATOR .'IncludeAutoLoader.php';

Timer::mark('realtime');

$SGS_BASE_URL = implode('/', array_intersect(explode('/', $_SERVER["REQUEST_URI"]), explode('/', str_replace('\\', '/', SGS_WEB_ROOT))));

if (substr($SGS_BASE_URL,-1) != '/') {
      $SGS_BASE_URL .= '/';
}

define('SGS_BASE_URL', ($_SERVER['SERVER_PORT'] =='80' ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $SGS_BASE_URL);

/**
 * Replacement for depeciated eregi
 * needle and haystack are examined in a case-insensitive manner
 * Do not use for regular expression pattern matches
 * 
 * @param mixed $needle    If needle is not a string, it is converted 
 *                         to an integer and applied as the ordinal 
 *                         value of a character.
 *                          
 * @param string $haystack The string to search in.
 * 
 * @return bool
 */
function sgs_eregi($needle, $haystack)
{    
    return is_string(stristr($haystack, $needle));
}
/**
 * Helper method used to redirect 
 * the view to the install page.
 * 
 * @param  void
 * 
 * @return void
 */
function installRedirect()
{
    $onInstallPage = sgs_eregi('install.php', $_SERVER['PHP_SELF']);
    $InstallerLocation = SGS_BASE_URL.'install.php';  
     
    if(!$onInstallPage){
        header('location: '.$InstallerLocation);
        exit;
    } 
}

/**
 * Are we able to load the config.php file?
 */
if (!@include_once(SGS_WEB_ROOT . '/config.php')) {
    installRedirect();
}
/**
 * Does the global $config variable exist?
 */
if (!is_array($config)) {
    installRedirect();
}
/**
 * Test for required values in the config array
 */
if (
    (!isset($config['sgs_username']) || 
     !isset($config['sgs_version']) || 
     $config['sgs_version'] < $core_version)
    ){
        installRedirect();
}

/**
 * Load the config array
 */
Configuration::load($config);
/**
 * set file system paths
 */ 
Configuration::set('admin_path',     SGS_WEB_ROOT . Configuration::get('dir_admin') . DIRECTORY_SEPARATOR);
Configuration::set('cache_path',     SGS_WEB_ROOT . Configuration::get('dir_cache') . DIRECTORY_SEPARATOR);
Configuration::set('custom_path',    SGS_WEB_ROOT . Configuration::get('dir_custom') . DIRECTORY_SEPARATOR);
Configuration::set('data_path',      SGS_WEB_ROOT . Configuration::get('dir_data') . DIRECTORY_SEPARATOR);
Configuration::set('docs_path',      SGS_WEB_ROOT . Configuration::get('dir_docs') . DIRECTORY_SEPARATOR);
Configuration::set('include_path',   SGS_WEB_ROOT . Configuration::get('dir_include') . DIRECTORY_SEPARATOR);
Configuration::set('module_path',    SGS_WEB_ROOT . Configuration::get('dir_module') . DIRECTORY_SEPARATOR);
Configuration::set('language_path',  SGS_WEB_ROOT . Configuration::get('dir_language') . DIRECTORY_SEPARATOR);
Configuration::set('templates_path', SGS_WEB_ROOT . Configuration::get('dir_templates') . DIRECTORY_SEPARATOR);
Configuration::set('test_path',      SGS_WEB_ROOT . Configuration::get('dir_test') . DIRECTORY_SEPARATOR);
/**
 * set server paths
 */
Configuration::set('sgs_base_url',       SGS_BASE_URL);
Configuration::set('admin_base_url',     SGS_BASE_URL . Configuration::get('dir_admin') . str_replace('\\', '/', DIRECTORY_SEPARATOR));
Configuration::set('templates_base_url', SGS_BASE_URL . Configuration::get('dir_templates') . str_replace('\\', '/', DIRECTORY_SEPARATOR));
Configuration::set('module_base_url',    SGS_BASE_URL . Configuration::get('dir_module') . str_replace('\\', '/', DIRECTORY_SEPARATOR));
Configuration::set('docs_base_url',      SGS_BASE_URL . Configuration::get('dir_docs') . str_replace('\\', '/', DIRECTORY_SEPARATOR));



/*### current page information ###*/
define('SGS_SELF', $_SERVER['PHP_SELF']);
$gpage = explode('/',SGS_SELF);
define('SGS_PAGE', array_pop($gpage));

/*### query string ###*/
define('SGS_QUERY', $_SERVER['QUERY_STRING']);

/*###PHP INI SETTINGS###*/
if (function_exists('ini_set')){
	ini_set('magic_quotes_runtime',     0);
	ini_set('magic_quotes_sybase',      0);
	ini_set('arg_separator.output',     '&amp;');
	ini_set('session.use_only_cookies', 1);
	ini_set('session.use_trans_sid',    0);
	ini_set('session.url_rewriter.tags', 'a=href,area=href,frame=src,input=src');
}

/*###DEVELOPER SETTINGS ###*/
if(isset($config['error_reporting']) && $config['error_reporting'] !=''){
	ini_set('error_reporting', $config['error_reporting']);
}

/*## START SESSION ###*/

if (Configuration::get('sgs_authenticate_method') && 
    Configuration::get('sgs_authenticate_method') =='session'
    ) {

    session_start();
}
/*### INIT GAME SITE ###*/
define('SGS_INIT', true);

$se = new Site_Event();

$se->register_event('logout',array('get','Site_Auth','deauthenticateUser'));
$se->register_event('login',array('post','Site_Auth','authenticateUser'));
$se->register_event('checkuser',array('autorun','Site_Auth','checkUserAuthentication'));
$se->register_event('setlocale',array('autorun','Site_Language','setLocale'));
$se->register_event('comment_submit',array('post','Site_Comments','writeCommentFile'));
$se->register_event('delete_comment',array('get','Site_Comments','deleteComment'));

if (Configuration::get('ganenabled')) {
    $se->register_event('GanUrls',array('autorun','Site_Gan','parseUrls'));
}

$se->register_event('CacheManager',array('autorun','Site_CacheManager','init'));

/**
 * Template events
 */
$se->register_event('previewtemplate',array('get','Site_Template','setPreview'));
$se->register_event('unsetusertemplate',array('get','Site_Template','unSetUserTemplate'));
$se->register_event('unsetadmintemplate',array('get','Site_Template','unSetAdminTemplate'));

if(sgs_eregi(Configuration::get('dir_admin'), SGS_SELF)){;

    $se->register_event('setadmintemplate',array('get','Site_Template','setAdminTemplate'));
    $se->register_event('getAdminTemplate',array('autorun','Site_Template','getAdminTemplate'));
}else{
    $se->register_event('setusertemplate',array('get','Site_Template','setUserTemplate'));
    $se->register_event('getUserTemplate',array('autorun','Site_Template','getUserTemplate')); 
}


/*### LOAD USER SITE CONFIG ###*/
/**
 * @global array $siteconfig
 * @name $siteconfig
 */

$siteconfig = Site_Config::loadConfig();

if (!is_array($siteconfig)) {
    installRedirect();
}

/**
 * Set the $siteconfig values in Configuration object
 */

foreach($siteconfig as $key=>$value){
    Configuration::set(strtolower($key), $value);
}
/**
 * PROCESS Site Events
 */
$se->process_events();

/**
 * set the default platform to the config setting if it has not been defined.
 */
if(!defined('PLATFORM')){ define('PLATFORM', Configuration::get('platform'));	}
/**
 * set the locale to the config setting if it has not been defined.
 */
if(!defined('LOCALE')){ define('LOCALE', Configuration::get('locale'));	}

Genre::setLocale(LOCALE);
/*### THEME CHECK ###*/

$error = array();

if(!Configuration::get('theme')){
    $error[] = array('caption'=>'theme error','text'=>'no theme found in configuration');
	$TEMPLATE_ERROR = true;
}

if(!file_exists(Configuration::get('templates_path').Configuration::get('theme').'/page.html')){
    
    Configuration::set('default_theme_path',Configuration::get('templates_path').'default/');
    Configuration::set('theme_path',Configuration::get('templates_path').'default/');
    Configuration::set('theme_url',Configuration::get('templates_base_url').'default/');
    $error[] = array('caption'=>'theme error','text'=>'unable to load theme attempting to load default theme.');
	
	$TEMPLATE_ERROR = true;
}else{
	
	Configuration::set('default_theme_path',Configuration::get('templates_path').'default/');
    Configuration::set('theme_path',Configuration::get('templates_path'). Configuration::get('theme').'/');
    Configuration::set('theme_url',Configuration::get('templates_base_url'). Configuration::get('theme').'/');
}

/*### LOAD TEMPLATE FUNCTIONS FILE IF IT EXISTS ###*/
if (sgs_eregi('pmodules',SGS_PAGE)) {
	@require_once(Configuration::get('theme_path').'functions.php');
} else if (
            is_file(Configuration::get('theme_path').'functions.php') && 
            !sgs_eregi(Configuration::get('dir_admin'),SGS_SELF) && 
            !sgs_eregi('admin',SGS_PAGE)
    ){
	    @require_once(Configuration::get('theme_path').'functions.php');
}

if (
    is_file(Configuration::get('theme_path').'admin_functions.php') && 
    (sgs_eregi($config['dir_admin'],SGS_SELF) || sgs_eregi('admin',SGS_PAGE))
    ){
	    define('ADMINDISPLAY', TRUE);
	    @require_once(Configuration::get('theme_path').'admin_functions.php');
}else if(
        sgs_eregi(Configuration::get('dir_admin'),SGS_SELF) || 
        sgs_eregi('admin',SGS_PAGE)
       ){
	define('ADMINDISPLAY', TRUE);
	@require_once(Configuration::get('admin_path').'admin_functions.php');
}

/*### SET CORE PARSE TAGS ###*/
// SET USER TAGS
Site_Parse::setTag('SGS_USERNAME', SGS_USERNAME);
/*### PATH TAGS ###*/
Site_Parse::setTag('ADMIN_BASE_URL', Configuration::get('admin_base_url'));
Site_Parse::setTag('SGS_BASE_URL', SGS_BASE_URL);
Site_Parse::setTag('THEME_URL', Configuration::get('theme_url'));
/*### PAGE AND QUERY TAGS ###*/
//Site_Parse::setTag('SELF', SGS_SELF);
Site_Parse::setTag('PAGE', SGS_PAGE);
Site_Parse::setTag('QUERY', SGS_QUERY);
/*### FILE LOCATION TAGS ###*/
Site_Parse::setTag('COREJS', SGS_BASE_URL.'corejs.php');
//Site_Parse::setTag('SITEMAP_URI', SITEMAP_URI);
Site_Parse::setTag('HOME_URI', SGS_BASE_URL);
/*### SITE INFO TAGS ###*/
Site_Parse::setTag('LOCALE', LOCALE);
Site_Parse::setTag('SITENAME', Configuration::get('sitename'));
Site_Parse::setTag('SITETAG', Configuration::get('sitetag'));
Site_Parse::setTag('PAGETITLE', Configuration::get('pagetitle'));
Site_Parse::setTag('DESCRIPTION', Configuration::get('description'));
Site_Parse::setTag('KEYWORDS', Configuration::get('keywords'));
Site_Parse::setTag('COPYRIGHT', Configuration::get('copyright'));
Site_Parse::setTag('GENERATOR', Configuration::get('generator'));
Site_Parse::setTag('DISCLAIMER', Configuration::get('disclaimer'));
Site_Parse::setTag('VERSION', Configuration::get('sgs_version'));
Site_Parse::setTag('BUILDDATE', Configuration::get('builddate'));
Site_Parse::setTag('POWEREDBY', 'Powered by SGS v'.Configuration::get('sgs_version'));
?>