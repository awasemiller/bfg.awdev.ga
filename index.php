<?php
/**
 * Index
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
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

	require_once('core_gamesite.php');

	if(isset($_GET['games'])){

		$location = 'download-games.php?games='.strtolower($_GET['games']);

	}else if(Configuration::get('front_page') !='' && !sgs_eregi(Configuration::get('front_page'),SGS_SELF)){
		$location = Configuration::get('front_page');

	}else if(Configuration::get('custom_page') !='' && Configuration::get('custom_page') !='Index View' && is_file(Configuration::get('custom_path').LOCALE.'_'.Configuration::get('custom_page').'.page') && is_readable(Configuration::get('custom_path').LOCALE.'_'.Configuration::get('custom_page').'.page')){

		if(defined('SEO') && SEO == TRUE){
			$location = Configuration::get('custom_page').'.html';
		}else{
			$location = 'page.php?id='.Configuration::get('custom_page');
		}

	}else{

		if(!Configuration::get('default_index_view') || Configuration::get('default_index_view') ==''){
			
			Configuration::set('default_index_view','new-download');
		}

		if(Configuration::get('seo') == true){
			$location = Configuration::get('default_index_view').'-games.html';
		}else{
			$location = 'download-games.php?games='.Configuration::get('default_index_view');
		}
	}

	/**
	 * if locale is passed we will forward the request to self for locale redirect
	 */
	if(isset($_GET['locale'])){
		$location = SGS_SELF;
	}

	header("Location: {$location}");
	exit;
?>