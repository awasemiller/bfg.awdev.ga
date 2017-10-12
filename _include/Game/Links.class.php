<?php
/**
 * Game Links Class
 *
 * Responsible for the creation of game URL's.
 * URL's include product, iframe and purchase locations.
 * See class construct to a complete list of locations.
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
 * Game Links Class
 *
 * Responsible for the creation of game URL's.
 * URL's include product, iframe and purchase locations.
 * See class construct to a complete list of locations.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Game_Links
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

    /**
     * @var array $urls
     */
    protected $urls = array();

    /**
     * Class Construct
     * 
     * @param string $platform The Game Platform type
     * @param string $locale   The current Locale
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
        
        Configuration_Locale::setLocale($locale);

        $parseVars = array(
            'bfg_server'=>
                Configuration_Locale::getValue('bfg_servers'),
            'bfg_store_server'=>
                Configuration_Locale::getValue('bfg_store_servers'),
            'bfg_site_id'=>
                Configuration_Locale::getValue('bfg_site_ids'),
            'asset_server'=>
                Configuration::get('asset_server'),
            'download_games_folder'=>
                Configuration_Locale::getValue('bfg_download_games_folders'),
            'online_games_folder'=>
                Configuration_Locale::getValue('bfg_online_games_folders'),
            'channel_param'=>
                Configuration::get('channel_param'),
            'channel'=>
                Configuration::get('channel'),
            'identifier_param'=>
                Configuration::get('identifier_param'),                
            'identifier'=>
                Configuration::get('identifier')
        );

        /**
         * product pages
         */
        $this->urls['game_info_pc'] 
            = Configuration::get('game_info_pc');
        $this->urls['game_info_mac'] 
            = Configuration::get('game_info_mac');
        $this->urls['game_info_og'] 
            = Configuration::get('game_info_og');
        /**
         * Download iframes
         */
        $this->urls['download_iframe_pc'] 
            = Configuration::get('download_iframe_pc');
        $this->urls['download_iframe_mac'] 
            = Configuration::get('download_iframe_mac');
        /**
         * Online Iframe
         */
        $this->urls['play_iframe_og']
            = Configuration::get('play_iframe_og');
        /**
         * Download PC and Mac
         */
        $this->urls['download_pc']
            = Configuration::get('download_pc');
        $this->urls['download_mac']
            = Configuration::get('download_mac');
        /**
         * Play Online
         */
        $this->urls['play_og']
            = Configuration::get('play_og');
        /**
         * Purchase Game
         */
        $this->urls['purchase_game']
            = Configuration::get('purchase_game');


        foreach ($this->urls as $url=>$location) {
            $this->urls[$url] = Parsing::parseTemplate($location, $parseVars);
        }

    }

    /**
     * Create Game Links
     * 
     * @param array $game A single game array
     * 
     * @return array the game returned with additiona key value pairs
     */

    public function create($game)
    {
        
        $validGame = (is_array($game) && 
            isset($game['gameid']) && 
            isset($game['foldername']));
        
        if ($validGame == true) {

            $fd = explode('_', $game['foldername']);
            $folder = $fd[1];

            if ($this->platform == 'pc') {

                $game = array_merge(
                    $game,
                    $this->_pcUrls($game['gameid'], $folder, $game['hasdownload'])
                );

            } else if ($this->platform == 'mac') {

                $game = array_merge(
                    $game,
                    $this->_macUrls($game['gameid'], $folder, $game['hasdownload'])
                );

            } else if ($this->platform == 'og') {

                $game = array_merge(
                    $game, 
                    $this->_ogUrls($game['gameid'], $folder, $game['foldername'])
                );

            }

            if (isset($game['productid'])) {

                $game['purchase_game'] 
                    = parsing::parseTemplate($this->urls['purchase_game'], $game);
            }

            if (isset($game['pcgameid'])) {

                $game = array_merge(
                    $game,
                    $this->_pcUrls($game['pcgameid'], $folder, $game['hasdownload'])
                );

            }

            if (isset($game['macgameid'])) {

                $game = array_merge(
                    $game,
                    $this->_macUrls(
                        $game['macgameid'], 
                        $folder, 
                        $game['hasdownload']
                    )
                );

            }

            if (isset($game['oggameid'])) {

                $game = array_merge(
                    $game,
                    $this->_ogUrls($game['gameid'], $folder, $game['foldername'])
                );

            }

        }

        return $game;

    }

    /**
     * Use to create PC URL's
     * 
     * @param int    $gameid      The Game ID
     * @param string $folder      The game Foldername
     * @param string $hasdownload Can the game be downloaded
     * 
     * @return array
     */

    private function _pcUrls($gameid, $folder, $hasdownload='no')
    {

        $game = array();

        $vars = array('gameid'=>$gameid,'folder'=>$folder);

        $game['game_info_pc'] 
            = Parsing::parseTemplate($this->urls['game_info_pc'], $vars);

        if ($hasdownload =='yes') {

            $game['download_iframe_pc'] 
                = Parsing::parseTemplate($this->urls['download_iframe_pc'], $vars);
            $game['download_pc'] 
                = Parsing::parseTemplate($this->urls['download_pc'], $vars);
        }

        return $game;
    }

    /**
     * Use to create MAC URL's 
     * 
     * @param int    $gameid      The Game ID
     * @param string $folder      The Games Foldername
     * @param string $hasdownload Can the game be downloaded
     * 
     * @return array
     */
    private function _macUrls($gameid, $folder, $hasdownload='no')
    {

        $game = array();

        $vars = array('gameid'=>$gameid,'folder'=>$folder);

        $game['game_info_mac'] 
            = Parsing::parseTemplate($this->urls['game_info_mac'], $vars);

        if ($hasdownload =='yes') {

            $game['download_iframe_mac'] 
                = Parsing::parseTemplate($this->urls['download_iframe_mac'], $vars);
            $game['download_mac'] 
                = Parsing::parseTemplate($this->urls['download_mac'], $vars);
        }

        return $game;
    }

    /**
     * Use to create OG URL's
     * 
     * @param int    $gameid     The Game ID
     * @param string $folder     The Game Folder
     * @param string $foldername The Game Folder Name 
     * 
     * @return array
     */
    private function _ogUrls($gameid, $folder,$foldername)
    {
        $game = array();

        $vars = array('gameid'=>$gameid,'folder'=>$folder,'foldername'=>$foldername);

        $game['game_info_og'] 
            = Parsing::parseTemplate($this->urls['game_info_og'], $vars);
        $game['play_iframe_og'] 
            = Parsing::parseTemplate($this->urls['play_iframe_og'], $vars);
        $game['play_og'] 
            = Parsing::parseTemplate($this->urls['play_og'], $vars);
        return $game;

    }

}

?>