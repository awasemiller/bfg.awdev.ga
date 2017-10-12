<?php
/**
 * Fetch Fopen
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
  * Fetch Fopen
  * 
  * @category  Framework
  * @package   Simple_XML
  * @author    William Moffett <william.moffett@bigfishgames.com>
  * @copyright 2007-2011 Big Fish Games, Inc.
  * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
  * @version   Release: 0.3.0
  * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
  */
class Fetch_Fopen extends Fetch
{
    /**
    * fetch
    * 
    * @return mixed [ data | false ]
    */
    public function fetch()
    {

        if (ini_get('allow_url_fopen') && is_string(self::$url)) {

            $otimeOut = ini_set('default_socket_timeout', self::$timeOut);

            if (!$fp = @fopen(self::$url, 'r')) {

                ini_set('default_socket_timeout', $otimeOut);

                return false;
            }

            $data = "";

            while (!feof($fp)) {
                $data .= fgets($fp, 4096);
            }

            fclose($fp);

            ini_set('default_socket_timeout', $otimeOut);

            return $data;
        }

        return false;
    }
}
?>