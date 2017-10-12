<?php
/**
 * Configuration Class
 *
 * A simple way to store and retrieve configuration information.
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
 * Configuration Class
 *
 * A simple way to store and retrieve configuration information.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Configuration
{

    /**
     * This is the array containing all of our configuration information.
     * @access protected
     * @property array $config all assigned configuration key value pairs.
     */
    protected static $config = array();

    /**
     * load
     *
     * <code>
     * // Create an array with two key value pairs
     * $config = array();
     * $config['mykey'] = 'myvalue';
     * $config['myotherkey'] = 'myothervalue';
     * // load the config array.
     * configuration::load($config);
     * // both key value pairs are now stored in the config 
     * // property to be accessed at a later time.
     * </code>
     *
     * @param array $config - an array of config options
     * 
     * @return void
     */
    public static function load(array $config)
    {
        self::$config = $config;
    }

    /**
    * Get a configuration value.
    *
    * <code>
    * $config['mykey'] = 'myvalue';
    * configuration::load($config);
    *
    * if(configuration::get('mykey')){
    *   echo configuration::get('mykey');
    * }
    * // The above code will display the string [ myvalue ].
    * </code>
    *
    * @param string $name configuration key name
    * 
    * @return mixed [ config value | bool false ]
    */
    public static function get($name)
    {
        return isset(self::$config[$name]) ? self::$config[$name] : false;
    }

    /**
    * Set a configuration value
    *
    * <code>
    * // Set a config name mykey with a value of myvalue
    * configuration::set('mykey','myvalue');
    * // display the value of mykey.
    * echo configuration::get('mykey');
    * </code>
    *
    * @param string $name  configuration key name
    * @param mixed  $value configuration value
    * 
    * @return void
    */
    public static function set($name,$value)
    {
        self::$config[$name] = $value;
    }
    
    public static function getAll()
    {
        return self::$config;
    }
}
?>