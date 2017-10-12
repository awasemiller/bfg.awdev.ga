<?php
/**
 * Site Language
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
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Class Site Language.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

if(!defined('SGS_INIT')){ exit; }

class Site_Language{


		/**
		 * language
		 * @var array $language language messages
		 */
		public static $language;

		/**
		 * locales
		 * @var array $locales available languages
		 */
		public static $locales =null;


		/**
		 * Site_Language
		 *
		 * Class Constructor
		 *
		 * @param array $options keys [ _showDebug (enable / disable debug output) ]
		 *
		 * @return void
		 */

		public static function init()
		{
			

		    /**
		     * added for gan support
		     */
		    if( Configuration::get('ganenabled')){
		        self::$locales = array('en');
		        return;
		    }
		    
		    if (is_null(self::$locales)) {
		        
           		$locales = array();
           		
        		if ($dir = @opendir(Configuration::get('language_path'))) {
        	        while (false !== ($landir = readdir($dir))){
        	       		if(is_dir(Configuration::get('language_path').$landir) && $landir !='.' && $landir !='..' && $landir !='.svn'){
        	        			$locales[] = $landir;
        	        	}
        	        }
        		}
        
        		self::$locales = $locales;
		    }
		}

		public static function getLocales()
		{
		    self::init();
		    return self::$locales;
		}
		/**
		 * register
		 *
		 * register function, used to register class methods in site loader object, self registered events are ( setlocale[autorun,setLocale] )
		 * @param object $obj site loader
		 * @return void
		 */
		function register($obj)
		{
			//$obj->register_event('setlocal',array('autorun','Site_Language','setLocal'));

		}
		
		/**
		 * @todo phpdoc comments
		 */
		 
		public static function setLocale($options=array('locale'=>'en'))
		{
			
            self::init();
			
			if(Configuration::get('mulitilanguage') == true){

				if(isset($_GET['locale']) && in_array(strtolower($_GET['locale']),array_values(self::$locales))){
					setcookie('locale', $_GET['locale'], (time() + 3600 * 24 * 30),'/');
					// where should we store the new value
					//Site_Config::$siteconfig['locale'] = strtolower($_GET['locale']);
					Configuration::set('locale', strtolower($_GET['locale']));
				}

				/**
				 * do not set language from cookie if we are in admin
				 */
				
				if(
				isset($_COOKIE['locale']) && 
				!sgs_eregi(Configuration::get('dir_admin'),$_SERVER["REQUEST_URI"]) && 
				in_array(strtolower($_COOKIE['locale']),array_values(self::$locales))
				){
					
				    Configuration::set('locale', strtolower($_COOKIE['locale']));
					define('LOCALE', $_COOKIE['locale']);
				}
			}

			if(!defined('LOCALE')){
				define('LOCALE', Configuration::get('locale') ? Configuration::get('locale') : 'en');
			}

			self::loadLanguageFile(Configuration::get('language_path').LOCALE.'/'.LOCALE.'_language.php');
		}
		
		/**
		 * loadLanguageFile - loads language file from file system
		 * @param sting $file path to file
		 * 
		 * @return void
		 */
		 
		public static function loadLanguageFile($file=FALSE)
		{
			$language = NULL;

			if(is_file($file) && is_readable($file)){

				require_once($file);
				if(is_array($language)){

					self::loadLanguage($language);
				}
		 	}
		}
		
		/**
		 * loadLanguage - add to language stack
		 * 
		 * @param array $language
		 * 
		 * @return void
		 */
		 
		public static function loadLanguage($language=FALSE)
		{
			if(is_array($language) && is_array(self::$language)){
				self::$language = array_merge(self::$language,$language);
		 	}else if(is_array($language)){
		 		self::$language = $language;
		 	}
		}
		
		/**
		 * unsetLanguage - clear language
		 * 
		 * @param void
		 * 
		 * @return void
		 */
		 
		function unsetLanguage()
		{
			self::$language = array();
		}
		
		/**
		 * is_vowel - check to see if a character is a vowel
		 * @author William Moffett <william.moffett@bigfishgames.com>
		 *
		 * @param string $string sting to check
		 * @param int $charAt which character to check in the given string
		 * @param array $vowels an array of additional vowels to check
		 *
		 * @return bool [ true {if character checked is a vowel} | false ]
		 */
	
		function is_vowel($string=NULL,$charAt=0,$vowels=array()){
	
			if(!is_string($string)){ return false; }
			if(!is_array($vowels)){	return false; }
	
			return in_array(strtolower(substr($string,$charAt,($charAt + 1))),array_merge(array('a','e','i','o','u'),$vowels));
		}		
		
		/**
		 * display
		 * 
		 * @param string $key
		 * 
		 * @return mixed string | false
		 * 
		 */
		public static function display($key)
		{
			if (!array_key_exists($key,self::$language)) {
				return 'missing:'.$key;
			}

			return self::$language[$key];
			// new debug message
			// $this->_debug('Site_Language:display', 'message for '.$key.' does not exist.');
		 }
		 
		public static function displayAll()
		{
		    
		   return self::$language; 
		}
}
?>