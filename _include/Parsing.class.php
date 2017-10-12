<?php
/**
 * Parsing - used for site level template parsing functions.
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
 * Parsing - used for site level template parsing functions.
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 * @example ../examples/004-parsing.php Example #4 Example Parsing
 */
class Parsing
{

    /**
    * @static
    * @var string $start_tag
    */
    protected static $start_tag = "{";

    /**
    * @static
    * @var string $stop_tag
    */
    protected static $stop_tag = "}";

    /**
    * var array $parsed
    */
    public static $parsed = array('parsed'=>0,'looped'=>0,'stripped'=>0);

    /**
    * Used to replace parse tags in stings.
    *
    * @param string $source html markup or string which requires dynamic replacement
    * @param array  $vars   key=>value data.
    * @param array  $sc     shortcode pre and post code.
    * @param bool   $strip  remove unparse tags
    * 
    * @return string
    */
    public static function parseTemplate(
        $source, 
        $vars=array(), 
        $sc=array(), 
        $strip=false
    ) {

        if (count($vars)>0) {

            $vars = array_change_key_case($vars, CASE_UPPER);
            
            $stripped = 0;
            
            while (list($key, $value) = each($vars) ) {

                if ($value && is_string($value)) {

                    $value = (isset($sc['PRE'][$key]) ? $sc['PRE'][$key] : '') . 
                            $value . 
                            (isset($sc['POST'][$key]) ? $sc['POST'][$key] : '');

                    $source = str_replace(
                        self::$start_tag.$key.self::$stop_tag, 
                        $value, 
                        $source
                    );

                    self::$parsed['parsed']++;
                }

                self::$parsed['looped']++;

            }

            if ($strip===true) {

                $source = preg_replace(
                    "#\{(\S[^\x02]*?\S)\}#", 
                    '', 
                    $source, 
                    -1, 
                    $stripped
                );
                
                self::$parsed['stripped'] = self::$parsed['stripped']+$stripped;

            }

            return($source);
        }

        return($source);
    }

}
?>