<?php
/**
 * Site Config Class, used to read and write the site configuration file.
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
 * Site Confing Class.
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
class Site_Config {

        /**
         * 
         * Enter description here ...
         * @var unknown_type
         */
        public static $siteconfig = null;
    
	    public function __construct()
	    {
	    	
	        
	        // was this option ever used ?
	        /**
	        
	        if(isset($options['autoload']) && $options['autoload'] == true){
				$this->loadConfig();
				return  $this->siteconfig;
			}
			*/        
	    }
	    
		/**
		 * loadConfig
		 *
		 * @param void
		 * @return void
		 */
	    public static function loadConfig()
	    {

	        if(self::$siteconfig != null){
	            return self::$siteconfig;
	        }
	        
	        
	        $siteconfig = @file_get_contents(Configuration::get('data_path').'siteconfig.db');
	        
	        if($siteconfig ==false){
	           return false;
	        }
	        
	        $siteconfig = @unserialize($siteconfig);
	        
	        if(!is_array($siteconfig)){
	            return false;
	        }
	        
	        self::$siteconfig = $siteconfig;
	        
	        return self::$siteconfig;

	    }

		/**
		 * saveConfig
		 *
		 * @param array $data
		 * @param string $filename
		 *
		 * @return mixed array config | bool FALSE
		 */

		public static function saveConfig($config)
		{
		    // we should make sure siteconfig is an array first
		    
			foreach($config as $key=>$value){
				self::$siteconfig[$key] = stripslashes($config[$key]);
			}

			if(array_key_exists('submit',self::$siteconfig)){
				unset(self::$siteconfig['submit']);
			}
			
			if(self::writeConfig(self::$siteconfig)){
				return self::$siteconfig;
			}else{
				return false;
			}
		}

		/**
		 * writeConfig
		 *
		 * @param array $data
		 * @param string $filename
		 *
		 * @return bool
		 */
		public static function writeConfig($data)
		{
			$filename = Configuration::get('data_path').'siteconfig.db';
			if(is_array($data)){
				$data = serialize($data);
			}else{
				return FALSE;
			}

			$fp = @fopen($filename, "w");
			if (!@fwrite($fp, $data)) {
				@fclose ($fp);
				return FALSE;
			}
			@fclose ($fp);
			return TRUE;
		}

}

?>