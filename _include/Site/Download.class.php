<?php
 /**
 * Site Download
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
 * Class Site Download.
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
class Site_Download extends Site_Game{

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
			return Game_List_Name::getCount(Games::loadGames(array_merge($options,array('return'=>TRUE))), $options);
	        
		}

		/**
		 * getRankList
		 *
		 * @param mixed $return [string = all | int = amount]
		 * @param int $from
		 * @param array $options
		 * 	-- sort = CONSTANT Sorting flag [SORT_ASC,SORT_DESC] default SORT_DESC
		 *  -- genre= INT | default string all
		 *
		 * @return mixed array of games | bool false
		 */

		public static function getRankList($return='all',$from='0',$options=array())
		{
    		return Game_List_Rank::getList(Games::loadGames(array_merge($options,array('return'=>TRUE))),$return,$from,$options);
						
		}

		/**
		 * getDateList
		 *
		 * @param mixed $return [string = all | int = amount]
		 * @param array $options
		 * 	-- sort = CONSTANT Sorting flag [SORT_ASC,SORT_DESC] default SORT_DESC
		 *  -- genre= INT | default string all
		 *
		 * @return mixed array of games | bool false
		 */

		public static function getDateList($return='all',$from='0',$options=array())
		{
            return Game_List_Date::getList(Games::loadGames(array_merge($options,array('return'=>TRUE))),$return,$from,$options);
		}

		/**
		 * getNameList
		 *
		 * @param mixed $return [string = all | int = amount]
		 * @param array $options
		 * 	-- sort = CONSTANT Sorting flag [SORT_ASC,SORT_DESC] default SORT_ASC
		 *  -- genre= INT | default string all
		 *
		 * @return mixed array of games | bool false
		 */

		public static function getNameList($return='all',$from='0',$options=array())
		{
			return Game_List_Name::getList(Games::loadGames(array_merge($options,array('return'=>TRUE))),$return,$from,$options);
		}

		/**
		 * getGame
		 * 
		 * @param int $gameid
		 * @param string $gamekey alternate gameid key field to search
		 *
		 * @return mixed aray game | bool false
		 */

		public static function getGame($gameId,$gameKey='',$options=array())
		{
			return parent::getGame(Games::loadGames(array_merge($options,array('return'=>TRUE))),$gameId,$gameKey);
		}

}
?>