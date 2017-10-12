<?php
/**
 * Configuration Locale Class
 * Used to retrieve localized configuration settings.
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
 * Configuration Locale Class
 * Used to retrieve localized configuration settings.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Configuration_Locale extends Configuration
{
    /**
     * @var $locale
     */
    private static $_locale = 'en';

    /**
     * set locale value
     * 
     * @param string $locale locale value
     * 
     * @return void
     */
    public static function setLocale($locale)
    {
        self::$_locale = $locale;
    }

    /**
     * Get locale
     * 
     * @return string $locale locale value
     */

    public static function getLocale()
    {
        return self::$_locale;
    }

    /**
     * Get config key value
     * 
     * @param string $config_key key to search
     * 
     * @return string value | null
     * 
     * @todo make private
     */

    public static function getValue($config_key)
    {

        $config_values = parent::get($config_key);

        if (is_array($config_values) 
            && array_key_exists(self::getLocale(), $config_values)
        ) {
            return $config_values[self::getLocale()];
        }

        return null;

    }
    
    /**
    * Get a configuration value.
    *
    * <code>
    * $config['mykey']['en'] = 'myvalue_en';
    * $config['mykey']['de'] = 'myvalue_de';
    * Configuration_Locale::load($config);
    *
    * if(Configuration_Locale::get('mykey')){
    *   echo Configuration_Locale::get('mykey');
    * }
    * // The above code will display the string [ myvalue_en ].
    * 
    * Configuration_Locale::setLocale('de');
    * 
    * if(Configuration_Locale::get('mykey')){
    *   echo Configuration_Locale::get('mykey');
    * }
    * // The above code will display the string [ myvalue_de ]. 
    * 
    * 
    * </code>
    *
    * @param string $name configuration key name
    * 
    * @return mixed [ config value | bool false ]
    */
    public static function get($name) 
    {
        return self::getValue($name);
    }
    
    /**
     * Set a locale configuration value
     * 
     * @param string $name  The configuration name
     * @param mixed  $value The configuration value
     * 
     * @return void
     */
    public static function set($name,$value)
    {
         self::$config[$name][self::getLocale()] = $value;
    }
}
?>