<?php
/**
 * Games class place holder
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
 * Games class place holder
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Games
{
    
   // protected static $games = array();
    public static $count = 0;
    /**
     * Class construct 
     */
    public function __construct()
    {
    }
	
    public static function loadGames($options=array())
    {
            
			if(!isset($options['platform'])){
				$options['platform'] = PLATFORM;
			}

			if(!isset($options['locale'])){
				$options['locale'] = LOCALE;
			}
            self::$count++;
            
            
            $games = self::fetchFeed($options['platform'], $options['locale']);
            
			foreach($games as $key=>$value){
				$games[$key]['platform'] = $options['platform'];
			}
            
			return $games;

	}
	/**
	 * Used to fetch game archive feeds
	 * Enter description here ...
	 * @param unknown_type $platform
	 * @param unknown_type $locale
	 */
    public static function fetchFeed ($platform, $locale) {
        
        $sc = new Cache();
        $data = array();
        
        $url = Parsing::parseTemplate(
                                        Configuration::get('game_xml_request'),
                                        array(
                                            'xml_server'=>Configuration::get('xml_server'),
                                            'username'=>Configuration::get('username'),
                                            'locale'=>$locale,
                                            'platform'=>$platform
                                        )
                                    );
    
        $sc->setFile($url,$options=array('ext'=>'db','serialize'=>true,'lifetime'=>Configuration::get('lifetime_cache')));
       
        
        if($sc->needNewFile($url)){
             
            /**
             * @todo need method var not static curl
             */ 
            $site_fetch = Fetch::getInstance($url,Configuration::get('fetch_method'),Configuration::get('fetch_timeout'));
            
            $feed = $site_fetch->fetch();
        
            $data = XML::parse($feed);
            
            unset($feed);
            
            if(!is_array($data) || !isset($data[0]) || !array_key_exists('gameid', $data[0])){
            	/**
				 * @todo message admin unable to fetch new feed
            	 */
                                
                $data = $sc->load($url);

                return is_array($data) ? $data : array();

            }
            
            $sc->save($url, $data);
            
            return $data;
        }
        
        return $sc->load($url);

    }    
	/**
	 * Used to fetch game archive feeds
	 * Enter description here ...
	 * @param unknown_type $platform
	 * @param unknown_type $locale
	 */
    public static function fetchPlayerCount($locale) {
        
        $sc = new Cache();
        $data = array();
        
        $url = Parsing::parseTemplate(
                                        Configuration::get('ogplaycount_xml_request'),
                                        array(
                                            'xml_server'=>Configuration::get('xml_server'),
                                            'locale'=>$locale
                                        )
                                    );
                                    
    	/**
    	 * @todo configuration liftime
    	 */
        $sc->setFile($url,$options=array('ext'=>'db','serialize'=>true,'lifetime'=>1));
       
        
        if($sc->needNewFile($url)){
             
            /**
             * @todo need method var not static curl
             */ 
            $site_fetch = Fetch::getInstance($url,Configuration::get('fetch_method'),Configuration::get('fetch_timeout'));
            
            $feed = $site_fetch->fetch();
        
            $data = XML::parse($feed);
            
            unset($feed);
            
            if(!is_array($data) || !isset($data[0]) || !array_key_exists('gameid', $data[0])){
            	/**
				 * @todo message admin unable to fetch new feed
            	 */
                                
                $data = $sc->load($url);

                return is_array($data) ? $data : array();

            }
            
            $sc->save($url, $data);
            
            return $data;
        }
        
        return $sc->load($url);

    }    
}
?>