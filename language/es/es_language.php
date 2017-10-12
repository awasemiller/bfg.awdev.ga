<?php
/**
 * PNP TOOLS ES language
 *
 * Type: language
 * Subtag: es
 * Description: Spanish
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
	'read_more'=>'Saber más',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Hecho',
	'admin_error'=>'Error',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Iniciar Sesión',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Principal',
	 'admin_navlinks_site_settings'=>'COnfiguración del sitio',
	 'admin_navlinks_custom_pages'=>'Páginas personalizadas',
	 'admin_navlinks_modules'=>'Módulos',
	 'admin_navlinks_php_info'=>'Información PHP',
	 'admin_navlinks_leave_admin'=>'Dejar Administrador',
	 'admin_navlinks_logout'=>'Cerrar Sesión',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menú',
	 'admin_renderadmin_options'=>'Opciones',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Por favor, introduce tu nombre de usuario y contraseña.',
	'auth_doLogin_error_invalid'=>'Permisos no válidos.',
	'auth_login_form_username'=>'Nombre de Usuario:',
	'auth_login_form_password'=>'Contraseña:',
	'auth_login_form_autologin'=>'Manterme registrado en mi cuenta',
	'auth_login_form_submit'=>'Iniciar Sesión',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Ruta fijada a: ',
	'time_set'=>'Hora fijada a: ',
	'file_set'=>'Archivo fijado a: ',
	'target_file_req'=>'Es necesario especificar un archivo para salvar la caché.',
	'no_source_processing'=>'No se procesó ningún recurso.',
	'unable_to_open_for_writing'=>'No es posible abrir el archivo {FILENAME} para editar.',
	'written_to'=>'Escribir a',
	'no_source_writing'=>'No hay recursos para editar.',
	'deleted'=>'Eliminado: ',
	'permission_denied'=>'Acceso denegado: ',
	'filename_does_not_exist'=>'El archivo {FILENAME} no existe.',
	'file_does_not_exist'=>' El archivo no existe.',
	'file_expired'=>' El archivo expiró el: {DATE}. Es necesario un nuevo archivo.',
	'file_valid_until'=>' Archivo válido hasta el: ',
	'unable_to_extract'=>'No es posible extraer información del archivo: ',
	'unable_to_open'=>'No es posible abrir: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Eliminar',
	'comments_add_comment'=>'Escribir un comentario',
	'comments_read_more'=>'Saber más',
	'comments_comments_txt'=>'Comentarios',
	'comments_no_comments_type'=>'No hay comentarios añadidos para este archivo {TYPE}. Escribir un comentario.',
	'comment_deleted'=>'¡Comentario eliminado!',
	'comment_delete_failed'=>'No ha podido eliminarse el comentario.',
	'comments_name_req'=>'Se requiere un nombre para escribir un comentario.',
	'comments_name_invalid'=>'El nombre contiene caracteres no válidos.',
	'comments_email_req'=>'Se requiere un correo electrónico para escribir un comentario.',
	'comments_email_invalid'=>'Correo electrónico no válido.',
	'comments_url_req'=>'Se require una Url para escribir un comentario.',
	'comments_url_invalid'=>'Url no válida.',
	'comments_txt_req'=>'Por favor, escribe un comentario.',
	'comments_txt_invalid'=>'Tu comentario contiene caracteres no válidos.',
	'comment_duplicate'=>'Comentario duplicado.',
	'comment_fail_save'=>'No se pudo guardar el comentario.',
	'comment_saved'=>'Comentario guardado.',
	'comment_name_anonymous'=>'anónimo',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'Nombre:',
	'comments_form_email'=>'Correo electrónico:',
	'comments_form_url'=>'Url:',
	'comments_form_comment'=>'Tu comentario:',
	'comments_form_submit'=>'Enviar',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Error: ',
	'fetch_fetching'=>'Buscando: ',
	'fetch_unable_to_open'=>'No es posible abrir el archivo remoto. ',
	'fetch_unable_to_fetch'=>'No es posible buscar el archivo remoto.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'Juegos de Descarga ',
    'main_nav_mac_downloads'=>'MAC Download games',
    'main_nav_online_games'=>'Juegos en Línea',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULO',
	'genre_info_0_text'=>'NULO',
	'genre_info_253_caption'=>'Todos',
	'genre_info_253_text'=>'¡Nuestro catálogo de juegos se actualiza constantemente!',
	'genre_info_254_caption'=>'Nuevos Estrenos',
	'genre_info_254_text'=>'Los mejores estrenos del momento.',
	'genre_info_255_caption'=>'Top Descargas',
	'genre_info_255_text'=>'Los más popular juegos de descarga.',
	'genre_info_256_caption'=>'Nuevos Juegos',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'Superior a juegos en línea',
	'genre_info_257_text'=>'',
	/**
	 * Site_Game.class.php
	 * function sortList
	 */
	 /**
	  * select genre label
	  */
	'label_genre'=>'Género',
	 /**
	  * select genre
	  */
	'select_genre_all'=>'Todos los juegos',
	/**
	 * select sort label
	 */
	'label_sort'=>'Mostrar',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Fecha',
	 'select_sort_rank'=>'Top Juegos',
	 'select_sort_name'=>'Nombre',
	/**
	 * select order label
	 */
	'label_order'=>'Orden',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Ascendente',
	 'select_order_desc'=>'Descendente',
	/**
	 * select submit
	 */
     'select_submit'=>'Aceptar',
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Nuevo Estreno',
	'featured_download_topgame'=>'Juego Nº1',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Nuevo Estreno',
	'featured_online_topgame'=>'Juego Nº1',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'{GENRENAME}',
	/**
	 * Buttons
	 */
	'btn_download'=>'Descargar',
	'btn_buy'=>'Comprar ahora',
	'btn_back'=>'Volver',
	'btn_video'=>'Ver Video',
	'btn_play'=>'Jugar Ahora',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'Todos los juegos de <strong>{GENRENAME}</strong> <span>(en orden alfabético)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Lista de juegos de <strong>{GENRENAME}</strong>',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Buscar juegos',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Ver {INFO1} - {INFO2} de {INFO3} juegos.',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Juega GRATIS durante una hora',
	 'gameinfo_or_text'=>'ó',
	 'gameinfo_unlimited_text'=>'Versión Completa Ilimitada',
	 'gameinfo_tested_text'=>'Calidad comprobada y sin virus',
	 'gameinfo_screenshots_text'=>'Capturas de pantalla',
	 'gameinfo_image_text'=>'Haz clic en las imágenes para ampliarlas',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'Requisitos del Sistema:',
	 'sysreqos'=>'Sistema operativo:',
	 'sysreqmhz'=>'CPU:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'Disco duro:',
	 'sysreqother'=>'Otros:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Buscar archivo',
	 'page_search_message_try'=>'No se obtuvieron resultados, por favor, inténtalo de nuevo.',
	 'page_search_message_results'=>'Resultados {START_NUMBER} - {END_NUMBER} de {TOTAL_NUMBER} juegos para <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Buscar',
	/**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No hay comentarios todavía.', */
		/**
		 * request.php
		 */
		'buy' => 'Comprar',
		'download' => 'Descargar',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Etiquetar',
		'taginfo'=>'¿Qué es etiquetar? / Etiqueta (Social Software) en <a href="http://es.wikipedia.org/wiki/Nube_de_etiquetas">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Nube de etiquetas',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Página',

        'page_play_getting_your_online_game'=>'Tu juego en línea estará listo en unos segundos...'
);
?>