<?php
/**
 * Site Gan - used parse download and buy links to create
 * 			redirect urls thru the Google Affiliate Network.
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
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Site Gan - used parse download and buy links for the 
 *            Google Affiliate Network.
 * 
 * @category  Framework
 * @package PNP Tools
 * @subpackage SGS
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 1.0
 * @link      https://affiliates.bigfishgames.com/tools/sgs/
 */
Class Site_Gan
{
    /**
     * Parse download and buy urls with Gan
     * lid and pubid params.
     * 
     * @param void
     * 
     * @return void
     */
    
    public static $urls = array(
                			'download_pc',
                			'download_mac',
                			'purchase_game'  
                            );
                            
    public static $ganUrl = 'http://gan.doubleclick.net/gan_click?lid={LID}&pubid={PUBID}&adurl=';                        
    
    
    
    public static function parseUrls()
    {
        foreach(
            self::$urls as $configString
        ){
           
            $url = str_replace(array('&{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}','?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}'), '', Configuration::get($configString));

            Configuration::set($configString,
                Parsing::parseTemplate(
                    self::$ganUrl.$url,
                    array(
            			'lid'=>Configuration::get('lid'),
            			'pubid'=>Configuration::get('pubid')
                    )
                )
            );
        }        
    }
}
?>