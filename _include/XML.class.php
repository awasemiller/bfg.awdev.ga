<?php
/**
 * XML for use in parsing xml documents
 *
 * This class is used to parse Big Fish Games XML Documents.
 * The Simple class is used to blah bah blah
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
 * XML Doc Block comment
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 * @example   ../examples/003-xml.php Example #3 Parse XML Data
 */
class XML
{


    /**
     * attributes
     *
     * @access public
     * @var array list of attributes found in a given xml tag.
     */
    public static $attributes = array();

    /**
     * Parse a valid xml document and return an array
     *
     * @param string $sxml A well-formed XML string
     *
     * @return mixed Returns an array on success |On error returns false
     *
     */

    public static function parse($sxml)
    {

        self::$attributes = array();
        // need to suppress the warning here
        $xml = simplexml_load_string($sxml);

        if (!is_object($xml) || (get_class($xml) != 'SimpleXMLElement')) {
            return false;
        }

        $attributes = get_object_vars($xml->Attributes());
      
        if (is_array($attributes) && isset($attributes['@attributes'])) {
            foreach ($attributes['@attributes'] as $key=>$value) {
                self::$attributes[$key] = $value;
            }
        }

        $listTypes = array('pc','mac','og','ogplaycount');

        $hasListTypeAttribute 
            = in_array(self::$attributes['listtype'], $listTypes);

        if (isset(self::$attributes['listtype'])) {
            if ($hasListTypeAttribute) {
                 $rkey = 'game';
            } else {
                 $rkey = self::$attributes['listtype'];
            }
        }
 
        if (isset($rkey) && $rkey !='') {
            
            if (method_exists($xml, 'xpath')) {
               
                if ($gamexml = $xml->xpath('gamexml/'.$rkey.'')) {

                    return self::_oxml2array($gamexml);
                }
                
            }

            $xml = self::_oxml2array($xml);

            if (isset($xml['gamexml']) && array_key_exists($rkey, $xml['gamexml'])) {
                
                return $xml['gamexml'][''.$rkey.''];
            }
           
        }

        return self::_oxml2array($xml);
    }

    /**
     * Convert a simpleXML Object into an array
     *
     * @param object $oxml An object of the class SimpleXMLElement or array
     *
     * @return mixed Returns an array on success | On error returns false
     *
     */

    private static function _oxml2array($oxml)
    {

        if (is_object($oxml) && (get_class($oxml) == 'SimpleXMLElement')) {
            $oxml = get_object_vars($oxml);
        }

        if (is_array($oxml)) {

            $out = array();

            foreach ($oxml as $key=>$value) {
                $out[$key] = self::_oxml2array($value);
            }

            return $out;
        }

        return $oxml;
    }

}
?>