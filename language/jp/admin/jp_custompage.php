<?php
/**
 * PNP TOOLS ADMIN/CUSTOMPAGE JP language
 *
 * Type: language
 * Subtag: jp
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
 * @author Jesse Stewart <jesse.stewart@bigfishgames.com>
 * @version 1.0
 * @package SGS
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

if(!defined('SGS_INIT')){ exit; }

$language = array(
	'custompage_opt_default'=>'カスタムページ',
	'custompage_opt_view'=>'ページを見る',
	'custompage_opt_new'=>'ページを新規作成',
	'custompage_opt_edit'=>'ページの編集',

	'custompage_msg_file_exists'=>'その名前のファイルは既に存在します。他の名前をご指定ください。',
	'custompage_msg_file_created'=>'{FILENAME} という名前でページを作成しました。',
	'custompage_msg_unable_to_write'=>'{FILENAME} の書き換えを完了できませんでした。',
	'custompage_msg_confirm_delete'=>'<strong>{FILENAME}</strong>　のファイルを削除します。よろしいですか？',
	'custompage_msg_file_deleted'=>'{FILENAME} を削除しました。',
	'custompage_msg_unable_to_delete'=>'{FILENAME} を削除できませんでした。',
	'custompage_msg_file_saved'=>'{FILENAME} を保存しました。',
	'custompage_msg_error_saving'=>'{FILENAME} の保存中にエラーが発生しました。',
	'custompage_msg_unable_to_edit'=>'( {FILENAME} ) を開くことができません。このファイルが存在することをご確認ください。',

	'custompage_file_new'=>'新規ファイル',
	'custompage_file_caption'=>'コンテンツ欄タイトル',
	'custompage_file_content'=>'ここにコンテンツが入ります。',
	'custompage_file_meta_desc'=>'META データの詳細',
	'custompage_file_meta_key'=>'META キーワード',

	'custompage_btn_confirm'=>'確認',
	'custompage_btn_continue'=>'続ける',
	'custompage_btn_submit'=>'送信',

	'custompage_label_name'=>'ファイル名：',
	'custompage_label_caption'=>'キャプション：',
	'custompage_label_content'=>'コンテンツ：',
	'custompage_label_content'=>'コンテンツ：',
	'custompage_label_default_language'=>'初期設定の言語：',
	'custompage_label_meta_desc'=>'META タグの詳細（検索エンジン用）：',
	'custompage_label_meta_key'=>'META タグ用キーワード（キーワード毎にコンマで区切ってください）：',
	'custompage_label_allow_comments'=>'コメントの許可',
	'custompage_msg_comments_disabled'=>'コメント機能は使用できない状態に設定されています。この機能を有効にするには<a href="{LINK}siteconfig.php?comments">サイト設定 &raquo; コメントオプション</a>内で<a href="{LINK}siteconfig.php?comments">コメント機能の有効化</a>の設定を「オン」にしてください。',

	'custompage_th_pages'=>'存在するページ',
	'custompage_th_options'=>'オプション',
	'custompage_th_lang'=>'言語',

	'custompage_edit'=>'編集',
	'custompage_delete'=>'削除',
	'custompage_msg_no_pages'=>'作成済みのカスタムページはありません。',
	'custompage_msg_create_new'=>'新規でページを作成しますか？',
	);
?>