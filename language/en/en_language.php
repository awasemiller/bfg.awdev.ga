<?php
/**
 * PNP TOOLS EN language
 *
 * Type: language
 * Subtag: en
 * Description: English
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
	'read_more'=>'Read More',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'Success',
	'admin_error'=>'Error',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'Sign In',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'Main',
	 'admin_navlinks_site_settings'=>'Site Settings',
	 'admin_navlinks_custom_pages'=>'Custom Pages',
	 'admin_navlinks_modules'=>'Modules',
	 'admin_navlinks_php_info'=>'PHP Info',
	 'admin_navlinks_leave_admin'=>'Leave Admin',
	 'admin_navlinks_logout'=>'Logout',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'Menu',
	 'admin_renderadmin_options'=>'Options',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'Please enter your username and password',
	'auth_doLogin_error_invalid'=>'Invalid Permissions',
	'auth_login_form_username'=>'User Name:',
	'auth_login_form_password'=>'Password:',
	'auth_login_form_autologin'=>'Keep me signed in',
	'auth_login_form_submit'=>'Sign In',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'Path set to: ',
	'time_set'=>'Time set to: ',
	'file_set'=>'File set to: ',
	'target_file_req'=>'A target file is required to save cache.',
	'no_source_processing'=>'No source was passed for processing.',
	'unable_to_open_for_writing'=>'Unable to open {FILENAME} for writing.',
	'written_to'=>'Written to ',
	'no_source_writing'=>'There is no source to write.',
	'deleted'=>'Deleted: ',
	'permission_denied'=>'Permission Denied: ',
	'filename_does_not_exist'=>'The file {FILENAME} does not exist.',
	'file_does_not_exist'=>' File does not exist.',
	'file_expired'=>' File lifetime expired: {DATE}. We need a new one.',
	'file_valid_until'=>' File is valid until: ',
	'unable_to_extract'=>'Unable to extract information on file: ',
	'unable_to_open'=>'Unable to open: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'Delete',
	'comments_add_comment'=>'Add Comment',
	'comments_read_more'=>'Read More',
	'comments_comments_txt'=>'Comments',
	'comments_no_comments_type'=>'There are no comments for this {TYPE}. Add a comment.',
	'comment_deleted'=>'Comment Deleted!',
	'comment_delete_failed'=>'Comment Delete Failed.',
	'comments_name_req'=>'Name is required to post comments.',
	'comments_name_invalid'=>'Name contains invalid Characters.',
	'comments_email_req'=>'Email Address is required to post comments.',
	'comments_email_invalid'=>'Invalid Email address.',
	'comments_url_req'=>'Url is required to post comments.',
	'comments_url_invalid'=>'Invalid Url.',
	'comments_txt_req'=>'Please enter a comment.',
	'comments_txt_invalid'=>'Your comment contains invalid Characters.',
	'comment_duplicate'=>'Duplicate post',
	'comment_fail_save'=>'Failed to save comment',
	'comment_saved'=>'Comment saved',
	'comment_name_anonymous'=>'anonymous',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'Name:',
	'comments_form_email'=>'Email:',
	'comments_form_url'=>'Url:',
	'comments_form_comment'=>'Your Comment:',
	'comments_form_submit'=>'Submit',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'Error: ',
	'fetch_fetching'=>'Fetching: ',
	'fetch_unable_to_open'=>'Unable to open remote file. ',
	'fetch_unable_to_fetch'=>'Unable to fetch remote file.',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'PC Downloads',
    'main_nav_mac_downloads'=>'MAC Downloads',
    'main_nav_online_games'=>'Online Games',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'NULL',
	'genre_info_0_text'=>'NULL',
	'genre_info_253_caption'=>'All',
	'genre_info_253_text'=>'Our game archive, a new game added daily!',
	'genre_info_254_caption'=>'New Download',
	'genre_info_254_text'=>'A new game every day. Check back daily!',
	'genre_info_255_caption'=>'Top Download',
	'genre_info_255_text'=>'This week\'s most popular game downloads.',
	'genre_info_256_caption'=>'New Online Games',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'Top Online Games',
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
	'select_genre_all'=>'All Games',
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
	'label_order'=>'Order',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'Ascending',
	 'select_order_desc'=>'Descending',
	/**
	 * select submit
	 */	 
     'select_submit'=>'Submit',	
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'Today\'s New Release',
	'featured_download_topgame'=>'#1 Hit Game',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'Today\'s New Release',
	'featured_online_topgame'=>'#1 Hit Game',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'{GENRENAME} Games',
	/**
	 * Buttons
	 */
	'btn_download'=>'Download',
	'btn_buy'=>'Buy Now',
	'btn_back'=>'Back',
	'btn_video'=>'Play Video',
	'btn_play'=>'Play Now',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'. . . All <strong>{GENRENAME} </strong> Games <span> (in alphabetical order)</span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'Archive List of <strong>{GENRENAME} </strong> Games',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'Browse Game Archive',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'Viewing  {INFO1} - {INFO2} of {INFO3} Games.',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'Play FREE for one hour',
	 'gameinfo_or_text'=>'or',
	 'gameinfo_unlimited_text'=>'Full unlimited version',
	 'gameinfo_tested_text'=>'Safe &amp; Secure Downloads Quality Tested &amp; Virus Free',
	 'gameinfo_screenshots_text'=>'Screen shots',
	 'gameinfo_image_text'=>'Click images to enlarge',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'System Requirements:',
	 'sysreqos'=>'OS:',
	 'sysreqmhz'=>'CPU:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'HD:',
	 'sysreqother'=>'Other:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'Search Archive',
	 'page_search_message_try'=>'Matches found, please try again.',
	 'page_search_message_results'=>'Results  {START_NUMBER} - {END_NUMBER} of {TOTAL_NUMBER} Games for <strong>{SEARCH_TERM}</strong>.',
	 'page_search_button'=>'Search',
	  /**
	   * site_comments.class.php
	   */
	  /* 'comments_no_comments'=>'No comments yet.', */
		/**
		 * request.php
		 */
		'buy' => 'Buy',
		'download' => 'Download',
	   /**
	    * Tags.php Page
	    */
		'tags'=>'Tags',
		'taginfo'=>'What is tagging? / Tag (Social Software) on <a href="http://en.wikipedia.org/wiki/Tag_cloud">wikipedia</a>',
	   /**
	   * Tags Menu
	   */
		'tagcloud'=>'Tagcloud',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Page',

        'page_play_getting_your_online_game'=>'Getting your online game...'
		
);
?>