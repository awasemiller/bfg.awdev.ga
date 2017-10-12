<?php
/**
 * PNP TOOLS DE language
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
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package SGS
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

if(!defined('SGS_INIT')){ exit; }

$language = array(
	/**
	 * Default allowed languages
	 */
    'da'=>'Dansk',
	'de'=>'Deutsch',
	'en'=>'English',
	'es'=>'Espa&ntilde;ol',
	'fr'=>'Fran&ccedil;ais',
    'it'=>'Italiano',
    'nl'=>'Nederlands',
    'pt'=>'Português',
    'sv'=>'Svenska',
	'jp'=>'日本語',
	/**
	 * read more
	 */
	'read_more'=>'Nähere Infos',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Erfolg',
	'admin_error'=>'Fehler',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Anmelden',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Start',
	 'admin_navlinks_site_settings'=>'Seiteneinstellungen',
	 'admin_navlinks_custom_pages'=>'Seiten anpassen',
	 'admin_navlinks_modules'=>'Module',
	 'admin_navlinks_php_info'=>'PHP-Info',
	 'admin_navlinks_leave_admin'=>'Admin-Bereich verlassen',
	 'admin_navlinks_logout'=>'Abmelden',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menü',
	 'admin_renderadmin_options'=>'Optionen',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Benutzernamen und Passwort eingeben',
	'auth_doLogin_error_invalid'=>'Ungültige Eingabe',
	'auth_login_form_username'=>'Benutzername:',
	'auth_login_form_password'=>'Passwort:',
	'auth_login_form_autologin'=>'Ich möchte angemeldet bleiben',
	'auth_login_form_submit'=>'Anmelden',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Pfad: ',
	'time_set'=>'Zeit: ',
	'file_set'=>'Datei: ',
	'target_file_req'=>'Eine Zieldatei wird für den Cachespeicher benötigt.',
	'no_source_processing'=>'Die zur Abwicklung benötigte Bezugsquelle fehlt.',
	'unable_to_open_for_writing'=>'Die zu beschreibende Datei {FILENAME} konnte nicht geöffnet werden.',
	'written_to'=>'Hinterlegt in ',
	'no_source_writing'=>'Beschreibbare Bezugsquelle fehlt.',
	'deleted'=>'Folgendes wurde gelöscht: ',
	'permission_denied'=>'Zugriff verweigert: ',
	'filename_does_not_exist'=>'Die Datei {FILENAME} existiert nicht.',
	'file_does_not_exist'=>'-Datei existiert nicht.',
	'file_expired'=>'-Datei-Laufzeit ist ausgelaufen am: {DATE}. Eine neue wird benötigt.',
	'file_valid_until'=>'-Datei ist gültig bis: ',
	'unable_to_extract'=>'Informationen dieser Datei können nicht extrahiert werden: ',
	'unable_to_open'=>'Folgende Datei kann nicht geöffnet werden: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Löschen',
    'comments_add_comment'=>'Kommentar hinzufügen',
    'comments_read_more'=>'Mehr lesen',
    'comments_comments_txt'=>'Kommentare',
    'comments_no_comments_type'=>'Es gibt noch keine Kommentare für dieses {TYPE}. Füge einen Kommentar hinzu.',
    'comment_deleted'=>'Kommentar gelöscht!',
    'comment_delete_failed'=>'Das Löschen des Kommentars konnte nicht durchgeführt werden.',
    'comments_name_req'=>'Dein Name wird benötigt, damit der Kommentar abgeschickt werden kann.',
    'comments_name_invalid'=>'Name enthält unzulässige Zeichen.',
    'comments_email_req'=>'Email-Adresse wird benötigt, um den Kommentar abzuschicken.',
    'comments_email_invalid'=>'E-Mail-Adresse ist ungültig.',
    'comments_url_req'=>'Web-Adresse wird benötigt, um Kommentar abzuschicken.',
    'comments_url_invalid'=>'Unzulässige Web-Adresse.',
    'comments_txt_req'=>'Trage Deinen Kommentar ein',
    'comments_txt_invalid'=>'Dein Kommentar enthält unzulässige Zeichen.',
    'comment_duplicate'=>'Dieser Kommentar existiert bereits',
    'comment_fail_save'=>'Kommentar konnte nicht gespeichert werden',
    'comment_saved'=>'Kommentar wurde gespeichert',
	'comment_name_anonymous'=>'anonymous',
    /**
     * site_comments.class.php
     * comment form
     */
     'comments_form_name'=>'Name:',
     'comments_form_email'=>'E-mail-Adresse:',
     'comments_form_url'=>'Web-Adresse:',
     'comments_form_comment'=>'Kommentar:',
     'comments_form_submit'=>'Abschicken',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Fehler: ',
	'fetch_fetching'=>'Abruf: ',
	'fetch_unable_to_open'=>'Remote-Datei kann nicht geöffnet werden. ',
	'fetch_unable_to_fetch'=>'Remote-Datei kann nicht abgerufen werden.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'Download-Spiele',
    'main_nav_mac_downloads'=>'MAC Downloads',
    'main_nav_online_games'=>'Online-Spiele',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULL',
	'genre_info_0_text'=>'NULL',
	'genre_info_253_caption'=>'Alle',
	'genre_info_253_text'=>'Unser Spielkatalog, hunderte der besten Spiele!',
	'genre_info_254_caption'=>'Neuerscheinungen',
	'genre_info_254_text'=>'Die neusten Spiele im Internet. Schau täglich vorbei!',
	'genre_info_255_caption'=>'Top Download',
	'genre_info_255_text'=>'Die populärsten Spiele-Downloads dieser Woche.',
	'genre_info_256_caption'=>'Neue Online-Spiele',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'Top Online-Spiele',
	'genre_info_257_text'=>'',
	/**
	 * Site_Game.class.php
	 * function sortList
	 */
	 /**
	  * select genre label
	  */
	'label_genre'=>'Genre',
	 /**
	  * select genre
	  */
	'select_genre_all'=>'Alle Spiele',
	/**
	 * select sort label
	 */
	'label_sort'=>'Sort',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Date',
	 'select_sort_rank'=>'Top Games',
	 'select_sort_name'=>'Name',
	/**
	 * select order label
	 */
	'label_order'=>'Auftrag',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Steigen',
	 'select_order_desc'=>'Absteigen',
	/**
	 * select submit
	 */
     'select_submit'=>'Abschicken',
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Aktuelle Neuerscheinung',
	'featured_download_topgame'=>'Das Top-Spiel',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Aktuelle Neuerscheinung',
	'featured_online_topgame'=>'Das Top-Spiel',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'{GENRENAME}-Spiele',
	/**
	 * Buttons
	 */
	'btn_download'=>'Runterladen',
	'btn_buy'=>'Jetzt kaufen',
	'btn_back'=>'Zurück',
	'btn_video'=>'Video ansehen',
	'btn_play'=>'Jetzt spielen',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . Alle <strong>{GENRENAME}</strong>-Spiele <span> (in alphabetischer Reihenfolge)</span>',
	/**
	 * browse.php Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Archiv-Liste der <strong>{GENRENAME}</strong>-Spiele',
	/**
	 * browse.php Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Durchstöbere das Spiele-Archiv',
	/**
	 * browse.php Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Betrachte {INFO1} - {INFO2} der Spiele {INFO3}.',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Eine Stunde lang GRATIS probespielen',
	 'gameinfo_or_text'=>'ODER',
	 'gameinfo_unlimited_text'=>'Vollversion',
	 'gameinfo_tested_text'=>'Sicherheit durch strenge Qualitätskontrolle. Garantiert virenfrei.',
	 'gameinfo_screenshots_text'=>'Screenshots',
	 'gameinfo_image_text'=>'Zum Vergrößern klicken',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'Spielvoraussetzungen:',
	 'sysreqos'=>'Betriebssystem:',
	 'sysreqmhz'=>'CPU:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=>'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'Festplattenspeicher:',
	 'sysreqother'=>'Sonstiges:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Spiele-Archiv durchsuchen',
	 'page_search_message_try'=>'Keine Übereinstimmungen gefunden, versuche es bitte nochmals.',
	 'page_search_message_results'=>'Resultate {START_NUMBER} - {END_NUMBER} von {TOTAL_NUMBER} Spielen für <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Suchen',
		/**
	   * site_comments.class.php
	   */
	   /* 'comments_no_comments'=>'Keine Kommentare bis jetzt.', */
		/**
		 * request.php
		 */
		'buy' => 'Jetzt kaufen',
		'download' => 'Runterladen',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Umbauten',
		'taginfo'=>'Was ist Tagging? / Schlagwortwolke (Soziale Software) bei <a href="http://de.wikipedia.org/wiki/Tag_cloud">Wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Schlagwortwolke',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Seite',
        'page_play_getting_your_online_game'=>'Dein Online-Spiel wird vorbereitet…'		
);
?>