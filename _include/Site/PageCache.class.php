<?php
 /**
 * Site Page Cache
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
 * Class Site Page Cache.
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
class Site_PageCache {

        public static $cacheable = false;
        
        public static $expirePage = false;        
    	/**
		 * 
		 * @param array $options
		 * @return unknown_type
		 */
		public static function retrievePage()
		{

            Cache::setFile(self::pageKey(), array('serialize'=>true,'ext'=>'page'));

            if(!self::$cacheable){
                return false;
            }
           
			if(self::$expirePage == true){
                self::$cacheable = false;
				Cache::expire(self::pageKey());
				return false;
			}
         
			if(!Cache::needNewFile(self::pageKey())){
			   
				$cache = Cache::load(self::pageKey());
				self::$cacheable = false;
				echo $cache['main'];
				Site_Parse::setTag('PAGETITLE', $cache['PAGETITLE']);
				Site_Parse::setTag('DESCRIPTION', $cache['DESCRIPTION']);
				Site_Parse::setTag('KEYWORDS', $cache['KEYWORDS']);
				Site_Parse::page_end();
			
				exit;
			}
				

		}

		public static function cachePage()
		{
	   
			if(Configuration::get('page_cache') == true && self::$cacheable){
								
                Cache::setFile(self::pageKey(), array('serialize'=>true,'ext'=>'page'));

				$data = array(
						'main'=>Site_Parse::$_main,
						'PAGETITLE'=>Site_Parse::$_tags['PAGETITLE']['data'],
						'DESCRIPTION'=>Site_Parse::$_tags['DESCRIPTION']['data'],
						'KEYWORDS'=>Site_Parse::$_tags['KEYWORDS']['data']				
				
				);
				
				Cache::save(self::pageKey(), $data);

			}

		}

		public static function pageKey()
		{
			return 'page_'.str_replace('.php','',SGS_PAGE).'_'.LOCALE.'_'.PLATFORM.'_'.md5(LOCALE.Configuration::get('theme').SGS_PAGE.implode($_POST).implode($_GET).str_ireplace('&reset=cache','',html_entity_decode(SGS_QUERY)));
		}
	
		/**
		 * clear - clear page cache
		 * @param bool $all default False
		 * @return void
		 */

		public static function clear() 
		{
			Site_CacheManager::flush('page');
		}
}
?>