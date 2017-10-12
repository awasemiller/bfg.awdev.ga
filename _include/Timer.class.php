<?php
/**
 * Timer
 *
 * This is the class description
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
 * @author    Christopher Tolton <christopher.tolton@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
/**
 * Site Timer
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @author    Christopher Tolton <christopher.tolton@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Timer
{

    /**
    * Timers
    * @var $timers array
    * @access private
    */
    private static $_timers = array();

    /**
    * Stopped Timers
    * @var $stopped_timers array
    * @access private
    */
    private static $_stoppedTimers = array();

    /**
     * start a new timer
     * 
     * @param string $name - timer name  
     * @param float  $time - Unix timestamp, number of seconds since the Unix Epoch.
     * 
     * @return void
     */
    private static function _startTimer($name, $time)
    {
        self::$_timers[$name] = $time;
    }

    /**
    * create a new timer
    * 
    * @param string $name - timer name 
    *   
    * @return void
    */
    public static function mark($name)
    {
        self::_startTimer($name, microtime(true));
    }

    /**
    * stop a running timer
    * 
    * @param string $name - timer name 
    * 
    * @return void
    */

    public static function stop($name)
    {
        self::$_stoppedTimers[$name] = self::retrieve($name);
    }

    /**
    * retrieve the value of a named timer
    * 
    * @param string $name - timer name
    *  
    * @return float seconds.
    */
    public static function retrieve($name)
    {
        return (microtime(true) - self::$_timers[$name]);
    }

    /**
    * return all stopped timers
    * 
    * @return array
    */

    public static function listTimers()
    {
        return self::$_stoppedTimers;
    }

}
?>