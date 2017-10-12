<?php
/**
 * Fetch - Abstract class
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
 * Site Fetch - Abstract class
 * 
 * @abstract
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 * @example   ../examples/001-fetch.php Example #1 Fetch
 */
abstract class Fetch
{

    /**
    * @var string $url - location resource
    * @access protected
    */
    protected static $url;

    /**
    *
    * @var int $timeOut - number of seconds befor the request is aborted.
    */
    protected static $timeOut;

    /**
    * __construct
    *
    * @param string $url     - the url to retrieve
    * @param int    $timeOut - timeout in seconds
    * 
    * @return void
    */
    public function __construct($url,$timeOut)
    {
        /**
        * set url
        */
        self::setUrl($url);
        /**
        * set timeout
        */
        self::setTimeOut($timeOut);

        if (self::getUrl($url)==='') { 
            trigger_error('Url can not be empty', E_USER_ERROR);
        }

    }

    /**
    * get_instance
    *
    * @param string $url     - the url to retrieve
    * @param string $class   - the class to load defaults to getcontents
    * @param int    $timeOut - timeout in seconds defaults to 10
    * 
    * @return object
    * 
    * @assert ('','getcontents',0) == instanceof fetch_getcContents
    */

    public static function getInstance($url, $class=null, $timeOut=10)
    {
        switch (strtolower($class)){
            
        case 'getcontents':

                return new Fetch_GetContents($url, $timeOut);

            break;

        case 'curl':

                return new Fetch_Curl($url, $timeOut);

            break;

        case 'fopen':

                return new Fetch_Fopen($url, $timeOut);

            break;

        default:

                return new Fetch_GetContents($url, $timeOut);

        }
    }

    /**
     * abstract fetch must be implemented by extended classes.
     * 
     */
    abstract public function fetch();

    /**
     * Set the url you wish to request
     * 
     * @param string $url the url we wish to request
     * 
     * @return void
     */
    public function setUrl($url)
    {
        self::$url = $url;
    }
    
    /**
     * Time limit to fetch the remot file
     * 
     * @param int $timeOut timeout in seconds
     * 
     * @return void
     */
    public function setTimeOut($timeOut)
    {
        self::$timeOut = $timeOut;
    }

    /**
     * get the working ur;
     * 
     * @return string the current working url
     */
    public function getUrl()
    {
        return self::$url;
    }

    /**
     * get the current time)ut value
     * 
     * @return int the current time)ut value
     */
    public function getTimeOut()
    {
        return self::$timeOut;
    }
}
?>