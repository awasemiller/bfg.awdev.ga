<?php
 /**
 * SGS Admin Area modules
 * File: modules.php
 *
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
 * @package PNP Tools
 * @subpackage SGS
 *
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */
require_once('../core_gamesite.php');
Site_Parse::page_start();

if(!SGS_ADMIN){
	Site_Admin::adminLogin();
	Site_Parse::page_end();
	exit;
}

if(is_file(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_modules.php')){
	Site_Language::loadLanguageFile(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_modules.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('language_path').'en/admin/en_modules.php');
}

	$options = array(
		array('query'=>'default','text'=>Site_Language::display('modules_opt_default')),
		array('query'=>'view','text'=>Site_Language::display('modules_opt_view'))

		);
	$message ='';

	if(isset($_GET['modules'])){
		$pages = Site_Modules::getModuleConfig();
		$text = Site_Admin::mainLinks($pages);
		Site_Admin::renderAdmin($options,$text,'','options');
		exit;
	}

	/**
	 * load module config
	 */
	$moduleconfig =Site_Modules::loadConfig();
	/**
	 * load page layout
	 */

	if(!isset($_GET['layout'])){
		$_GET['layout'] = 'page';
	}

	$source = Site_Modules::loadLayout($_GET['layout']);
	/**
	 * scan for module area in current layout source
	 */
	$area = Site_Modules::getModuleArea($source);
	/**
	 * enable a module
	 */
	if(isset($_GET['enable'])){

	    /**
	     * Gan check
	     */
	    $ganEnabled = Configuration::get('ganenabled');

		$disAllowModulesForGan = array('online_new','online_top','online_total','language');

        if($ganEnabled && in_array($_GET['module'],$disAllowModulesForGan)){
           
			$message[] = 'Module: '.$_GET['module'].' is unavailable for GAN';
			$error = true;            
            
        }else{
		    
    		$moduleconfig = Site_Modules::enableModule($_GET['layout'], $_GET['area'], $_GET['module'], $moduleconfig);
    
    		if(!Site_Modules::writeConfig($moduleconfig)){
    			$message[] = Site_Language::display('unable_to_save');
    			$error = true;
    		}else{
    			$message[] = str_replace(array('{MODULE}','{AREA}'),array($_GET['module'],$_GET['area']),Site_Language::display('module_added'));
    		}
        }
	}

	/**
	 * order modules
	 */

	if(isset($_GET['order'])){

		$moduleconfig = Site_Modules::orderModule($_GET['layout'],$_GET['area'],$_GET['module'],$_GET['order'], $moduleconfig);

		if(!Site_Modules::writeConfig($moduleconfig)){

			$message[] = Site_Language::display('unable_to_save');
			$error = TRUE;
		}else{
			$message[] = Site_Language::display('order_updated');
		}
	}

	/**
	 * disable a module
	 */
	if(isset($_GET['disable'])){

		$moduleconfig = Site_Modules::disableModule($_GET['layout'],$_GET['area'],$_GET['module'],$moduleconfig);

		if(!Site_Modules::writeConfig($moduleconfig)){
			$message[] = Site_Language::display('unable_to_save');
			$error = TRUE;
		}else{
			$message[] = str_replace(array('{MODULE}','{AREA}'),array($_GET['module'],$_GET['area']),Site_Language::display('module_removed'));
		}
	}

	/**
	 * get messages if they exist
	 */

	$text = Site_Admin::messages($message);

	/**
	 * start form
	 */
	Site_Forms::start_form('module_config', SGS_SELF.'?'.SGS_QUERY, 'get');
	Site_Forms::add_plain_html('<table class="tablecontent">');
	Site_Forms::add_plain_html('<tr><td class="tablecell">');
	Site_Forms::add_select_item('layout', Site_Modules::getLayouts(), $_GET['layout'], Site_Language::display('admin_modules_layout'), 'textbox','',' onchange="this.form.area.value=\'none\'; this.form.submit()"');
	Site_Forms::add_plain_html('</td></tr>');

	if(count($area) > 1){
		Site_Forms::add_plain_html('<tr><td class="tablecell">');
		Site_Forms::add_select_item('area', $area, isset($_GET['area']) ? $_GET['area'] : '', Site_Language::display('admin_modules_area'), 'textbox','',' onchange="this.form.submit()"');
		Site_Forms::add_plain_html('</td></tr>');
		$noarea = FALSE;
	}else{
		Site_Forms::add_plain_html('<tr><td class="tablecell">');
		Site_Forms::add_hidden_data('area','none');
		Site_Forms::add_plain_html(Site_Language::display('no_areas'));
		Site_Forms::add_plain_html('</td></tr>');
		$noarea = TRUE;
	}

	if(isset($_GET['area']) && isset($_GET['layout'])){
		if(trim($_GET['area']) !='none'){
			$current = Site_Modules::getModuleStatic($source);
			if(!is_array($current)){
				$current = array();
			}
			if(isset($moduleconfig[$_GET['layout']]) && is_array($moduleconfig[$_GET['layout']])){
				foreach($moduleconfig[$_GET['layout']] as $area){
					$current = array_merge($current,$area);
				}
			}

			$modules = Site_Modules::getModules();

			foreach($modules as $module){
				if(array_key_exists($module, $current)){
					unset($modules[$module]);
				}
			}

			if(count($modules) >=1){
				Site_Forms::add_plain_html('<tr><td class="tablecell">');
				Site_Forms::add_select_item('module', $modules, isset($_GET['module']) ? $_GET['module'] : '', Site_Language::display('module'), 'textbox');
				Site_Forms::add_plain_html('</td></tr><tr><td>');
				Site_Forms::add_button('enable', Site_Language::display('admin_modules_btn_enable'), 'submit', 'button');
				Site_Forms::add_plain_html('</td></tr>');
			}else{
				Site_Forms::add_plain_html('<tr><td class="tablecell">');
				Site_Forms::add_plain_html(Site_Language::display('all_enabled'));
				Site_Forms::add_plain_html('</td></tr>');
			}

		}else{

			if(!$noarea){
				Site_Forms::add_plain_html('<tr><td class="tablecell">');
				Site_Forms::add_plain_html(Site_Language::display('select_area'));
				Site_Forms::add_plain_html('</td></tr>');
			}
		}
	}

	Site_Forms::add_plain_html('</table>');

	$sidebar = Site_Admin::navLinks('optionsnav',$options);
	$sidebar .= Site_Forms::return_form();

	$layout = isset($_GET['layout']) ? $_GET['layout'] : isset($_GET['layout']) ? $_GET['layout'] : 'page';
	$text .= '<iframe src="pmodules.php?layout='.$layout.'" width="100%" height="400px" frameborder="0"></iframe><br />';

Site_Admin::renderAdmin($options,$text,$sidebar,Site_Language::display('admin_renderadmin_options'));

?>