<?php
/**
 * SGS NL language
 *
 * Type: language
 * Subtag: nl
 * Description: Dutch
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
	'read_more'=>'Lees verder',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Succes',
	'admin_error'=>'Fout',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Aanmelden',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Hoofd',
	 'admin_navlinks_site_settings'=>'Instellingen site',
	 'admin_navlinks_custom_pages'=>'Zelfgemaakte pagina\'s',
	 'admin_navlinks_modules'=>'Modules',
	 'admin_navlinks_php_info'=>'PHP-info',
	 'admin_navlinks_leave_admin'=>'Verlaat admin',
	 'admin_navlinks_logout'=>'Afmelden',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menu',
	 'admin_renderadmin_options'=>'Opties',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Geef alsjeblieft je gebruikersnaam en wachtwoord op',
	'auth_doLogin_error_invalid'=>'Ongeldige bevoegdheid',
	'auth_login_form_username'=>'Gebruikersnaam:',
	'auth_login_form_password'=>'Wachtwoord:',
	'auth_login_form_autologin'=>'Houd me aangemeld',
	'auth_login_form_submit'=>'Aanmelden',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Pad staat op: ',
	'time_set'=>'Tijd staat op: ',
	'file_set'=>'Bestand staat op: ',
	'target_file_req'=>'Een doelbestand is nodig om de cache op te slaan.',
	'no_source_processing'=>'Geen bron aanwezig voor verwerking.',
	'unable_to_open_for_writing'=>'Niet mogelijk om naar {FILENAME} weg te schrijven.',
	'written_to'=>'Geschreven naar ',
	'no_source_writing'=>'Er is geen bron om naartoe te schrijven.',
	'deleted'=>'Verwijderd: ',
	'permission_denied'=>'Toestemming ontzegd: ',
	'filename_does_not_exist'=>'Het bestand {FILENAME} bestaat niet.',
	'file_does_not_exist'=>' Bestand bestaat niet.',
	'file_expired'=>' Levensduur bestand verlopen: {DATE}. We hebben een nieuwe nodig.',
	'file_valid_until'=>' Bestand is geldig tot: ',
	'unable_to_extract'=>'Niet mogelijk om informatie uit bestand te halen: ',
	'unable_to_open'=>'Niet mogelijk om te openen: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Verwijderen',
	'comments_add_comment'=>'Commentaar toevoegen',
	'comments_read_more'=>'Lees verder',
	'comments_comments_txt'=>'Commentaar',
	'comments_no_comments_type'=>'Er is geen commentaar voor {TYPE}. Voeg commentaar toe.',
	'comment_deleted'=>'Commentaar verwijderd',
	'comment_delete_failed'=>'Commentaar verwijderen mislukt.',
	'comments_name_req'=>'Naam benodigd om commentaar toe te voegen.',
	'comments_name_invalid'=>'Naam bevat ongeldige tekens.',
	'comments_email_req'=>'E-mailadres benodigd om commentaar toe te voegen.',
	'comments_email_invalid'=>'Ongeldig e-mailadres.',
	'comments_url_req'=>'Url benodigd om commentaar toe te voegen.',
	'comments_url_invalid'=>'Ongeldige Url.',
	'comments_txt_req'=>'Voeg commentaar toe.',
	'comments_txt_invalid'=>'Je commentaar bevat ongeldige tekens.',
	'comment_duplicate'=>'Dubbel commentaar',
	'comment_fail_save'=>'Commentaar bewaren mislukt',
	'comment_saved'=>'Commentaar bewaard',
	'comment_name_anonymous'=>'anoniem',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'Naam:',
	'comments_form_email'=>'E-mail:',
	'comments_form_url'=>'Url:',
	'comments_form_comment'=>'Je commentaar:',
	'comments_form_submit'=>'Versturen',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Fout: ',
	'fetch_fetching'=>'Ophalen: ',
	'fetch_unable_to_open'=>'Kan afgelegen bestand niet openen. ',
	'fetch_unable_to_fetch'=>'Kan afgelegen bestand niet ophalen.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'PC-spellen ',
    'main_nav_mac_downloads'=>'MAC-spellen ',
    'main_nav_online_games'=>'Online spellen',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULL',
	'genre_info_0_text'=>'NULL',
	'genre_info_253_caption'=>'Alles',
	'genre_info_253_text'=>'Ons spelarchief, met elke dag een nieuw spel!',
	'genre_info_254_caption'=>'Nieuwe download',
	'genre_info_254_text'=>'Elke dag een nieuw spel. Kom dagelijks kijken!',
	'genre_info_255_caption'=>'Topdownload',
	'genre_info_255_text'=>'Meest populaire spellen van deze week.',
	'genre_info_256_caption'=>'Nieuwe spellen',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'Topspellen',
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
	'select_genre_all'=>'Alle spellen',
	/**
	 * select sort label
	 */
	'label_sort'=>'Sorteren',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Datum',
	 'select_sort_rank'=>'Topspellen',
	 'select_sort_name'=>'Naam',
	/**
	 * select order label
	 */
	'label_order'=>'Volgorde',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Oplopend',
	 'select_order_desc'=>'Aflopend',
	/**
	 * select submit
	 */	 
     'select_submit'=>'Versturen',	
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Nieuw vandaag',
	'featured_download_topgame'=>'Hitspel nr. 1',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Nieuw vandaag',
	'featured_online_topgame'=>'Hitspel nr. 1',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'{GENRENAME}-spellen',
	/**
	 * Buttons
	 */
	'btn_download'=>'Downloaden',
	'btn_buy'=>'Nu kopen',
	'btn_back'=>'terug',
	'btn_video'=>'Video afspelen',
	'btn_play'=>'Nu Spelen',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . Alle <strong>{GENRENAME}-</strong>spellen <span> (op alfabetische volgorde)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Archieflijst van <strong>{GENRENAME}</strong>-spellen',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Blader door het spelarchief',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Bekijken:  {INFO1} - {INFO2} van {INFO3} spellen',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Speel een uur lang GRATIS',
	 'gameinfo_or_text'=>'of',
	 'gameinfo_unlimited_text'=>'Volledige versie',
	 'gameinfo_tested_text'=>'Veilig; Veilige downloads op kwaliteit getest ; Virusvrij',
	 'gameinfo_screenshots_text'=>'Screenshots',
	 'gameinfo_image_text'=>'Klik op plaatjes om ze te vergroten',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'Systeemvereisten:',
	 'sysreqos'=>'Besturingssysteem:',
	 'sysreqmhz'=>'Processor:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'Harde schijf:',
	 'sysreqother'=>'Anders:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Doorzoek archief',
	 'page_search_message_try'=>'Resultaten gevonden, probeer alsjeblieft opnieuw.',
	 'page_search_message_results'=>'Resultaten  {START_NUMBER} - {END_NUMBER} van {TOTAL_NUMBER} spellen voor <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Zoek',
	/**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No comments yet.', */
		/**
		 * request.php
		 */
		'buy' => 'Kopen',
		'download' => 'Downloaden',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Tags',
		'taginfo'=>'Wat zijn tags? / Tag (Sociale software) op  <a href="http://en.wikipedia.org/wiki/Tag_cloud">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Tagcloud',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Paginas',
		'page_play_getting_your_online_game'=>'Je online spel aan het laden...'		
);
?>