<?php
/**
 * Used to autoload all classes in this directory
 *
 * PHP version 5
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
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */

/**
 * Used to autoload all classes in this directory
 * The autoLoadInclude method sets php include path's
 * and loads required classes from the current 
 * directory and sub directory's.
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 * @see       http://us3.php.net/autoload  For more information on php 
 *            Autoloading Objects 
 */

class IncludeAutoLoader
{
    /**
    * Used to autoload all classes in this directory
    * The autoLoadInclude method sets php include path's
    * and loads required classes from the current 
    * directory and sub directory's.
    * 
    * @param string $className name of the class to load
    * 
    * @return void
    * 
    */
    static public function autoLoadInclude ($className)
    {

        $includePathArray 
            = explode(PATH_SEPARATOR, get_include_path());
        
        $pathInfo = pathinfo(__FILE__, PATHINFO_DIRNAME);
        
        set_include_path(str_replace(".:", "", get_include_path())); 
        
        if (!in_array($pathInfo, $includePathArray)) { 
            set_include_path(
                get_include_path() . 
                PATH_SEPARATOR . 
                $pathInfo
            );
        }
    
        if (strpos($className, '_')) {
    
            $classInfo = explode('_', $className);
    
            $file = array_pop($classInfo);
    
            $filePath 
                = pathinfo(__FILE__, PATHINFO_DIRNAME) . 
                DIRECTORY_SEPARATOR . 
                implode(DIRECTORY_SEPARATOR, $classInfo);
            
            if (!in_array($filePath, $includePathArray)) { 
        
                set_include_path(
                    get_include_path() . 
                    PATH_SEPARATOR . 
                    $filePath
                );
            }
    
        } else {
    
            $file = $className;
    
        }

        include_once "{$file}.class.php";

        //we could use this to register events
        
    }    
        
}

spl_autoload_register(array('IncludeAutoLoader', 'autoLoadInclude'));
?>