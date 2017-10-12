<?php
/**
 * SGS Module: RSS
 * File: module.php
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
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package PNP Tools
 * @subpackage SGS
 *
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */
if(!defined('SGS_INIT')){ exit; }

$cachable = true;

if(defined('ADMINDISPLAY')){
	$name = Site_Language::display('rss_caption');
	$version = '1.0';
	$author = 'William Moffett';
	$description = '';
	$icon ='';
}

if(!function_exists('rsslink')){
	function rsslink()
	{
	    
	   
		if(isset($_GET['games'])){
		    
		    $request = strtolower($_GET['games']);
		    
        	if($request == 'new-download'){
        		$request = 'glrelease';
        	}else if($request == 'top-download'){
        		$request = 'glrank';
        	}else if($request == 'new-online'){
        		$request = 'glreleaseog';
        	}else if($request == 'top-online'){
        		$request = 'glrankog';
        	}
        	
        	/**
        	 * @todo fix request 
        	 * Enter description here ...
        	 * @var unknown_type
        	 */
        	
		    $genreSnames = Genre::getGenreListSnames();
	
		    
            if(in_array($request, $genreSnames)){
			    return '<link rel="alternate" type="application/rss+xml" title="'.Genre::getGenreNameBySname($request).'" href="'.((defined('SEO') && SEO == TRUE) ? Configuration::get('sgs_base_url').'rss/'.$_GET['games'].'-'.PLATFORM.'-'.LOCALE.'.xml' : Configuration::get('module_base_url').'rss/rss.php?feed='.$_GET['games'].'&platform='.PLATFORM.'&locale='.LOCALE).'">';
	        }
		}

		return FALSE;
	}
}
?>