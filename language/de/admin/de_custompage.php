<?php
/**
 * PNP TOOLS ADMIN/CUSTOMPAGE DE language
 *
 * Type: language
 * Subtag: de
 * Description: German
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
	'custompage_opt_default'=>'Seiten anpassen',
	'custompage_opt_view'=>'Seiten ansehen',
	'custompage_opt_new'=>'Neue Seite erstellen',
	'custompage_opt_edit'=>'Seite bearbeiten',

	'custompage_msg_file_exists'=>'Dateiname bereits vorhanden. Wähle bitte einen anderen Namen.',
	'custompage_msg_file_created'=>'Die Seite {FILENAME} wurde gespeichert.',
	'custompage_msg_unable_to_write'=>'Die Datei {FILENAME} konnte nicht gespeichert werden.',
	'custompage_msg_confirm_delete'=>'Bitte bestätige, dass Du diese Datei löschen willst: <strong>{FILENAME}</strong>',
	'custompage_msg_file_deleted'=>'Diese Datei wurde gelöscht: {FILENAME}',
	'custompage_msg_unable_to_delete'=>'Diese Datei konnte nicht gelöscht werden: {FILENAME}',
	'custompage_msg_file_saved'=>'{FILENAME} wurde gespeichert.',
	'custompage_msg_error_saving'=>'Fehler beim Speichern von {FILENAME}.',
	'custompage_msg_unable_to_edit'=>'{FILENAME} konnte zur Bearbeitung nicht geöffnet werden. Stelle bitte sicher, dass diese Datei gespeichert wurde.',

	'custompage_file_new'=>'NeueDatei',
	'custompage_file_caption'=>'Deine Beschriftung',
	'custompage_file_content'=>'Text hier eintippen...',
	'custompage_file_meta_desc'=>'Meta-Beschreibung',
	'custompage_file_meta_key'=>'Meta-Stichwörter',

	'custompage_btn_confirm'=>'Bestätigen',
	'custompage_btn_continue'=>'Weiter',
	'custompage_btn_submit'=>'Abschicken',

	'custompage_label_name'=>'Dateiname:',
	'custompage_label_caption'=>'Beschriftung:',
	'custompage_label_content'=>'Inhalt:',
	'custompage_label_content'=>'Inhalt:',
	'custompage_label_default_language'=>'Standardsprache:',
	'custompage_label_meta_desc'=>'Meta-Tag-Beschreibung (für Suchmaschinen):',
	'custompage_label_meta_key'=>'Meta-Tag-Stickwörter (Stickwörter durch Kommata getrennt):',
	'custompage_label_allow_comments'=>'Seitenkommentare erlauben',
	'custompage_msg_comments_disabled'=>'Seitenkommentare sind momentan nicht erlaubt. Um diese zu aktivieren, stelle das „<a href="{LINK}siteconfig.php?comments">Seitenkommentare erlauben</a>“-Feld in <a href="{LINK}siteconfig.php?comments">Seiteneinstellungen &raquo; Kommentar-Einstellungen</a> auf „Ja“ ein.',

	'custompage_th_pages'=>'Vorhandene Seiten',
	'custompage_th_options'=>'Einstellungen',
	'custompage_th_lang'=>'Sprache',

	'custompage_edit'=>'Ändern',
	'custompage_delete'=>'Löschen',
	'custompage_msg_no_pages'=>'Du hast momentan keine von Dir erstellten Seiten.',
	'custompage_msg_create_new'=>'Eine neue Seite erstellen?',
	);
?>