<?php
/**
 * Game Platforms
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
 * Game Platforms
 *
 * Used to manage supported game platform types.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Game_Platforms
{

    /**
    * @var array $available
    */
    protected static $available = array('pc','mac','og');

    /**
     * Get the available Platforms
     * 
     * @return array List of available platforms
     */
      
    public static function getAvailable()
    {
        return self::$available;
    }

    /**
     * Test if a given plateform string is valid
     * 
     * @param string $platform platform value
     * 
     * @return bool true if the platform is valid
     * 
     * @assert(pc) == True
     * @assert(mac) == True
     * @assert(og) == True
     * @assert(ipone) == False
     */

    public static function isValidPlatform($platform)
    {
            return in_array($platform, self::$available);
    }

}
?>