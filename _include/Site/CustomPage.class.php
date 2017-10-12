<?php
/**
 * Site Custom Page Class, used to read and write user contributed content.
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
 * Site Custom Page is used to read and write user contributed content.
 *
 * Content is stored in the '_custom' directory by default.
 * This storage directory can be changed by setting the var $config['dir_custom'] in the config.php file.
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
class Site_CustomPage{

		/**
		 * an array of loaded pages
		 */
		private static $custompages = array();

		/**
		 * current file being evaluated
		 */
		private static $tempfile = NULL;

		
		
    	/**
		 * getCustompages
		 *
		 * @param bool $load
		 * @return mixed
		 */
		public static function getCustompages($load=FALSE)
		{

			if(count(self::$custompages) > 1){
				return self::$custompages;
			}

			$custompages = array();

			if ($dir = @opendir(Configuration::get('custom_path'))) {

		        while (false !== (self::$tempfile = readdir($dir))){
		       		if(self::checkPage(self::$tempfile) && sgs_eregi('page',self::$tempfile) && self::$tempfile !='.' && self::$tempfile !='..' && self::$tempfile !='.svn'){
						if($load){
							$custompages[self::$tempfile] = unserialize(file_get_contents(Configuration::get('custom_path').'/'.self::$tempfile));
						}else{
		        			$custompages[] = str_replace('.page','',self::$tempfile);
						}
		        	}
		        }

		        if(!$load){
		        	self::$custompages = $custompages;
		        }

		        return $custompages;
			}else{
				return FALSE;
			}
		}

		public static function cleanPageName($page)
		{

				$search = Site_Language::getLocales();

				foreach($search as $key=>$word){
					$search[$key] = $word.'_';
				}
				$page = str_replace($search,'',$page);

				$page = str_replace('-',' ',$page);

			return $page;

		}

		/**
		 * checkPage
		 *
		 * @param $file
		 * @return bool
		 */
		public static function checkPage($file)
		{
			if(is_file(Configuration::get('custom_path').$file) && is_readable(Configuration::get('custom_path').$file)){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		 * writePage
		 *
		 * @param mixed $data
		 * @param string $filename
		 * @return bool
		 */
		public static function writePage($data,$filename)
		{
			$fp = @fopen(Configuration::get('custom_path').$filename, "w");
			if (!@fwrite($fp, $data)) {
				@fclose ($fp);
				return FALSE;
			}
			@fclose ($fp);
			return TRUE;
		}

		/**
		 * @todo phpdoc comments
		 * delete_page
		 *
		 * @param $filename
		 *
		 * @return bool
		 */
		public static function deletePage($filename)
		{
			$fp = @unlink(Configuration::get('custom_path').$filename);
			if (!$fp) {
				return FALSE;
			}
			return TRUE;
		}

}



?>