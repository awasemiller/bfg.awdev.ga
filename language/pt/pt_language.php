<?php
/**
 * SGS PT language
 *
 * Type: language
 * Subtag: pt
 * Description: Portuguese
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
	'read_more'=>'Leia mais',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Êxito',
	'admin_error'=>'Erro',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Entrar',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Principal',
	 'admin_navlinks_site_settings'=>'Configurações do website',
	 'admin_navlinks_custom_pages'=>'Páginas personalizadas',
	 'admin_navlinks_modules'=>'Módulos',
	 'admin_navlinks_php_info'=>'Info. PHP',
	 'admin_navlinks_leave_admin'=>'Fazer logoff de admin.',
	 'admin_navlinks_logout'=>'Fazer logoff',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menu',
	 'admin_renderadmin_options'=>'Opções',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Digite o seu nome de usuário e sua senha.',
	'auth_doLogin_error_invalid'=>'Permissões inválidas',
	'auth_login_form_username'=>'Nome de usuário:',
	'auth_login_form_password'=>'Senha:',
	'auth_login_form_autologin'=>'Mantenha-me conectado',
	'auth_login_form_submit'=>'Entrar',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Caminho definido como: ',
	'time_set'=>'Tempo definido como: ',
	'file_set'=>'Arquivo definido como: ',
	'target_file_req'=>'Um arquivo de destino é necessário para que o cache seja salvo.',
	'no_source_processing'=>'Nenhuma fonte foi enviada para gravação.',
	'unable_to_open_for_writing'=>'Impossível abrir {FILENAME} para gravação.',
	'written_to'=>'Gravado em  ',
	'no_source_writing'=>'Não há fonte para gravação.',
	'deleted'=>'Excluído: ',
	'permission_denied'=>'Permissão negada: ',
	'filename_does_not_exist'=>'O arquivo {FILENAME} não existe.',
	'file_does_not_exist'=>' O arquivo não existe.',
	'file_expired'=>' Validade de arquivo expirada em: {DATE}. Um novo arquivo é necessário.',
	'file_valid_until'=>' O arquivo é válido até: ',
	'unable_to_extract'=>'Não é possível extrair informações do arquivo: ',
	'unable_to_open'=>'Não é possível abrir: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Excluir',
	'comments_add_comment'=>'Adicionar comentário',
	'comments_read_more'=>'Leia mais',
	'comments_comments_txt'=>'Comentários',
	'comments_no_comments_type'=>'Não há comentários para este {TYPE}. Adicione um comentário..',
	'comment_deleted'=>'Comentário excluído!',
	'comment_delete_failed'=>'Falha na exclusão do comentário..',
	'comments_name_req'=>'Um nome é necessário para postar comentários.',
	'comments_name_invalid'=>'O nome contém caracteres inválidos..',
	'comments_email_req'=>'Um endereço de email é necessário para postar comentários.',
	'comments_email_invalid'=>'Endereço de email inválido..',
	'comments_url_req'=>'Uma URL é necessária para postar comentários.',
	'comments_url_invalid'=>'URL inválida.',
	'comments_txt_req'=>'Adicione um comentário.',
	'comments_txt_invalid'=>'O seu comentário contém caracteres inválidos.',
	'comment_duplicate'=>'Comentário duplicado',
	'comment_fail_save'=>'Falha ao salvar comentário',
	'comment_saved'=>'Comentário salvo',
	'comment_name_anonymous'=>'anônimo',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'Nome:',
	'comments_form_email'=>'Email:',
	'comments_form_url'=>'Url:',
	'comments_form_comment'=>'Seu comentário:',
	'comments_form_submit'=>'Enviar',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Erro: ',
	'fetch_fetching'=>'Buscando: ',
	'fetch_unable_to_open'=>'Não é possível abrir o arquivo remoto. ',
	'fetch_unable_to_fetch'=>'Não é possível buscar o arquivo remoto.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'Jogos para download',
    'main_nav_mac_downloads'=>'MAC Downloads',
    'main_nav_online_games'=>'Jogos online',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULO',
	'genre_info_0_text'=>'NULO',
	'genre_info_253_caption'=>'Todos',
	'genre_info_253_text'=>'A cada dia, um novo jogo é adicionado ao nosso arquivo.',
	'genre_info_254_caption'=>'Novo download',
	'genre_info_254_text'=>'Um novo jogo todos os dias! Volte todos os dias!',
	'genre_info_255_caption'=>'Jogo mais baixado',
	'genre_info_255_text'=>'Jogos mais baixados da semana.',
	'genre_info_256_caption'=>'Novos jogos online',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'melhores jogos online',
	'genre_info_257_text'=>'',
	/**
	 * Site_Game.class.php
	 * function sortList
	 */
	 /**
	  * select genre label
	  */
	'label_genre'=>'Gênero',
	 /**
	  * select genre
	  */
	'select_genre_all'=>'Todos os jogos',
	/**
	 * select sort label
	 */
	'label_sort'=>'Classificar',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'Data',
	 'select_sort_rank'=>'Os melhores jogos',
	 'select_sort_name'=>'Nome',
	/**
	 * select order label
	 */
	'label_order'=>'Ordem',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Crescente',
	 'select_order_desc'=>'Decrescente',
	/**
	 * select submit
	 */	 
     'select_submit'=>'Enviar',	
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Lançamento de hoje',
	'featured_download_topgame'=>'Jogo nº 1',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Lançamento de hoje',
	'featured_online_topgame'=>'Jogo nº 1',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'Jogos de {GENRENAME}',
	/**
	 * Buttons
	 */
	'btn_download'=>'Baixar',
	'btn_buy'=>'Comprar',
	'btn_back'=>'Voltar',
	'btn_video'=>'Reproduzir vídeo',
	'btn_play'=>'Jogar agora',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . Todos os jogos de  <strong>{GENRENAME} </strong><span> (em ordem alfabética)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Lista de jogos de <strong>{GENRENAME}</strong> no arquivo',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Pesquisar arquivo de jogos',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Visualizando  {INFO1} - {INFO2} de {INFO3} jogos',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Jogar GRÁTIS por uma hora',
	 'gameinfo_or_text'=>'ou',
	 'gameinfo_unlimited_text'=>'Versão ilimitada completa',
	 'gameinfo_tested_text'=>'Downloads seguros, de alta qualidade e sem vírus',
	 'gameinfo_screenshots_text'=>'Capturas de tela',
	 'gameinfo_image_text'=>'Clique nas imagens para ampliar',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'Requisitos de sistema:',
	 'sysreqos'=>'SO:',
	 'sysreqmhz'=>'CPU:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'HD:',
	 'sysreqother'=>'Outros:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Pesquisar arquivo',
	 'page_search_message_try'=>'Não encontramos nada que corresponda a sua pesquisa, tente novamente.',
	 'page_search_message_results'=>'Resultados {START_NUMBER} - {END_NUMBER} de {TOTAL_NUMBER} jogos para <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Procurar',
	  /**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No comments yet.', */
		/**
		 * request.php
		 */
		'buy' => 'Comprar',
		'download' => 'Baixar',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Tags',
		'taginfo'=>'O que inserir tags significa? / Tag (Software Social) na página da <a href="http://en.wikipedia.org/wiki/Tag_cloud">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Tagcloud',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Página',
		'page_play_getting_your_online_game'=>'Carregando o seu jogo online...'	
		
);
?>