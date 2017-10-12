<?php
 /**
 * Site Online
 *
 * Copyright (c) 2007 - 2011 Big Fish Games, Inc.
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
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Class Site Online.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */
class Site_Online extends Site_Game{

		/**
		 * Main games array
		 */

		public static  $games;

		/**
		 * playcount array
		 */

		public static $playcount;

		/**
		 * fetchOnlinePlayCount
		 *
		 * @param void
		 *
		 * @return mixed array | FALSE
		 */

		public static function fetchOnlinePlayCount()
		{
			if(!is_array(self::$playcount)){
							
				$xmlSource = Games::fetchPlayerCount(Configuration::get('locale'));

				if(is_array($xmlSource) && count($xmlSource)>=1){

					$playcount = array();

					foreach($xmlSource as $key=>$value){
						$playcount[$value['gameid']] = $value;
					}

					self::$playcount = $playcount;
				}
			}

			if(is_array(self::$playcount)){
				return self::$playcount;
			}

			return false;
		}
		
		/**
		 * getGameCounts
		 *
		 * @param array $options
		 * -- genre= INT | default string all
		 *
		 * @return array
		 */

		public static function getGameCounts($options=array())
		{
			$games = Games::loadGames(array_merge($options,array('platform'=>'og','return'=>true)));
			
		    return Game_List_PlayerCount::getCount($games, $options);
		}
		
		public static function getTotalPlayersOnline()
		{
			
			$gameCounts = self::fetchOnlinePlayCount();
			
			$count = 0;
			
			foreach($gameCounts as $key=>$game){
				if(isset($game['playercount'])){
					$count = $count + $game['playercount'];
				}
			}
			return $count;
		}
		/**
		 * @todo re implement player count list
		 * getCountList
		 *
		 * use to retrieve online game list orderd by player count
		 *
		 * @param mixed $return [string = all | int = amount]
		 * @param array $options
		 * 	-- sort = CONSTANT Sorting flag [SORT_ASC,SORT_DESC] default SORT_DESC
		 *  -- genre= INT | default string all
		 *
		 * @return mixed array of games | bool false
		 */

		public static function getCountList($limit='all',$offset='0',$options=array())
		{
			$gameCounts = self::fetchOnlinePlayCount();

			$games = Games::loadGames(array_merge($options,array('platform'=>'og','return'=>true)));

			foreach($games as $key=>$game){
				$games[$key]['playercount'] = isset($gameCounts[$game['gameid']]['playercount']) ? $gameCounts[$game['gameid']]['playercount'] : 0;
			}
			
		    return Game_List_PlayerCount::getList(
		    								$games,
		    								$limit,
		                                	$offset,
		                                	$options
		                                	);
		}

		/**
		 * getDateList implements Site_Game getDateList
		 *
		 * @param mixed $return [string = all | int = amount]
		 * @param array $options
		 * 	-- sort = CONSTANT Sorting flag [SORT_ASC,SORT_DESC] default SORT_DESC
		 *  -- genre= INT | default string all
		 *
		 * @return mixed array of games by date | bool false
		 */

		public static function getDateList($limit='all',$offset='0',$options=array())
		{
		    return Game_List_Date::getList(
		                                Games::loadGames(array_merge($options,array('platform'=>'og','return'=>true))),
		                                $limit,
		                                $offset,
		                                $options
		                                );
		    
		}

		/**
		 * getNameList implements Site_Game getNameList
		 *
		 * @param mixed $return [string = all | int = amount]
		 * @param array $options
		 * 	-- sort = CONSTANT Sorting flag [SORT_ASC,SORT_DESC] default SORT_ASC
		 *  -- genre= INT | default string all
		 *
		 * @return mixed array of games | bool false
		 */

		public static function getNameList($limit=0,$offset=0,$options=array())
		{

		    return Game_List_Name::getList(
		                                Games::loadGames(
		                                    array_merge(
		                                        $options,
		                                        array(
		                                        	'platform'=>'og',
		                                        	'return'=>true
		                                        )
		                                    )
		                                ),
		                                $limit,
		                                $offset,
		                                $options
		                                );
		                                
		}
		/**
		 * getGame implements Site_Game getGame
		 * @param int $gameid
		 * @param string $gamekey alternate gameid key field to search
		 *
		 * @return mixed aray game | bool false
		 */

		public static function getGame($gameId, $gameKey='',$options=array())
		{
			return parent::getGame(Games::loadGames(array_merge($options,array('platform'=>'og','return'=>true))),$gameId,$gameKey);
		}
}
?>