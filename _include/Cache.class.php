<?php
/**
 * Cache - used for site level data cache.
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
 * Cache - used for site level data cache.
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 * @example ../examples/002-cache.php Example #2 Cache Data
 */
class Cache extends File
{

    /**
     * @var array $files
     */
    protected static $files;

    /**
     * Class construct
     * 
     * @return void
     */
    public function __construct()
    {
        if (!method_exists('Configuration', 'get')) {
            trigger_error('Could not find Configuration class', E_USER_ERROR);
        }

        if (is_null(Configuration::get('cache_path'))) {
            trigger_error('No Cache Path configuration defined.', E_USER_ERROR);
        }

    }

    /**
     * Create a pointer to a working cache file.
     * 
     * @param string $name    human readable name of a cache file.
     * @param array  $options additional file options 
     *                        [ ext | lifetime | serialize | compress ]
     * 
     * @return bool [true - success || false on failure]
     */
    public static function setFile($name,$options = array())
    {

        if (!self::_isValidName($name)) {
            return false;    
        }
        
        /**
         * we'll add some additional information to our file
         * storage name to avoid files being overwritten when
         * additional cache options have been set.
         */
        
        $unique_key_values = $options;
        
        if (isset($unique_key_values['lifetime'])) {
            unset($unique_key_values['lifetime']);
        }
                
        $optk = implode('_', array_keys($unique_key_values));
        $optv = implode('_', array_values($unique_key_values));

        $fileOptions = self::_defaultFileOptions($name);

        if (isset($options['ext'])) {
            $fileOptions['ext'] = $options['ext'];
        }


        if (isset($options['lifetime'])) {
            $fileOptions['lifetime'] = self::_lifeTime($options['lifetime']); 
        }
        
        if (isset($options['compress'])) {
            $fileOptions['compress'] = $options['compress']; 
        }        
        
        if (isset($options['serialize'])) {
            $fileOptions['serialize'] = $options['serialize']; 
        }
        
        $fileOptions['filepath']
            = Configuration::get('cache_path') . 
                        md5($name . $optk . $optv) .
                        '.' .
                        $fileOptions['ext'];
    

        
   
        self::$files[self::_hashName($name)] 
            = $fileOptions;

        
        return true;

    }

    /**
     * Method used to test if named file is older then expected lifetime
     * Returns true if a new file is needed or if the file does not exist.
     * 
     * @param string $name the human readable name of the cache file
     * 
     * @return bool
     */
    public static function needNewFile($name)
    {
        // should we triger an error here?
        if (!self::_issetFile($name)) {
            return false;
        }

        if (!is_file(self::_filepathFile($name)) || self::_hasFileExpired($name)) {
            return true;
        }
        
        return false;
    }

    /**
     * Used to save data to a cache file.
     * 
     * @param string $name the human readable name of the cache file
     * @param mixed  $data the data to save to cache
     * 
     * @return bool
     */
    public static function save($name, $data)
    {

        // should we triger an error here?
        if (!self::_issetFile($name)) {
            return false;
        }
        
        if (self::_serializeFile($name)) {
            /**
             * @see http://us2.php.net/manual/en/function.serialize.php
             */
            $data = serialize($data);
        }

        if (self::_compressFile($name)) {
            /**
             * @see http://us2.php.net/manual/en/function.gzcompress.php
             */
            $data = gzcompress($data, 9);
        }

        return parent::writeAll(self::_filepathFile($name), $data);        
        
    }
    
    /**
     * Used to delete a cache file.
     * 
     * @param string $name the human readable name of the cache file
     * 
     * @return bool
     */
    public static function expire($name)
    {
        return parent::delete(self::_filepathFile($name));        
        
    }
    
    
    /**
     * Load a file from cache if it exists
     * 
     * @param string $name human readable name of a cache file.
     * 
     * @return mixed
     */
    public static function load($name)
    {

        // should we triger an error here?
        if (!self::_issetFile($name)) {
            return false;
        }

        $data = parent::read(self::_filepathFile($name));

        if (!$data) {
            return false;
        }

        // need to move this to a function

        if (self::_compressFile($name)) {
            /**
            * @see http://us2.php.net/manual/en/function.gzuncompress.php
            */
            $data = gzuncompress($data);

        }

        if (self::_serializeFile($name)) {
            /**
            * @see http://us2.php.net/manual/en/function.unserialize.php
            */
            $data = unserialize($data);
        }

        return $data;
    }


    /**
     * Check if string name is valid
     * 
     * @param string $name human readable name of a cache file. 
     * 
     * @return bool
     */
    private static function _isValidName($name)
    {
        return (is_string($name) && strlen($name) > 0 );
    }

    /**
     * Create default file options array
     * 
     * @param string $name human readable name of a cache file.
     * 
     * @return array  
     */
    private static function _defaultFileOptions($name)
    {
        return array(
                    'name'=>$name,
                    'ext' =>'db',
                    'filepath'=>null,
                    'lifetime'=>self::_lifeTime(),
                    'serialize'=>false,
                    'compress'=>false
                    );
    }
    
    /**
     * Used to convert string name to md5 hash value
     * 
     * @param string $name human readable name of a cache file.
     * 
     * @return string md5 hash
     */
    private static function _hashName($name)
    {
        return md5($name);
    }
    
    /**
     * Set default file lifetime
     * 
     * @param int $hours number of hours
     * 
     * @return int hours coverted to seconds
     */
    private static function _lifeTime($hours=1)
    {
        return $hours*60*60;
    }
    
    /**
     * Test to see if named file has been set in files array
     * 
     * @param string $name human readable name of a cache file.
     * 
     * @return bool 
     */
    private static function _issetFile($name)
    {
        return isset(self::$files[self::_hashName($name)]);
    }
    
    /**
     * Get the file path for named file
     * 
     * @param string $name human readable name of a cache file.
     * 
     * @return string complet file path 
     */
    private static function _filepathFile($name)
    {
        return self::$files[self::_hashName($name)]['filepath'];
    }
   
    /**
     * Does the named file require serialization
     *  
     * @param string $name human readable name of a cache file. 
     * 
     * @return bool
     */
    private static function _serializeFile($name)
    {              
        return self::$files[self::_hashName($name)]['serialize'];
    }
    
    /**
     * Does the named file require compression
     * 
     * @param string $name human readable name of a cache file. 
     * 
     * @return bool
     */
    private static function _compressFile($name)
    {              
        return self::$files[self::_hashName($name)]['compress'];
    }
    
    /**
     * has the named file expired
     * 
     * @param string $name human readable name of a cache file. 
     * 
     * @return bool
     */
    private static function _hasFileExpired($name)
    {
        return (
            time() > 
            (@filemtime(self::$files[self::_hashName($name)]['filepath']) + 
                self::$files[self::_hashName($name)]['lifetime'])
        );   
    }
    
    /**
     * returns an array of all working cache files
     * 
     * @return array
     */
    public static function getFiles()
    {
        return self::$files;
    }
}

?>