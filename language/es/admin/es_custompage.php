<?php
/**
 * PNP TOOLS ADMIN/CUSTOMPAGE ES language
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
 * @author Jesse Stewart <jesse.stewart@bigfishgames.com>
 * @version 1.0
 * @package SGS
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */

if(!defined('SGS_INIT')){ exit; }

$language = array(
	'custompage_opt_default'=>'Personalizar páginas',
	'custompage_opt_view'=>'Ver páginas',
	'custompage_opt_new'=>'Nueva página',
	'custompage_opt_edit'=>'Editar página',

	'custompage_msg_file_exists'=>'El archivo ya existe. Por favor, escoge un nombre diferente para el archivo.',
	'custompage_msg_file_created'=>'Página {FILENAME} creada.',
	'custompage_msg_unable_to_write'=>'No ha sido posible crear el archivo: {FILENAME}.',
	'custompage_msg_confirm_delete'=>'Por favor, confirma que deseas borrar <strong>{FILENAME}</strong>.',
	'custompage_msg_file_deleted'=>'¡Archivo {FILENAME} eliminado!',
	'custompage_msg_unable_to_delete'=>'No ha sido posible eliminar el archivo {FILENAME}.',
	'custompage_msg_file_saved'=>'{FILENAME} guardado.',
	'custompage_msg_error_saving'=>'Se ha producido un error al guardar {FILENAME}.',
	'custompage_msg_unable_to_edit'=>'No ha sido posible abrir ( {FILENAME} ) para editar. Asegúrate de que el archivo ha sido creado.',

	'custompage_file_new'=>'Archivo',
	'custompage_file_caption'=>'El título',
	'custompage_file_content'=>'El contenido va aquí',
	'custompage_file_meta_desc'=>'Descripción meta',
	'custompage_file_meta_key'=>'Palabras clave meta',

	'custompage_btn_confirm'=>'Confirmar',
	'custompage_btn_continue'=>'Continuar',
	'custompage_btn_submit'=>'Aceptar',

	'custompage_label_name'=>'Nombre del archivo:',
	'custompage_label_caption'=>'Título:',
	'custompage_label_content'=>'Contenido:',
	'custompage_label_content'=>'Contenido:',
	'custompage_label_default_language'=>'Idioma por defecto:',
	'custompage_label_meta_desc'=>'Etiqueta meta para descripción (para motores de búsqueda):',
	'custompage_label_meta_key'=>'Etiquetas meta para palabras clave (palabras separadas por comas):',
	'custompage_label_allow_comments'=>'Permitir comentarios',
	'custompage_msg_comments_disabled'=>'Los comentarios están deshabilitados. Habilita esta función seleccionando Sí en <a href="{LINK}siteconfig.php?comments">Permitir comentarios del sitio</a> en <a href="{LINK}siteconfig.php?comments">Configuración del sitio &raquo; Opciones de comentarios</a>.',

	'custompage_th_pages'=>'Páginas existentes',
	'custompage_th_options'=>'Opciones',
	'custompage_th_lang'=>'Idioma',

	'custompage_edit'=>'Editar',
	'custompage_delete'=>'Borrar',
	'custompage_msg_no_pages'=>'No hay páginas creadas.',
	'custompage_msg_create_new'=>'¿Quieres crear una página?',
	);
?>