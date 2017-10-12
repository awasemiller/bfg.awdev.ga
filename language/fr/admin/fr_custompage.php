<?php
/**
 * PNP TOOLS ADMIN/CUSTOMPAGE FR language
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
 * @author Jesse Stewart <jesse.stewart@bigfishgames.com>
 * @version 1.0
 * @package SGS
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

if(!defined('SGS_INIT')){ exit; }

$language = array(
	'custompage_opt_default'=>'Pages personnalisées',
	'custompage_opt_view'=>'Voir les pages',
	'custompage_opt_new'=>'Nouvelle page',
	'custompage_opt_edit'=>'Modifier la page',

	'custompage_msg_file_exists'=>'Fichier déjà existant, veuillez choisir un nom de fichier différent.',
	'custompage_msg_file_created'=>'La page {FILENAME} a été créée.',
	'custompage_msg_unable_to_write'=>'Impossible de créer le fichier : {FILENAME}.',
	'custompage_msg_confirm_delete'=>'Veuillez confirmer la suppression de <strong>{FILENAME}</strong>.',
	'custompage_msg_file_deleted'=>'Fichier : {FILENAME} supprimé !',
	'custompage_msg_unable_to_delete'=>'Impossible de supprimer le fichier {FILENAME}.',
	'custompage_msg_file_saved'=>'{FILENAME} sauvegardé.',
	'custompage_msg_error_saving'=>'Erreur lors de la sauvegarde de {FILENAME}.',
	'custompage_msg_unable_to_edit'=>'Impossible d\'ouvrir ( {FILENAME} ) pour le modifier. Vérifiez que le fichier existe.',

	'custompage_file_new'=>'Nouveau fichier',
	'custompage_file_caption'=>'Votre titre',
	'custompage_file_content'=>'Votre texte va ici',
	'custompage_file_meta_desc'=>'Meta Description',
	'custompage_file_meta_key'=>'Mots clés Meta',

	'custompage_btn_confirm'=>'Confirmer',
	'custompage_btn_continue'=>'Continuer',
	'custompage_btn_submit'=>'Envoyer',

	'custompage_label_name'=>'Nom du fichier :',
	'custompage_label_caption'=>'Description :',
	'custompage_label_content'=>'Contenu :',
	'custompage_label_content'=>'Contenu :',
	'custompage_label_default_language'=>'Langue par défaut :',
	'custompage_label_meta_desc'=>'Description META Tag (pour les moteurs de recherche) :',
	'custompage_label_meta_key'=>'Mots clés META Tag (mots clés séparés par virgules) :',
	'custompage_label_allow_comments'=>'Autoriser les commentaires',
	'custompage_msg_comments_disabled'=>'Les commentaires sur le site sont désactivés. Activer cette fonctionnalité en configurant le paramètre <a href="{LINK}siteconfig.php?comments">Autoriser les commentaires</a> à Oui dans <a href="{LINK}siteconfig.php?comments">Paramètres du site &raquo; Options des commentaires</a>.',

	'custompage_th_pages'=>'Pages existantes',
	'custompage_th_options'=>'Options',
	'custompage_th_lang'=>'Langue',

	'custompage_edit'=>'Modifier',
	'custompage_delete'=>'Supprimer',
	'custompage_msg_no_pages'=>'Il n\'y a pas de page personnalisée.',
	'custompage_msg_create_new'=>'Créer une nouvelle page ?',
	);
?>