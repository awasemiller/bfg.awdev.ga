<?php
/**
 * SGS JP language
 *
 * Type: language
 * Subtag: ja
 * Description: Japan
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
	'read_more'=>'詳細',
	/**
	 * Site_Admin.class.php
	 * 'Success' and 'Error' messages
	 */
	'admin_success'=>'成功',
	'admin_error'=>'エラー',
	/**
	 * Site_Admin.class.php
	 * Login messages
	 */
	 'admin_signin'=>'ログイン',
	 /**
	  * Site_Admin.class.php navLinks
	  */
	 'admin_navlinks_main'=>'メイン',
	 'admin_navlinks_site_settings'=>'サイト設定',
	 'admin_navlinks_custom_pages'=>'カスタムページ',
	 'admin_navlinks_modules'=>'モジュール',
	 'admin_navlinks_php_info'=>'PHP 情報',
	 'admin_navlinks_leave_admin'=>'管理画面を終了',
	 'admin_navlinks_logout'=>'ログアウト',
	 /**
	  * Site_Admin.class.php renderAdmin
	  */
	 'admin_renderadmin_menu'=>'メニュー',
	 'admin_renderadmin_options'=>'オプション',
	 /**
	  * site_auth.class.php
	  */
	'auth_doLogin_error_empty'=>'ユーザー名とパスワードを入力してください',
	'auth_doLogin_error_invalid'=>'ユーザー名またはパスワードが無効です',
	'auth_login_form_username'=>'ユーザー名:',
	'auth_login_form_password'=>'パスワード:',
	'auth_login_form_autologin'=>'次回から自動でログインする',
	'auth_login_form_submit'=>'ログイン',
	/**
	 * site_cache.class.php
	 */
	'path_set'=>'パスを設定する: ',
	'time_set'=>'時間を設定する: ',
	'file_set'=>'ファイルを設定する: ',
	'target_file_req'=>'対象のファイルはキャッシュの保存を求められています',
	'no_source_processing'=>'ソースをプロセスできません',
	'unable_to_open_for_writing'=>'書き込むための {FILENAME} を開けません',
	'written_to'=>'次に書き込まれました',
	'no_source_writing'=>'書き込むソースがありません',
	'deleted'=>'削除されました: ',
	'permission_denied'=>'許可が認められません: ',
	'filename_does_not_exist'=>'このファイル名 {FILENAME} は存在しません',
	'file_does_not_exist'=>' ファイルは存在しません',
	'file_expired'=>'ファイルの有効期限が次の日付で切れています: {DATE} 新しいファイルが必要です',
	'file_valid_until'=>' ファイルは次の日付まで有効です: ',
	'unable_to_extract'=>'ファイルに情報を展開することができません: ',
	'unable_to_open'=>'ファイルを開けません: ',
	/**
	 * site_comments.class.php
	 */
	'comments_delete'=>'削除',
	'comments_add_comment'=>'コメントを追加',
	'comments_read_more'=>'続きを読む',
	'comments_comments_txt'=>'コメント',
	'comments_no_comments_type'=>'{TYPE} に関してのコメントはありません。コメントを追加してください',
	'comment_deleted'=>'コメントが削除されました！',
	'comment_delete_failed'=>'コメントの削除に失敗しました',
	'comments_name_req'=>'コメントを投稿するには名前が必要です',
	'comments_name_invalid'=>'名前に無効な文字が含まれています',
	'comments_email_req'=>'コメントを投稿するにはメールアドレスが必要です',
	'comments_email_invalid'=>'無効なメールアドレスです',
	'comments_url_req'=>'コメントを投稿するには URL が必要です',
	'comments_url_invalid'=>'無効な URL です',
	'comments_txt_req'=>'コメントを入力してください',
	'comments_txt_invalid'=>'入力されたコメントに無効な文字が含まれています',
	'comment_duplicate'=>'2 重投稿です',
	'comment_fail_save'=>'コメントの保存に失敗しました',
	'comment_saved'=>'コメントが保存されました',
	'comment_name_anonymous'=>'anonymous',
	/**
	 * site_comments.class.php
	 * comment form
	 */
	'comments_form_name'=>'名前:',
	'comments_form_email'=>'メールアドレス:',
	'comments_form_url'=>'URL:',
	'comments_form_comment'=>'コメント:',
	'comments_form_submit'=>'送信',
	/**
	 * site_fetch.class.php
	 */
	'fetch_error'=>'エラー: ',
	'fetch_fetching'=>'フェッチ: ',
	'fetch_unable_to_open'=>'リモートファイルを開けません',
	'fetch_unable_to_fetch'=>'リモートファイルをフェッチできません',
    /**
     * MainNavigation.class.php
     */
    'main_nav_pc_downloads'=>'ダウンロード ゲーム',
    'main_nav_mac_downloads'=>'Macのダウンロード',
    'main_nav_online_games'=>'ウェブ ゲーム',
	/**
	 * Site_Game.class.php
	 * function setGenreIfo
	 * sets the genre caption and description text
	 */
	'genre_info_0_caption'=>'無効',
	'genre_info_0_text'=>'無効',
	'genre_info_253_caption'=>'全ジャンル',
	'genre_info_253_text'=>'ゲームのライブラリ、新着ゲームがぞくぞく登場！',
	'genre_info_254_caption'=>'新着ダウンロードゲーム',
	'genre_info_254_text'=>'気軽に楽しめるゲームがぞくぞく登場！こまめにチェックしよう！',
	'genre_info_255_caption'=>'トップダウンロードゲーム',
	'genre_info_255_text'=>'今週のトップゲーム一覧',
	'genre_info_256_caption'=>'新着ウェブゲーム',
	'genre_info_256_text'=>'',
	'genre_info_257_caption'=>'トップオンラインゲーム',
	'genre_info_257_text'=>'',
	/**
	 * Site_Game.class.php
	 * function sortList
	 */
	 /**
	  * select genre label
	  */
	'label_genre'=>'ジャンル',
	 /**
	  * select genre
	  */
	'select_genre_all'=>'全ジャンル',
	/**
	 * select sort label
	 */
	'label_sort'=>'分類',
	/**
	 * select sort
	 */
	 'select_sort_date'=>'リリース日',
	 'select_sort_rank'=>'人気ランキング',
	 'select_sort_name'=>'タイトル',
	/**
	 * select order label
	 */
	'label_order'=>'表示',
	/**
	 * select sort
	 */
	 'select_order_asc'=>'昇順',
	 'select_order_desc'=>'降順',
	/**
	 * select submit
	 */	 
     'select_submit'=>'送信',
	/**
	 * download-games.php feature game text
	 */
	'featured_download_newgame'=>'新着ゲーム',
	'featured_download_topgame'=>'人気ナンバー 1 のゲーム',
	/**
	 * online-games.php feature game text
	 */
	'featured_online_newgame'=>'新着ゲーム',
	'featured_online_topgame'=>'人気ナンバー 1 のゲーム',
	/**
	 * Site_Game.class.php
	 * featureListCaption
	 * sets the feature caption
	 */
	'featureListCaption'=>'{GENRENAME} ゲーム',
	/**
	 * Buttons
	 */
	'btn_download'=>'ダウンロード',
	'btn_buy'=>'購入',
	'btn_back'=>'戻る',
	'btn_video'=>'ビデオを再生',
	'btn_play'=>'今すぐプレイ',
	/**
	 * Site_Game.class.php
	 * genreListCaption
	 * sets the genre list caption
	 * found on the index page when viewing a genre or the top rank list
	 */
	'genreListCaption'=>'全 <strong>[{GENRENAME}]</strong> ゲーム <span> </span>',
	/**
	 * browse.php  Page
	 * browseListCaption
	 * sets the browse caption found on browse.php page
	 */
	'browseListCaption'=>'<strong>{GENRENAME} </strong> ゲームリスト',
	/**
	 * browse.php  Page
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	 'browse_caption'=>'ゲームライブラリ内を検索',
	/**
	 * browse.php
	 * browse_caption
	 * used for the caption above the sortlist form found on browse.php page
	 */
	'browseinfo'=>'{INFO3} ゲーム中　{INFO1} - {INFO2}　を表示',
	/**
	 * gameinfo.php Page
	 */
	 'gameinfo_free_text'=>'1 時間無料でプレイ',
	 'gameinfo_or_text'=>'または',
	 'gameinfo_unlimited_text'=>'制限なし完全版',
	 'gameinfo_tested_text'=>'安全 &amp; 安心ダウンロード 品質検査済み &amp; ウイルスフリー',
	 'gameinfo_screenshots_text'=>'スクリーンショット',
	 'gameinfo_image_text'=>'画像をクリックして拡大',
	/**
	 * gameRequirements
	 * found on gameinfo Page
	 */
	 'sysreqs'=>'システム要件：',
	 'sysreqos'=>'オペレーティングシステム:',
	 'sysreqmhz'=>'CPU:',
	 'sysreqvideo'=>'',
	 'sysreqmem'=> 'RAM:',
	 'sysreq3d'=>'3D:',
	 'sysreqdx'=>'DirectX:',
	 'sysreqhd'=>'ハードドライブ：',
	 'sysreqother'=>'他:',
	 /**
	  * search.php Page
	  */
	 'page_search_caption'=>'ライブラリ内を検索',
	 'page_search_message_try'=>'該当するものがありませんでした。もう一度検索してください。',
	 'page_search_message_results'=>'結果： <strong>{SEARCH_TERM}</strong> で検索した合計ヒット数 {TOTAL_NUMBER} のうち {START_NUMBER} から {END_NUMBER}',
     'page_search_button'=>'検索',
	/**
	 * request.php
	 */
	'buy' => '購入',
	'download' => 'ダウンロード',
   /**
    * Tags.php Page
    */
	'tags'=>'タグ',
	'taginfo'=>'タグとは何ですか？ / タグ (ソーシャルソフトウェア) <a href="http://en.wikipedia.org/wiki/Tag_cloud">wikipedia</a>',
   /**
   * Tags Menu
   */
	'tagcloud'=>'タグクラウド',
		/**
		 * site_paginate.class.php
		 */
		'paginate_page'=>'Page',
		'page_play_getting_your_online_game'=>'ウェブゲームを準備中・・・'		
);
?>