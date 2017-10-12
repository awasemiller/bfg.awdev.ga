<?php
/**
 * Game Locales
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
 * Game Locales
 *
 * Used to manage supported game Locale's.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Game_Locales
{

    /**
     * @var array $available List of supported locales
     */
    protected static $available = array(
                                        'da',
                                        'de',
                                        'en', 
                                        'es',
                                        'fr',
                                        'it',
                                        'ja',
                                        'jp',
                                        'nl',
                                        'pt',
                                        'sv'
                                        );
                                        
                                       

    /**
     * Get the list of supportad locales
     * 
     * @return array List of supported locales
     *
     * @assert() === array(
     *                         'da',
     *                         'de',
     *                        'en',
     *                         'es',
     *                         'fr',
     *                         'it',
     *                         'ja',
     *                         'jp',
     *                         'nl',
     *                         'pt',
     *                         'sv'
     *                         )
     */

    public static function getAvailable()
    {
        return self::$available;
    }

    /**
     * Test to see if locale is supported
     * 
     * @param string $locale sting value of locale to test
     * 
     * @return bool true if the locale is supported
     *
     * @assert(da) == True
     * @assert(de) == True
     * @assert(en) == True
     * @assert(es) == True
     * @assert(fr) == True  
     * @assert(it) == True
     * @assert(ja) == True
     * @assert(jp) == True
     * @assert(nl) == True
     * @assert(pt) == True
     * @assert(sv) == True
     * @assert(rx) == False
     */

    public static function isValidLocale($locale)
    {
        return in_array($locale, self::$available);
    }

}
?>