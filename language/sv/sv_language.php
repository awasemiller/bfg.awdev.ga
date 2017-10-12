<?php
/**
 * SGS SV language
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
	'read_more'=>'Se mer',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Det lyckades',
	'admin_error'=>'Fel',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Logga in',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Huvudsakliga',
	 'admin_navlinks_site_settings'=>'Hemsideinställningar',
	 'admin_navlinks_custom_pages'=>'Användarsidor',
	 'admin_navlinks_modules'=>'Moduler',
	 'admin_navlinks_php_info'=>'PHP-information',
	 'admin_navlinks_leave_admin'=>'Avbryt redigering',
	 'admin_navlinks_logout'=>'Logga ut',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Meny',
	 'admin_renderadmin_options'=>'Alternativ',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Vänligen skriv in ditt användarnamn och lösenord',
	'auth_doLogin_error_invalid'=>'Ogiltig tillåtelse',
	'auth_login_form_username'=>'Användarnamn:',
	'auth_login_form_password'=>'Lösenord:',
	'auth_login_form_autologin'=>'Håll mig inloggad',
	'auth_login_form_submit'=>'Logga in',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Sökväg inställd på: ',
	'time_set'=>'TTid inställd på: ',
	'file_set'=>'Fil inställd på: ',
	'target_file_req'=>'Det är nödvändigt att välja en mapp för uppsamling av cache.',
	'no_source_processing'=>'Ingen källkod blev godkänd för behandling.',
	'unable_to_open_for_writing'=>'{FILENAME} kunde inte öppnas för editering.',
	'written_to'=>'Skriven till ',
	'no_source_writing'=>'Det finns ingen källkod att logga.',
	'deleted'=>'Raderad: ',
	'permission_denied'=>'Åtkomst nekad: ',
	'filename_does_not_exist'=>'Filen {FILENAME} finns inte.',
	'file_does_not_exist'=>' Filen finns inte.',
	'file_expired'=>' Filen har utgått den {DATE}.',
	'file_valid_until'=>' Filen år giltig till den: ',
	'unable_to_extract'=>'Det går inte att extrahera filens information: ',
	'unable_to_open'=>'Den går inte att öppna: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Radera',
	'comments_add_comment'=>'Lägg till kommentar',
	'comments_read_more'=>'Mer information',
	'comments_comments_txt'=>'Kommentarer',
	'comments_no_comments_type'=>'Det finns inga kommentarer för {TYPE} ännu. Lägg till kommentar.',
	'comment_deleted'=>'Kommentaren är raderad',
	'comment_delete_failed'=>'Radering av kommentaren misslyckades',
	'comments_name_req'=>'Du måste skriva in ett namn för att lämna kommentarer.',
	'comments_name_invalid'=>'Namnet innehåller ej tillåtna tecken.',
	'comments_email_req'=>'Du måste skriva in en e-postadress för att lämna kommentarer.',
	'comments_email_invalid'=>'Ogiltig e-postadress',
	'comments_url_req'=>'URL är nödvändig för att lämna kommentarer.',
	'comments_url_invalid'=>'Ogiltig URL',
	'comments_txt_req'=>'Vänligen lämna en kommentar.',
	'comments_txt_invalid'=>'Din kommentar innehåller ogiltiga tecken',
	'comment_duplicate'=>'Dubblera en post',
	'comment_fail_save'=>'Det lyckades inte att spara kommentaren',
	'comment_saved'=>'Kommentaren är sparad',
	'comment_name_anonymous'=>'anonym',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'Namn:',
	'comments_form_email'=>'E-postadress:',
	'comments_form_url'=>'Url:',
	'comments_form_comment'=>'Din kommentar:',
	'comments_form_submit'=>'Skicka',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Error: ',
	'fetch_fetching'=>'Hämtar: ',
	'fetch_unable_to_open'=>'Ej möjligt att öppna fjärrstyrd fil. ',
	'fetch_unable_to_fetch'=>'Ej möjligt att hämta fjärrstyrd fil.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'Nedladdningsbara PC-spel ',
    'main_nav_mac_downloads'=>'Nedladdningsbara MAC-spel ',
    'main_nav_online_games'=>'Onlinespel',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULL',
	'genre_info_0_text'=>'NULL',
	'genre_info_253_caption'=>'Alla',
	'genre_info_253_text'=>'Vårt spelarkiv. Fler spel läggs till varje vecka!',
	'genre_info_254_caption'=>'Nytt att ladda ner',
	'genre_info_254_text'=>'Ett nytt spel varje dag! Kom tillbaka ofta!',
	'genre_info_255_caption'=>'Mest nedladdade',
	'genre_info_255_text'=>'Denna veckas mest populära nedladdningar av spel.',
	'genre_info_256_caption'=>'Nya onlinespel',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'Top onlinespel',
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
	'select_genre_all'=>'Alla spel',
	/**
	 * select sort label
	 */
	'label_sort'=>'Sortera',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Datum',
	 'select_sort_rank'=>'Toppspel',
	 'select_sort_name'=>'Namn',
	/**
	 * select order label
	 */
	'label_order'=>'Ordning',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Stigande',
	 'select_order_desc'=>'Fallande',
	/**
	 * select submit
	 */	 
     'select_submit'=>'Skicka',	
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Dagens spelnyhet',
	'featured_download_topgame'=>'Etta på topplistan-spel',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Dagens spelnyhet',
	'featured_online_topgame'=>'Etta på topplistan-spel',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'{GENRENAME}',
	/**
	 * Buttons
	 */
	'btn_download'=>'Ladda ner',
	'btn_buy'=>'Köp nu',
	'btn_back'=>'Tillbaka',
	'btn_video'=>'Spela video',
	'btn_play'=>'Spela nu',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . Alla <strong>{GENRENAME} </strong><span> (i alfabetisk ordning)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Bläddra I spelarkivet för <strong>{GENRENAME} </strong>',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Bläddra i spelarkivet',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Visar {INFO1} - {INFO2} av {INFO3} spel',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Spela GRATIS i en timme',
	 'gameinfo_or_text'=>'eller',
	 'gameinfo_unlimited_text'=>'Obegränsad fullversion',
	 'gameinfo_tested_text'=>'Säkert; beskyddade kvalitetstestade nedladdningar;virusfritt',
	 'gameinfo_screenshots_text'=>'Skärmbilder',
	 'gameinfo_image_text'=>'Klicka på bilden för att förstora',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'Systemkrav:',
	 'sysreqos'=>'OS:',
	 'sysreqmhz'=>'CPU:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'HD:',
	 'sysreqother'=>'Annan:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Sökväg inställd på',
	 'page_search_message_try'=>'Träffar hittade, försök igen',
	 'page_search_message_results'=>'Resultat {START_NUMBER} - {END_NUMBER} av totalt {TOTAL_NUMBER} spel på sökningen <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Sök',
		/**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No comments yet.', */
		/**
		 * request.php
		 */
		'buy' => 'Köp',
		'download' => 'Ladda ner',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Taggar',
		'taginfo'=>'Vad är taggning? Tagga (social software) på  <a href="http://en.wikipedia.org/wiki/Tag_cloud">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Taggmoln',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Sida',
		'page_play_getting_your_online_game'=>'Ditt onlinespel laddas...'		
);
?>