<?php
/**
 * Game List Date
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
 * Game List Date
 *
 * Used to sort a game list by release date.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */

class Game_List_Date extends Game_List
{

    /**
     * retrieve the list of games by ordered by name
     *
     * @param array $games   An array of games
     * @param int   $limit   - number of rows returned, defaults to 0 no limit
     * @param int   $offset  - position of the first row to return
     * @param array $options - sort = CONSTANT [SORT_ASC,SORT_DESC] 
     *                          default SORT_DESC
     *                       -- genre = INT | default string all
     *
     * @return mixed array of games | bool false
     */

    public static function getList(
        array $games, 
        $limit=0, 
        $offset=0, 
        array $options=array()
    ) {
    
        $query = array(
                    'sortkey'=>'releasedate',
                    'sorttype'=>SORT_STRING,
                    'limit'=>$limit,
                    'offset'=>$offset
                    );
    
        if (!isset($options['sort'])) {
            $options['sort'] = SORT_DESC;
        }
    
        return self::sortList($games, array_merge($options, $query));
    }
    
    /**
     * getCount
     *
     * @param array $games   - An array of games
     * @param array $options - genre = INT | default string all
     * 
     * @return int Number of games
     */
    public static function getCount(array $games, array $options=array())
    {
        return parent::countList($games, $options);
    }

}


?>