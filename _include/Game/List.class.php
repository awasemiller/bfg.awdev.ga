<?php
/**
 * Game List
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
 * Game List
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Game_List
{
   
    /**
     * used to sort a game list
     * this method is only accessible from within an implementation class
     *
     * @param array $games   An array of games
     * @param array $options sortkey required 
     *                         = [ RELEASEDATE | GAMENAME | GAMERANK | PLAYERCOUNT ]
     *                       sort 
     *                         = CONSTANT [SORT_ASC | SORT_DESC]
     *                       genre
     *                             = mixed [INT | default string all]
     *
     * @return mixed array of games | bool false
     * 
     * @see Game_List_Date::sortList
     * @see Game_List_Name::sortList
     * @see Game_List_Rank::sortList
     */
    protected static function sortList(array $games, array $options)
    {
        $outList = array();
        $outKey = array();
    
        /**
         * If the $list array has no games return false
         */
    
        if (!is_array($games) || !isset($options['sortkey'])) {
            return false;
        }
  
        foreach ($games as $key=>$value) {
            
            /**
             * if no genre is requested
             * if all genre is requested
             * if a genre id is passed and it matches
             * if the game has allgenreid and it matches to passed genre
             */
            
            /**
             * merge the games genre info
             */
             /**
              * @var $primaryGameGenre the games primary genre
              */
            $primaryGameGenre 
                = array(isset($value['genreid']) ? $value['genreid'] : null);
            /**
             * @var array $gameGenres the array which will contain 
             *                  all genre for the current game
             */

            $gameGenres 
                = isset($value['allgenreid']) 
                    ? array_merge(
                        $primaryGameGenre, explode(',', $value['allgenreid'])
                    ) : $primaryGameGenre;
            
            /**
             * @var bool optGenre was the genre option passed.
             */
                        
            $optGenre = isset($options['genre']) ? true : false;         
            /**
             * @var bool $meetsGenreReq should we keep this game based
             *                          on the requested genre option
             */            
            $meetsGenreReq 
                = (!$optGenre ||
                    ($optGenre && 
                        ($options['genre'] =='all' 
                            || in_array($options['genre'], $gameGenres)
                        )
                    )
                  ); 
             
            $hasSortKey = array_key_exists($options['sortkey'], $games[$key]); 
                
            if ($meetsGenreReq && $hasSortKey) {
                $outList[] = $value;
                $outKey[] = $value[$options['sortkey']];
            }
        }
    
    
        unset($games); // memory cleanup
    
    
        /**
         * If we have no games in our $out_list return FALSE
         */
    
        if (count($outList)<=0) {
            return false;
        }
    
        /**
         * $var $sort
         */
        $sort = (isset($options['sort']) 
                    && in_array(
                        $options['sort'], 
                        array(SORT_ASC,SORT_DESC)
                    )
                    ? $options['sort'] : SORT_DESC
                );
        
        /**
         * @var sortType
         */
     
        $sortType = (isset($options['sorttype']) 
                        && in_array(
                            $options['sorttype'], 
                            array(SORT_REGULAR ,SORT_NUMERIC,SORT_STRING)
                        ) ? $options['sorttype'] : SORT_REGULAR
                    );
        
        array_multisort($outKey, $sort, $sortType, $outList);
    
        if (isset($options['limit']) && $options['limit'] > 0) {
    
            $out = array();
            
            $options['offset'] 
                = isset($options['offset']) ? $options['offset'] : '0';
                
            $amount = '0';
    
            for ($i=0;$i<count($outList);++$i) {
    
                if ($options['limit'] <= $amount) {
                    break;
                }
    
                if ($i>= $options['offset']) {
                    $out[] = $outList[$i];
                    ++$amount;
                }
            }
    
            return $out;
    
        }
    
        return $outList;
    }
    
    /**
    * used return a count from a game list
    * this method is only accessible from within a child class
    * 
    * @param array $games   - An array of games
    * @param array $options - genre = INT | default string all
    *
    * @return int number of games
    * @see Game_List_Date::countList
    * @see Game_List_Name::countList
    * @see Game_List_Rank::countList 
    * 
    */
    
    protected static function countList(array $games, array $options)
    {
 
        if (!isset($options['genre']) 
            || (isset($options['genre']) && $options['genre'] == 'all')
        ) {
            return count($games);
        }
    
        $count=0;
    
        foreach ($games as $key=>$game) {

             /**
              * @var $primaryGameGenre the games primary genre
              */
            $primaryGameGenre 
                = array(isset($game['genreid']) ? $game['genreid'] : null);
            /**
             * @var $gameGenres the array which will contain 
             *                  all of the genre for the current game
             */
            $gameGenres = array();
            /**
             * merge primary and secondary game genre info
             */
            $gameGenres 
                = isset($game['allgenreid']) 
                    ? array_merge(
                        $primaryGameGenre, explode(',', $game['allgenreid'])
                    ) : $primaryGameGenre;

            if (in_array($options['genre'], $gameGenres)) {
                $count++;
            }
        }
    
        return $count;
    }
}

?>