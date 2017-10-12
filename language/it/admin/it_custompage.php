<?php
/**
 * SGS TOOLS ADMIN/CUSTOMPAGE EN language
 *
 * Type: language
 * Subtag: it
 * Description: Italian
 *
 * For more Subtags see http://www.iana.org/assignments/language-subtag-registry
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
 * @author Jesse Stewart <jesse.stewart@bigfishgames.com>
 * @version 1.0
 * @package SGS
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

if(!defined('SGS_INIT')){ exit; }

$language = array(
	'custompage_opt_default'=>'Custom Pages',
	'custompage_opt_view'=>'View Pages',
	'custompage_opt_new'=>'New Page',
	'custompage_opt_edit'=>'Edit Page',

	'custompage_msg_file_exists'=>'File Exists, Please choose a different file name.',
	'custompage_msg_file_created'=>'Page {FILENAME} created.',
	'custompage_msg_unable_to_write'=>'Unable to write file: {FILENAME}.',
	'custompage_msg_confirm_delete'=>'Please confirm you wish to delete <strong>{FILENAME}</strong>.',
	'custompage_msg_file_deleted'=>'File: {FILENAME} Deleted!',
	'custompage_msg_unable_to_delete'=>'Unable to delete file {FILENAME}.',
	'custompage_msg_file_saved'=>'{FILENAME} saved.',
	'custompage_msg_error_saving'=>'Error saving {FILENAME}.',
	'custompage_msg_unable_to_edit'=>'Unable to open ( {FILENAME} ) for editing. Make sure the file has been created.',

	'custompage_file_new'=>'NewFile',
	'custompage_file_caption'=>'Your Caption',
	'custompage_file_content'=>'Content goes here',
	'custompage_file_meta_desc'=>'Meta Description',
	'custompage_file_meta_key'=>'Meta Keywords',

	'custompage_btn_confirm'=>'Confirm',
	'custompage_btn_continue'=>'Continue',
	'custompage_btn_submit'=>'Submit',

	'custompage_label_name'=>'File Name:',
	'custompage_label_caption'=>'Caption:',
	'custompage_label_content'=>'Content:',
	'custompage_label_content'=>'Content:',
	'custompage_label_default_language'=>'Default Language:',
	'custompage_label_meta_desc'=>'Description META Tag (for search engines):',
	'custompage_label_meta_key'=>'Keywords META Tag (keywords separated by comma):',
	'custompage_label_allow_comments'=>'Allow Comments',
	'custompage_msg_comments_disabled'=>'Site comments are disabled. Enable this feature by setting <a href="{LINK}siteconfig.php?comments">allow site comments</a> to yes in <a href="{LINK}siteconfig.php?comments">Site Settings &raquo; Comment Options</a>.',

	'custompage_th_pages'=>'Existing Pages',
	'custompage_th_options'=>'Options',
	'custompage_th_lang'=>'Language',

	'custompage_edit'=>'Edit',
	'custompage_delete'=>'Delete',
	'custompage_msg_no_pages'=>'There are no custom pages.',
	'custompage_msg_create_new'=>'Create a new page?',
	);
?>