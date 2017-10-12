<?php 
/**
 * Site Cache Manager, used to cleanup stail page and module cache files.
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
 * Site Cache Manager.
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
class Site_CacheManager{
    
    public static $deleted = array();
    
    public static function init()
    {
        	
        $maxage = Configuration::get('lifetime_cache_page_mod')*60;

        $cachePath = Configuration::get('cache_path');
        
        $dir = opendir($cachePath);
        
        $fileTypes = array('mod','page');
   
        while($file = readdir($dir))
        {
            $doFulsh = false;
            
            $fileInfo = pathinfo($cachePath.$file);
            
            if(is_file($cachePath.$file) && in_array($fileInfo['extension'],$fileTypes)){

                if(time() > (@filemtime($cachePath.$file) + $maxage)){                   
                    
                    $doFulsh = true;
                }

                if($doFulsh){
                   
                    if (unlink($cachePath.$file)) {
                        self::$deleted[] = $file;

                    }
                }

            }
            
            
        }
	    closedir($dir);
    	
    }
	
    public static function flush($pattern='')
    {
      
       $cachePath = Configuration::get('cache_path');
        
        $dir = opendir($cachePath);

        while($file = readdir($dir))
        {
            $doFulsh = false;

            if(is_file($cachePath.$file)){

                $doFulsh = preg_match("/{$pattern}$/", $file);
  
                if($doFulsh){
                    
                    if (unlink($cachePath.$file)) {
                        self::$deleted[] = $file;
                    }
                }

            }
        }
        closedir($dir);
    }    
    
}
?>