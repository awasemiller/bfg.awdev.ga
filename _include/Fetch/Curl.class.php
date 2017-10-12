<?php
/**
 * Fetch Curl
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
 * Fetch Curl
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */

class Fetch_Curl extends Fetch
{

    /**
     * get remote data 
     * 
     * @return mixed [ data | false ]
     */

    public function fetch()
    {
        if (extension_loaded('curl') 
            && function_exists('curl_init') 
            && is_string(self::$url)
        ) {

            $cu = curl_init();
            curl_setopt($cu, CURLOPT_URL, self::$url);
            curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($cu, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($cu, CURLOPT_HEADER, 0);
            curl_setopt($cu, CURLOPT_TIMEOUT, self::$timeOut);
            $data = curl_exec($cu);

            if (curl_error($cu)) {
                /**
                 * To display errors use the following.
                 * curl_errno($cu) - Returns the error number for 
                 *                   the last cURL operation.
                 * curl_error($cu) - Returns a clear text error message
                 *                   for the last cURL operation
                 */
                return false;
            }

            curl_close($cu);

            return $data;
        }

        return false;
    }
}
?>