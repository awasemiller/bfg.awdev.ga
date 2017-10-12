<?php
/**
 * Site Elements Class
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
 * @link       https://affiliates.bigfishgames.com/tools/sgs/L
 */

/**
 * Class Site Elements.
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

if(!defined('SGS_INIT')){ exit; }

class Site_Elements{

        /**
		 * imageTag
		 *
		 * @param $src		src path to image
		 * @param $alt		alttext altenate text
		 * @param $id		id image id
		 * @param $class	class image css class
		 * @param $width	width image height
		 * @param $height	height image width
		 * @param $longdesc	description
		 *
		 * @return string image tag
		 */

		public static function imageTag($src, $alt='', $id='', $class='', $width='', $height='', $js='', $longdesc='')
		{
		    
            $img = '';
            
			if($src !=''){
				$img = '<img src="'.$src.'" ';
				$img .= ($alt !='') ? ' alt="'.$alt.'" ' : '';
				$img .= ($id !='') ? ' id="'.$id.'" ' : '';
				$img .= ($class !='') ? ' class="'.$class.'" ' : '';
				$img .= ($height !='') ? ' height="'.$height.'" ' : '';
				$img .= ($width !='') ? ' width="'.$width.'" ' : '';
				$img .= ($js !='') ? ' js="'.$js.'" ' : '';
				$img .= ($longdesc !='') ? ' longdesc="'.$longdesc.'" ' : '';
				$img .= ' />';
			}
			return $img;
		}

		/**
		 * anchorTag
		 *
		 * @param string $href     href 
		 * @param string $contents contents text or object to display within the anchor
		 * @param string $id	   id ID
		 * @param string $class	   class CSS class
		 * @param string $js       js custom anchor javascript code
		 * @param string $title    title attribute value
		 * @param string $rel      rel attribute value
		 * @param string $name     name attribute value
		 *
		 * @return string anchor tag
		 */
		public static function anchorTag($href, $contents='', $id='', $class='', $js='', $title='', $target='', $rel='', $name='')
		{
		        
		    $anchor = '';
		    
			if($href !=''){
			    
				$anchor = '<a href="'.$href.'"';
				$anchor .= ($title !='') ? ' title="'.$title.'"' : '';
				$anchor .= ($id !='') ? ' id="'.$id.'"' : '';
				$anchor .= ($class !='') ? ' class="'.$class.'"' : '';
				$anchor .= ($js !='') ? ' '.$js.'' : '';
				$anchor .= ($target !='') ? ' target="'.$target.'" ' : '';
				$anchor .= ($rel !='') ? ' rel="'.$rel.'" ' : '';
				$anchor .= ($name !='') ? ' name="'.$name.'" ' : '';
				$anchor .= '>';
				$anchor .= $contents;
 				$anchor .= '</a>';

			}
					
			return $anchor;
		}

		/**
		 * Enter description here ...
		 * 
		 * Types feature DW feature
		 * @param array $game
		 * @param string $type
		 */
		public static function gameFlashObject($game, $type='feature')
		{
    
		    /**
		     * @todo test if game  has a flash clip
		     */
		    		    
		    if($type=='feature'){
		        $object = array();
		        $object['src'] = $game['flash'];
		        $object['flashvars'] = 'gameinfo='.SGS_BASE_URL.$game['gameinfo_url'];
		        $object['width'] = '175';
		        $object['height'] = '150';
		        $object['alt'] = $game['feature'];
		        $object['class'] = (defined('FEATURE_CLASS') ? FEATURE_CLASS : '');
                //$object['title'] = $game['gamename'];		        
		        $data =  json_encode($object);
		        
		    }
		    		  
		    /**
		     * @todo test if game  has a dwflash clip
		     */    
		    if($type=='dwfeature'){
		        $object = array();
		        $object['src'] = $game['dwfeature_flash'];
		        $object['flashvars'] = 'gameinfo='.SGS_BASE_URL.$game['gameinfo_url'];
		        $object['width'] = $game['dwwidth'];
		        $object['height'] = $game['dwheight'];
		        $object['alt'] = $game['feature'];
		        $object['class'] = (defined('DWFEATURE_CLASS') ? DWFEATURE_CLASS : '');
		        //$object['title'] = $game['gamename'];
		        $data = json_encode($object);		        
      
		    }
		    
		    $data = str_ireplace('"',"'", $data);
		    
		    return '<span class="flash" style="display:none;" data="'.$data.'"></span>';
		    
		}

}
?>