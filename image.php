<?php
/**
 * Image
 *
 * Copyright (c) 2007 - 2010 Big Fish Games, Inc.
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
 * @version 0.9
 * @package PNP Tools
 * @subpackage SGS
 * @copyright Copyright (c) 2007 - 2010 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

	require_once('core_gamesite.php');

	if(!isset($_GET['image']) && $_GET['image'] ==''){
		echo "invalid request";
		exit;
	}else{
		$image = $_GET['image'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title></title>
	<script type="text/javascript" src="<?=g_BASE?>corejs.php"></script>
	<style type="text/css">
		html, body {
			margin: 0px;
			padding: 0px;
			text-align:center;
			cursor:pointer;

		}
		body{
			height:600px;
			background: #ffffff url(images/icons/icon_loading.gif) 50% 25% no-repeat;
		}
		img {
			margin: 0px;
			padding: 0px;
			border: none;
		}
		object {
			margin: 0px;
			padding: 0px;
			border: none;
		}
	</style>
</head>
<!-- FitPic(); -->
<body onload="FitPic();">
<?php
if(sgs_eregi('.jpg',$image)){
    echo '<img src="'.$image.'" width="640px" height="480px" onclick="self.close();"  />';
 }else{ //
	echo $sl->class['site_elements']->flashObject(g_BASE.'videoshell.swf','640','520','','flash_video','videoinfo='.$image.'&controllerobj=bfgplay','onclick=\'self.close();\'');
}
?>
</body>
</html>