<?php
/**
 * File - used for site level file manipulation.
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
 * File - used for site level file manipulation.
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class File
{
    /**
     * construct
     */
    public function __construct()
    {
        
    }

    /**
     * read file and return its contents 
     * 
     * @param string $file full path to file
     * 
     * @return mixed file contents
     */
    public static function read($file)
    {
        if (!is_file($file) || !is_readable($file)) { 
            return false; 
        }

        return file_get_contents($file);
    }

    /**
     * write data to file system
     *
     * @param string $file full path to file
     * @param mixed  $data data to write to file
     * 
     * @return bool [ sucess true | false on error ]
     * 
     * @deprecated
     */
    public static function write($file, $data)
    {

        if (!$fp = @fopen($file, "w")) {
            return false;
        }

        if (flock($fp, LOCK_EX)) {

            if (fwrite($fp, $data)) {
                flock($fp, LOCK_UN);
                fclose($fp);
                return true;
            }

            flock($fp, LOCK_UN);
            fclose($fp);

        }

        return false;

    }

    /**
     * writeAll data to file system
     *
     * @param string $file full path to file
     * @param mixed  $data data to write to file
     * 
     * @return bool [ sucess true | false on error ]
     */
    public static function writeAll($file, $data)
    {

        $rfile = $file.rand(10, 1000);
        
        if (!$fp = @fopen($rfile, "w")) {
            return false;
        }


        if (fwrite($fp, $data)) {
            fclose($fp); 
            return rename($rfile, $file);
        }


        return false;

    }    
    
    /**
    * delete a file from filesystem
    * 
    * @param string $file full path to file
    * 
    * @return bool
    */
    public static function delete($file)
    {
        if (is_file($file)) {
            return unlink($file);
        }
        return false;
    }

    /**
     * convert filesize to a human readable size
     *
     * @param string $file full path to file
     * 
     * @return mixed [string human readable size | False ]
     */
    public static function fileSizeToString($file)
    {
        if (is_file($file)) { 
            $bytes = filesize($file); 
        }

        if (!isset($bytes)) { 
            return false; 
        }

        return bytesToReadableSize($bytes);
    }

    /**
     * 
     * Returns a human readable size
     *
     * for more information
     * @see http://en.wikipedia.org/wiki/Binary_prefix
     * @param int $bytes
     * 
     * @return mixed [string human readable size | False ]
     */
    public static function bytesToReadableSize($bytes =0)
    {
        /**
         * Returns a human readable size
         *
         * for more information
         * @see http://en.wikipedia.org/wiki/Binary_prefix
         */
        $i=0;
        $iec = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
        while (($bytes/1024)>1) {
            $bytes = $bytes/1024;
            $i++;
        }
        return substr($bytes, 0, strpos($bytes, '.')+4).$iec[$i];        
    }
    
    /**
    * Returns a human readable file time
    *
    * @param string $file   full path to file
    * @param string $format outputted date string format. 
    * 
    * @return mixed [ string human readable file time | False ]
    * @see http://us3.php.net/manual/en/function.date.php
    */
    public static function fileTimeToString($file, $format='F d Y H:i:s')
    {

        if (!is_file($file)) { 
            return false; 
        }

        if ($time =@filemtime($file)) {
            return date($format, $time);
        } else {
            return false;
        }
    }

}
?>