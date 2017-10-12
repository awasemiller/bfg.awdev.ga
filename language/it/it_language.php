<?php
/**
 * SGS IT language
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
	'read_more'=>'Vedi dettagli',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Fatto!',
	'admin_error'=>'Errore',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Accedi',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Principale',
	 'admin_navlinks_site_settings'=>'Impostazioni del sito',
	 'admin_navlinks_custom_pages'=>'Pagine personalizzate',
	 'admin_navlinks_modules'=>'Moduli',
	 'admin_navlinks_php_info'=>'Informazioni PHP',
	 'admin_navlinks_leave_admin'=>'Esci dall\'area admin',
	 'admin_navlinks_logout'=>'Esci',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menu',
	 'admin_renderadmin_options'=>'Opzioni',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Inserisci il tuo nome utente e la password',
	'auth_doLogin_error_invalid'=>'Accesso negato',
	'auth_login_form_username'=>'Nome utente:',
	'auth_login_form_password'=>'Password:',
	'auth_login_form_autologin'=>'Mantieni l\'accesso',
	'auth_login_form_submit'=>'Accedi',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Indirizzo impostato: ',
	'time_set'=>'Ora impostata: ',
	'file_set'=>'File impostato: ',
	'target_file_req'=>'È necessario un file di destinazione per salvare la cache.',
	'no_source_processing'=>'Nessuna sorgente è stata inviata per l\'elaborazione',
	'unable_to_open_for_writing'=>'Impossibile aprire {FILENAME} per la scrittura.',
	'written_to'=>'Scritto su  ',
	'no_source_writing'=>'Non esiste una sorgente su cui scrivere.',
	'deleted'=>'Eliminato: ',
	'permission_denied'=>'Permesso negato: ',
	'filename_does_not_exist'=>'Il file {FILENAME} non esiste.',
	'file_does_not_exist'=>' Il file non esiste.',
	'file_expired'=>' Il file è scaduto il: {DATE}. Ne serve uno nuovo.',
	'file_valid_until'=>' Il file è valido sino a: ',
	'unable_to_extract'=>'Impossibile estrarre l\'informazione su file: ',
	'unable_to_open'=>'Impossibile aprire: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Elimina',
	'comments_add_comment'=>'Aggiungi commento',
	'comments_read_more'=>'Vedi dettagli',
	'comments_comments_txt'=>'Commenti',
	'comments_no_comments_type'=>'Non ci sono commenti su {TYPE}. Aggiungi un commento..',
	'comment_deleted'=>'Commento eliminato',
	'comment_delete_failed'=>'Eliminazione commento fallita.',
	'comments_name_req'=>'Per pubblicare un commento serve un nome.',
	'comments_name_invalid'=>'Il nome contiene dei caratteri non validi.',
	'comments_email_req'=>'Per pubblicare un commento serve un indirizzo e-mail.',
	'comments_email_invalid'=>'L\'indirizzo e-mail non è valido.',
	'comments_url_req'=>'Per pubblicare un commento serve un URL.',
	'comments_url_invalid'=>'L\'URL non è valido.',
	'comments_txt_req'=>'Inserisci un commento.',
	'comments_txt_invalid'=>'Il commento contiene dei caratteri non validi.',
	'comment_duplicate'=>'Duplica post',
	'comment_fail_save'=>'Salvataggio del commento fallito',
	'comment_saved'=>'Commento salvato',
	'comment_name_anonymous'=>'anonimo',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'Nome:',
	'comments_form_email'=>'Email:',
	'comments_form_url'=>'URL:',
	'comments_form_comment'=>'Il tuo commento:',
	'comments_form_submit'=>'Invia',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Errore: ',
	'fetch_fetching'=>'Recupero in corso: ',
	'fetch_unable_to_open'=>'Impossibile aprire il file remoto. ',
	'fetch_unable_to_fetch'=>'Impossibile recuperare il file remoto.',
   /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'Giochi per PC ',
    'main_nav_mac_downloads'=>'Giochi per MAC',
    'main_nav_online_games'=>'Giochi online',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULL',
	'genre_info_0_text'=>'NULL',
	'genre_info_253_caption'=>'Tutti',
	'genre_info_253_text'=>'Il nostro archivio dei giochi vanta Un gioco nuovo al giorno!',
	'genre_info_254_caption'=>'Nuovo download',
	'genre_info_254_text'=>'Ogni giorno un gioco nuovo. Dai un\'occhiata ogni giorno!',
	'genre_info_255_caption'=>'I migliori download',
	'genre_info_255_text'=>'I giochi scaricati più popolari della settimana.',
	'genre_info_256_caption'=>'Nuovi giochi online',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'Top Giochi Online',
	'genre_info_257_text'=>'',
	/**
	 * Site_Game.class.php
	 * function sortList
	 */
	 /**
	  * select genre label
	  */
	'label_genre'=>'Genere',
	 /**
	  * select genre
	  */
	'select_genre_all'=>'Tutti i giochi',
	/**
	 * select sort label
	 */
	'label_sort'=>'Ordina',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Data',
	 'select_sort_rank'=>'I più popolari',
	 'select_sort_name'=>'Nome',
	/**
	 * select order label
	 */
	'label_order'=>'Ordine',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Crescente',
	 'select_order_desc'=>'Decrescente',
	/**
	 * select submit
	 */	 
     'select_submit'=>'Invia',	
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'La novità del giorno',
	'featured_download_topgame'=>'Il gioco n°1',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'La novità del giorno',
	'featured_online_topgame'=>'Il gioco n°1',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'Giochi {GENRENAME}',
	/**
	 * Buttons
	 */
	'btn_download'=>'Prova',
	'btn_buy'=>'Acquista',
	'btn_back'=>'Indietro',
	'btn_video'=>'Guarda il video',
	'btn_play'=>'Gioca ora',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . Tutti i giochi <strong>{GENRENAME} </strong> <span> (in ordine alfabetico)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Archivio dei giochi <strong>{GENRENAME} </strong> ',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Sfoglia l\'archivio dei giochi',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Visualizzazione  {INFO1} - {INFO2} di giochi {INFO3}',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Gioca GRATIS per un\'ora',
	 'gameinfo_or_text'=>'oppure',
	 'gameinfo_unlimited_text'=>'Versione completa illimitata',
	 'gameinfo_tested_text'=>'Download sicuri, qualità controllata e nessun virus',
	 'gameinfo_screenshots_text'=>'Immagini',
	 'gameinfo_image_text'=>'Fai clic sulle immagini per ingrandirle',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'Requisiti di sistema:',
	 'sysreqos'=>'Sistema operativo:',
	 'sysreqmhz'=>'CPU:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'HD:',
	 'sysreqother'=>'Altro:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Cerca nell\'archivio',
	 'page_search_message_try'=>'Risultati trovati, riprova',
	 'page_search_message_results'=>'Risultati  {START_NUMBER} - {END_NUMBER} di {TOTAL_NUMBER} giochi trovati per <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Cerca',
	 /**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No comments yet.', */
		/**
		 * request.php
		 */
		'buy' => 'Acquista',
		'download' => 'Scarica',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Tags',
		'taginfo'=>'Che cosa sono i tag? / Tag (Social Software) su<a href="http://en.wikipedia.org/wiki/Tag_cloud">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Tag cloud',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Pagina',
		'page_play_getting_your_online_game'=>'Accesso al gioco online in corso...'	
		
);
?>