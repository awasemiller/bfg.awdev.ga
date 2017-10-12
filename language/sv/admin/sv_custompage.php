<?php
/**
 * SGS ADMIN/CUSTOMPAGE SV language
 *
 * Type: language
 * Subtag: sv
 * Description: Swedish
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
	'custompage_opt_default'=>'Anpassade sidor',
	'custompage_opt_view'=>'Visa sidor',
	'custompage_opt_new'=>'Nya sidor',
	'custompage_opt_edit'=>'Redigera sidor',

	'custompage_msg_file_exists'=>'Filen finns, välj ett annat filnamn.',
	'custompage_msg_file_created'=>'Sidan {FILENAME} skapas.',
	'custompage_msg_unable_to_write'=>'Kunde inte skriva filen: {FILENAME}.',
	'custompage_msg_confirm_delete'=>'Bekräfta att du vill ta bort <strong> {FILENAME} </ strong>',
	'custompage_msg_file_deleted'=>'Fil: {FILENAME} Utgår!',
	'custompage_msg_unable_to_delete'=>'Det går inte att ta bort filen {FILENAME}.',
	'custompage_msg_file_saved'=>'{FILENAME} sparas.',
	'custompage_msg_error_saving'=>'Fel vid sparande {FILENAME}.',
	'custompage_msg_unable_to_edit'=>'Det går inte att öppna ({FILENAME}) för redigering. Se till att filen har skapats.',

	'custompage_file_new'=>'NewFile',
	'custompage_file_caption'=>'Din bildtext',
	'custompage_file_content'=>'Innehållet går här',
	'custompage_file_meta_desc'=>'Meta Description',
	'custompage_file_meta_key'=>'Meta sökord',

	'custompage_btn_confirm'=>'Bekräfta',
	'custompage_btn_continue'=>'Fortsätt',
	'custompage_btn_submit'=>'skicka',

	'custompage_label_name'=>'Filnamn:',
	'custompage_label_caption'=>'Caption:',
	'custompage_label_content'=>'Innehåll:',
	'custompage_label_default_language'=>'Standardspråk:',
	'custompage_label_meta_desc'=>'Meta Description Tag (för sökmotorer):',
	'custompage_label_meta_key'=>'Nyckelord META-tagg (nyckelord separerade med kommatecken):',
	'custompage_label_allow_comments'=>'Tillåt kommentarer',
	'custompage_msg_comments_disabled'=>'Webbplatsen kommentarer inaktiveras. Aktivera denna funktion genom att <a href="{LINK}siteconfig.php?comments"> tillåta sajt kommentarer </a> för att ja i <a href="{LINK}siteconfig.php?comments"> Webbplatsinställningar »Kommentera Alternativ </a>.',

	'custompage_th_pages'=>'Befintliga sidor',
	'custompage_th_options'=>'Alternativ',
	'custompage_th_lang'=>'Språk',

	'custompage_edit'=>'Redigera',
	'custompage_delete'=>'Radera',
	'custompage_msg_no_pages'=>'Det finns inga anpassade sidor.',
	'custompage_msg_create_new'=>'Skapa en ny sida?',
	);
?>