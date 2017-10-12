<?php
/**
 * Game Information
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
 * Game Information
 *
 * A wrapper class used to merge game assets and links
 * and provide an easy method to retrieve the information.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Game_Information
{
    /**
     * Current working platform
     * @var string $platform
     */
    protected $platform;

    /**
     * @var string $locale
     */
    protected $locale;
    
    public $Game_Links;
    /**
     * Class construct
     * 
     * @param string $platform game platform
     * @param string $locale   game locale
     * 
     * @return void
     */
    public function __construct($platform='pc', $locale='en')
    {
        if (!Game_Platforms::isValidPlatform($platform)) {
            trigger_error("Invalid platform: {$platform}!", E_USER_ERROR);
        }

        $this->platform = $platform;

        if (!Game_Locales::isValidLocale($locale)) {
            trigger_error("Invalid locale: {$locale}!", E_USER_ERROR);
        }
        
        $this->locale = $locale;
        
        $this->Game_Links = new Game_Links($platform, $locale);
    }

    /**
     * add a comment here 
     * 
     * @param array $game     A game array
     * @param array $key_list An array of keys you would like returned
     * 
     * @return array $game    The game array with requested keys
     */
     
    public function get($game, $key_list=array())
    {
        $game = self::_mergeRequirments($game);
        
        $game['platform'] = $this->platform;
        $game['locale'] = $this->locale;        
        
        if (is_object($this->Game_Links) 
            && ($this->Game_Links instanceof Game_Links)
        ) {
            $game = $this->Game_Links->create($game);

        }
        
        $game = Game_Assets::create($game);
        
        if (count($key_list) >0) {

            // strip unwanted key value pairs

            $out = array();

            foreach ($key_list as $key=>$value) {
                $out[$value] = isset($game[$value]) ? $game[$value] : null;
            }

            $game = $out;
        }

        return $game;

    }

    /**
     * merge_requirments
     * 
     * @param array $game A game array
     * 
     * @return array $game the game array with systemreq merged.
     */
     
    private static function _mergeRequirments($game)
    {

        if (is_array($game)) {

            if (isset($game['systemreq'])) {

                if (isset($game['systemreq']['pc'])) {

                    $game = array_merge($game, $game['systemreq']['pc']);

                } else if (isset($game['systemreq']['mac'])) {

                    $game = array_merge($game, $game['systemreq']['mac']);

                }

                unset($game['systemreq']);

            }
        }

        return $game;

    }

}

?>