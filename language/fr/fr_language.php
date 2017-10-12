<?php
/**
 * PNP TOOLS FR language
 *
 * Type: language
 * Subtag: fr
 * Description: French
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
	'read_more'=>'Lire la suite',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Réussi',
	'admin_error'=>'Erreur',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Se connecter',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Accueil',
	 'admin_navlinks_site_settings'=>'Paramètres du site',
	 'admin_navlinks_custom_pages'=>'Pages personnalisées',
	 'admin_navlinks_modules'=>'Modules',
	 'admin_navlinks_php_info'=>'Infos PHP',
	 'admin_navlinks_leave_admin'=>'Quitter mode Admin',
	 'admin_navlinks_logout'=>'Se déconnecter',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menu',
	 'admin_renderadmin_options'=>'Options',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Veuillez entrer votre nom d\'utilisateur et mot de passe',
	'auth_doLogin_error_invalid'=>'Permission refusée',
	'auth_login_form_username'=>'Nom d\'utilsateur :',
	'auth_login_form_password'=>'Mot de passe :',
	'auth_login_form_autologin'=>'Rester connecté',
	'auth_login_form_submit'=>'Se connecter',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Chemin : ',
	'time_set'=>'Heure : ',
	'file_set'=>'Fichier : ',
	'target_file_req'=>'Un fichier cible est requis pour sauvegarder le cache.',
	'no_source_processing'=>'Aucune source n\'a été spécifiée pour le traitement.',
	'unable_to_open_for_writing'=>'Impossible d\'ouvrir {FILENAME} en écriture.',
	'written_to'=>'Ecrit dans ',
	'no_source_writing'=>'Aucune source à écrire.',
	'deleted'=>'Supprimé : ',
	'permission_denied'=>'Permission refusée : ',
	'filename_does_not_exist'=>'Le fichier {FILENAME} n\'existe pas.',
	'file_does_not_exist'=>' Le fichier n\'existe pas.',
	'file_expired'=>' Le fichier a expiré : {DATE}. Il en faut un nouveau.',
	'file_valid_until'=>' Le fichier est valide jusqu\'à : ',
	'unable_to_extract'=>'Impossible d\'extraire les informations du fichier : ',
	'unable_to_open'=>'Impossible d\'ouvrir : ',
	/**
	 * site_comments.class.php
	 */
     'comments_delete'=>'Effacer',
     'comments_add_comment'=>'Ajoutez un commentaire',
     'comments_read_more'=>'Lire la suite',
     'comments_comments_txt'=>'Commentaires',
     'comments_no_comments_type'=>'Il n\'y a aucun commentaire pour ce {TYPE}. Ajoutez un commentaire.',
     'comment_deleted'=>'Le commentaire a été supprimé.',
     'comment_delete_failed'=>'Le commentaire n’a pas pu être supprimé.',
     'comments_name_req'=>'Le champ Nom est requis pour pouvoir poster des commentaires.',
     'comments_name_invalid'=>'Le nom contient des caractères interdits.',
     'comments_email_req'=>'Le champ Adresse e-mail est requis pour pouvoir poster des commentaires.',
     'comments_email_invalid'=>'Adresse e-mail invalide.',
     'comments_url_req'=>'Le champ URL est requis pour pouvoir poster des commentaires.',
     'comments_url_invalid'=>'URL invalide.',
     'comments_txt_req'=>'Veuillez entrer votre commentaire.',
     'comments_txt_invalid'=>'Votre commentaire contient des caractères interdits.',
     'comment_duplicate'=>'Ce commentaire a déjà été posté.',
     'comment_fail_save'=>'Votre commentaire n’a pas pu être enregistré.',
     'comment_saved'=>'Votre commentaire a été enregistré.',
	 'comment_name_anonymous'=>'anonyme',
     /**
      * site_comments.class.php
      * comment form
      */
      'comments_form_name'=>'Nom :',
      'comments_form_email'=>'E-mail :',
      'comments_form_url'=>'Url :',
      'comments_form_comment'=>'Votre commentaire :',
      'comments_form_submit'=>'Envoyer',

	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Erreur : ',
	'fetch_fetching'=>'Fetching : ',
	'fetch_unable_to_open'=>'Impossible d\'ouvrir le fichier distant. ',
	'fetch_unable_to_fetch'=>'Impossible d\'interpréter le fichier distant.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'Jeux téléchargeables',
    'main_nav_mac_downloads'=>'MAC Downloads',
    'main_nav_online_games'=>'Jeux en ligne',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NUL',
	'genre_info_0_text'=>'NUL',
	'genre_info_253_caption'=>'Tout',
	'genre_info_253_text'=>'Notre catalogue de jeux',
	'genre_info_254_caption'=>'Nouveau téléchargement',
	'genre_info_254_text'=>'Plein de nouveautés chaque semaine. Revenez souvent sur notre site !',
	'genre_info_255_caption'=>'Top téléchargement',
	'genre_info_255_text'=>'Les jeux les plus téléchargés de la semaine.',
	'genre_info_256_caption'=>'Nouveaux jeux en ligne',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'top des jeux en ligne',
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
	'select_genre_all'=>'Tous les jeux',
	/**
	 * select sort label
	 */
	'label_sort'=>'Trier',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Date',
	 'select_sort_rank'=>'Top jeux',
	 'select_sort_name'=>'Nom',
	/**
	 * select order label
	 */
	'label_order'=>'Ordre',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Croissant',
	 'select_order_desc'=>'Décroissant',
	/**
	 * select submit
	 */
     'select_submit'=>'Envoyer',
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Nouveauté du jour',
	'featured_download_topgame'=>'Jeu No 1',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Nouveauté du jour',
	'featured_online_topgame'=>'Jeu No 1',	
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'Jeux {GENRENAME}',
	/**
	 * Buttons
	 */
	'btn_download'=>'Télécharger',
	'btn_buy'=>'Acheter maintenant',
	'btn_back'=>'Retour',
	'btn_video'=>'Regarder la vidéo',
	'btn_play'=>'Jouer maintenant',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . Tous les <strong>{GENRENAME} </strong><span> (dans l\'ordre alphabétique)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Liste archivée des jeux <strong>{GENRENAME} </strong>',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Parcourir l\'archive des jeux',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Jeux {INFO1} - {INFO2} sur {INFO3}.',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Jouez 1 heure gratuitement',
	 'gameinfo_or_text'=>'OU',
	 'gameinfo_unlimited_text'=>'Version illimitée' ,
	 'gameinfo_tested_text'=>'Téléchargements sûrs et sécurisés, qualitée testée et jeu garanti sans virus.',
	 'gameinfo_screenshots_text'=>'Captures d\'écran',
	 'gameinfo_image_text'=>'Cliquez sur les images pour les agrandir.',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'Configuration requise :',
	 'sysreqos'=>'Système :',
	 'sysreqmhz'=>'CPU :',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM :',
	 'sysreq3d'=>'3D :',
	 'sysreqdx'=>'DirectX :',
	 'sysreqhd'=>'DD :',
	 'sysreqother'=>'Autres :',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Rechercher',
	 'page_search_message_try'=>'Aucun résultat, veuillez réessayer.',
	 'page_search_message_results'=>'Résultats {START_NUMBER} - {END_NUMBER} sur {TOTAL_NUMBER} jeux trouvés avec <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Parcourir',
	  /**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No comments yet.', */
		/**
		 * request.php
		 */
		'buy' => 'Acheter',
		'download' => 'Télécharger',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Tags',
		'taginfo'=>'Qu\'est-ce que le tagging ? Lisez cet article sur les nuages de mots clés sur <a href="http://fr.wikipedia.org/wiki/Nuage_de_mots_clefs">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Nuage de mots clés',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Page',
		'page_play_getting_your_online_game'=>'Votre jeu en ligne sera prêt dans quelques secondes...'	
);
?>