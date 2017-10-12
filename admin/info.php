<?php
 /**
 * SGS Admin Area info
 * File: info.php
 * display php information
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
require_once('../core_gamesite.php');
Site_Parse::page_start();
if(!SGS_ADMIN){
	Site_Admin::adminLogin();
	Site_Parse::page_end();
	exit;
}

/**
* INFO_GENERAL	1	 The configuration line, php.ini location, build date, Web Server, System and more.
* INFO_CREDITS	2	PHP Credits. See also phpcredits().
* INFO_CONFIGURATION	4	Current Local and Master values for PHP directives. See also ini_get().
* INFO_MODULES	8	Loaded modules and their respective settings. See also get_loaded_extensions().
* INFO_ENVIRONMENT	16	Environment Variable information that's also available in $_ENV.
* INFO_VARIABLES	32	Shows all predefined variables from EGPCS (Environment, GET, POST, Cookie, Server).
* INFO_LICENSE	64	PHP License information. See also the license FAQ.
* INFO_ALL	-1	Shows all of the above. This is the default value.
*/

switch(SGS_QUERY){

	case 'general':
		$caller = INFO_GENERAL;
	break;

	case 'credits':
		$caller = INFO_CREDITS;
	break;

	case 'configuration':
		$caller = INFO_CONFIGURATION;
	break;

	case 'modules':
		$caller = INFO_MODULES;
	break;

	case 'environment':
		$caller = INFO_ENVIRONMENT;
	break;

	case 'variables':
		$caller = INFO_VARIABLES;
	break;

	case 'license':
		$caller = INFO_LICENSE;
	break;

	default:
	$caller = INFO_GENERAL;
	break;

}
ob_start();

if($caller == INFO_CREDITS){
	phpcredits(CREDITS_ALL);
}else{
	phpinfo($caller);
}

$info = ob_get_contents();
ob_end_clean();

$info = str_replace(array('<h1>PHP Credits</h1>','<hr />',' border="0"',' cellpadding="3"',' width="600"',' class="v"',' class="h"',' class="e"','< br />'),array('','','','','','',''),$info);
$info = str_replace(array(',','; ','.ini ','<td>','</td>','<br />'),array(',<br />',';<br />','.ini<br />','<td> ',' </td>',' <br />'),$info);


$info = wordwrap($info,70,"\n",true);


$text = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $info);

function stripInfoTags($tags, $text){
	foreach($tags as $tag){
		if(preg_match_all( '/<'.$tag.'[^>]*>([^<]*)<\/'.$tag.'>/iu', $text, $found)){
		   $text = str_replace($found[0],NULL,$text);
		}
	}
	return $text;
}

$text = stripInfoTags(array('h1','h2'), $text);
$text = str_replace('h2','h3 class="top"', $text);

$pages = array(
array('query'=>'default','text'=>'PHP Info'),
array('query'=>'general','text'=>'General'),
array('query'=>'credits','text'=>'PHP Credits'),
array('query'=>'configuration','text'=>'Configuration'),
array('query'=>'modules','text'=>'Modules'),
array('query'=>'environment','text'=>'Environment'),
array('query'=>'variables','text'=>'PHP Variables'),
array('query'=>'license','text'=>'PHP License')
);

Site_Admin::renderAdmin($pages,$text);
?>