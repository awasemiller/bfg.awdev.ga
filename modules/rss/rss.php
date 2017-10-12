<?php
/**
 * SGS Module: RSS
 * File: rss.php
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
header('Content-type: application/xml', TRUE);
if(isset($_REQUEST['platform']) && in_array($_REQUEST['platform'],array('pc','mac','og'))){
	define('PLATFORM',$_REQUEST['platform']);
}
require_once('../../core_gamesite.php');



require_once(Configuration::get('module_path').'rss/functions.php');

Site_PageCache::$cacheable = false;
Site_Parse::page_start();
echo create_rss((isset($_GET['feed']) ? $_GET['feed'] :''));
Site_Parse::page_end();
?>