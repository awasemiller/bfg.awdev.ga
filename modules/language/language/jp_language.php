<?php
/**
 * SGS Module: Language JP language file
 * File: language/jp_language.php
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
$language = array(
	/**
	 * module language
	 */
	'language_caption'=>'言語を選択してください',
	'language_adminMessage'=>'このモジュールは多言語を表示する機能が有効でない限り表示されません。<br />
	この機能を有効にするには <a href="#" onClick=\'parent.location="'.Configuration::get('admin_base_url').'siteconfig.php?language"\'>サイト設定 > 言語</a> で <a href="#" onClick=\'parent.location="'.Configuration::get('admin_base_url').'siteconfig.php?language"\'>多言語</a>に設定してください。'

	);

?>