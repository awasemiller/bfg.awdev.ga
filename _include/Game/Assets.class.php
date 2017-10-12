<?php
/**
 * Game Assets
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
 * Game Assets
 *
 * Used to create game asset locations.
 *
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Game_Assets
{

    /**
     * used to create game assets
     * 
     * @param array $game - game array
     * 
     * @return array $game - game with additional asset values
     */

    public static function create($game)
    {

        if (isset($game['foldername'])) {

            $assetServer = configuration::get('asset_server');
            
            $folderName = $game['foldername'];
            
            $assetPath = $assetServer.'/'.$folderName;
            
            $assetName = substr($folderName, strpos($folderName, "_") + 1);
            
            $game['small']
                = $assetPath.'/'.$assetName.'_60x40.jpg';
            $game['med']
                = $assetPath.'/'.$assetName.'_80x80.jpg';
            $game['feature']
                = $assetPath.'/'.$assetName.'_feature.jpg';
            $game['subfeature']
                = $assetPath.'/'.$assetName.'_subfeature.jpg';
            $game['thumb1']
                = $assetPath.'/th_screen1.jpg';
            $game['thumb2']
                = $assetPath.'/th_screen2.jpg';
            $game['thumb3']
                = $assetPath.'/th_screen3.jpg';
            $game['screen1']
                = $assetPath.'/screen1.jpg';
            $game['screen2']
                = $assetPath.'/screen2.jpg';
            $game['screen3']
                = $assetPath.'/screen3.jpg';

            if (isset($game['hasdwfeature']) && $game['hasdwfeature'] =='yes') {
                $game['dwfeature_image'] 
                    = $assetPath.'/'.$assetName.'_'.
                        $game['dwwidth'].'x'.$game['dwheight'].'.jpg';
                    
                $game['dwfeature_flash']
                    = $assetPath.'/'.$assetName.'_'.
                        $game['dwwidth'].'x'.$game['dwheight'].'.swf';
            }

            if (isset($game['hasflash']) && $game['hasflash']=='yes') {
                $game['flash'] 
                    = $assetPath.'/'.$assetName.'_175x150.swf';
            }

            if (isset($game['hasvideo']) && $game['hasvideo']=='yes') {
                $game['video'] 
                    = $assetPath.'/'.$folderName.'.flv';
            }
        }

        return $game;
    }
}

?>