<?php
/**
 * SGS DA language
 *
 * Type: language
 * Subtag: da
 * Description: Danish
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
	'read_more'=>'Læs mere',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Det lykkedes',
	'admin_error'=>'Fejl',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Log ind',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Hovedside',
	 'admin_navlinks_site_settings'=>'Sideindstillinger',
	 'admin_navlinks_custom_pages'=>'Brugerdefinerede sider',
	 'admin_navlinks_modules'=>'Moduler',
	 'admin_navlinks_php_info'=>'PHP-information',
	 'admin_navlinks_leave_admin'=>'Forlad administration',
	 'admin_navlinks_logout'=>'Log ud',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menu',
	 'admin_renderadmin_options'=>'Indstillinger',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Indtast dit bruger navn og adgangskode',
	'auth_doLogin_error_invalid'=>'Ugyldige tilladelser',
	'auth_login_form_username'=>'Brugernavn:',
	'auth_login_form_password'=>'Adgangskode:',
	'auth_login_form_autologin'=>'Forbliv logget ind',
	'auth_login_form_submit'=>'Log ind',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Stig indstillet til: ',
	'time_set'=>'Tid indstillet til: ',
	'file_set'=>'Fil indstillet til: ',
	'target_file_req'=>'En destinationsfil skal bruges til at gemme cache.',
	'no_source_processing'=>'Ingen kilde blev godkendt til behandling.',
	'unable_to_open_for_writing'=>'Kunne ikke  åbne eller skrive til {FILENAME}.',
	'written_to'=>'Skrive til ',
	'no_source_writing'=>'Der er ingen kilde at skrive.',
	'deleted'=>'Slet: ',
	'permission_denied'=>'Tilladelse nægtet: ',
	'filename_does_not_exist'=>'Filen {FILENAME} findes ikke.',
	'file_does_not_exist'=>' Filen findes ikke.',
	'file_expired'=>' Filen udløb {DATE}. Vi behøver en ny fil.',
	'file_valid_until'=>' Filen er gyldig til: ',
	'unable_to_extract'=>'Kunne ikke trække oplysninger på filen: ',
	'unable_to_open'=>'Kunne ikke åbne: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Slet',
	'comments_add_comment'=>'Tilføj en kommentar',
	'comments_read_more'=>'Læs mere',
	'comments_comments_txt'=>'Kommentarer',
	'comments_no_comments_type'=>'Der findes igen kommentarer til denne {TYPE}. Tilføj en kommentar.',
	'comment_deleted'=>'Kommentaren er slettet!',
	'comment_delete_failed'=>'Kunne ikke slette kommentaren.',
	'comments_name_req'=>'Et navn er påkrævet for at tilføje kommentarer.',
	'comments_name_invalid'=>'Navnet indeholder ugyldige tegn.',
	'comments_email_req'=>'En e-mail-adresse er påkrævet for at tilføje kommentarer.',
	'comments_email_invalid'=>'Ugyldig e-mail-adresse.',
	'comments_url_req'=>'en URL er påkrævet for at tilføje kommentarer.',
	'comments_url_invalid'=>'Ugyldig URL.',
	'comments_txt_req'=>'Indtast en kommentar.',
	'comments_txt_invalid'=>'Din kommentar indeholder ugyldige tegn',
	'comment_duplicate'=>'gentagelse',
	'comment_fail_save'=>'Kunne ikke gemme kommentaren',
	'comment_saved'=>'Kommentaren er gemt',
	'comment_name_anonymous'=>'anonym',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'Navn:',
	'comments_form_email'=>'e-mail-adresse:',
	'comments_form_url'=>'Url:',
	'comments_form_comment'=>'Din kommentar:',
	'comments_form_submit'=>'Indsend',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Fejl: ',
	'fetch_fetching'=>'Henter: ',
	'fetch_unable_to_open'=>'Kunne ikke åbne ekstern fil. ',
	'fetch_unable_to_fetch'=>'Kunne ikke hente ekstern fil.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'PC Hent spil',
    'main_nav_mac_downloads'=>'MAC Hent spil',
    'main_nav_online_games'=>'Onlinespil',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULL',
	'genre_info_0_text'=>'NULL',
	'genre_info_253_caption'=>'Alle',
	'genre_info_253_text'=>'Vores spilarkiv. Flere spil tilføjes hver uge!',
	'genre_info_254_caption'=>'Ny download',
	'genre_info_254_text'=>'Et nyt spil hver dag! Kom snart igen.',
	'genre_info_255_caption'=>'Mest hentet',
	'genre_info_255_text'=>'Ugens mest populære spildownloads.',
	'genre_info_256_caption'=>'Ny Onlinespil',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'Top Onlinespil',
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
	'select_genre_all'=>'Alle spil',
	/**
	 * select sort label
	 */
	'label_sort'=>'Sorter',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Dato',
	 'select_sort_rank'=>'Topspil',
	 'select_sort_name'=>'Navn',
	/**
	 * select order label
	 */
	'label_order'=>'Rækkefølge',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Stigende',
	 'select_order_desc'=>'Faldende',
	/**
	 * select submit
	 */	 
	 'select_submit'=>'Indsend',	
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Dagens ny udgivelse',
	'featured_download_topgame'=>'Topspillet',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Dagens ny udgivelse',
	'featured_online_topgame'=>'Topspillet',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'{GENRENAME}',
	/**
	 * Buttons
	 */
	'btn_download'=>'prøv',
	'btn_buy'=>'Køb nu',
	'btn_back'=>'Tilbage',
	'btn_video'=>'Se video',
	'btn_play'=>'Spil nu',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . Alle <strong>{GENRENAME} </strong> Games <span> (i alfabetisk rækkefølge)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Spilarkivet for <strong>{GENRENAME} </strong>',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Gennemse spilarkivet',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Vis {INFO1} - {INFO2} ud af {INFO3} spil.',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Spil GRATIS i en time',
	 'gameinfo_or_text'=>'eller',
	 'gameinfo_unlimited_text'=>'Ubegrænset fuldversion',
	 'gameinfo_tested_text'=>'Sikkert; Sikre downloads kvalitetstestet; uden virus',
	 'gameinfo_screenshots_text'=>'Skærmbillede',
	 'gameinfo_image_text'=>'Klik på billedet for at forstørre',
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
	 'sysreqother'=>'Andet:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Søg i arkiv',
	 'page_search_message_try'=>'Fundne forekomster, prøv igen.',
	 'page_search_message_results'=>'Resultat {START_NUMBER} - {END_NUMBER} ud af {TOTAL_NUMBER} spil til søgningen <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Søg',
	  /**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No comments yet.', */
		/**
		 * request.php
		 */
		'buy' => 'Køb',
		'download' => 'Hent',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Tags',
		'taginfo'=>'Hvad er tagging? Tag (social software) på <a href="http://en.wikipedia.org/wiki/Tag_cloud">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Tagsky',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Side',
        'page_play_getting_your_online_game'=>'Henter dit onlinespil...'

		
);
?>