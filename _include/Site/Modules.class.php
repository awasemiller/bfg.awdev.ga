<?php
/**
 * Site Modules
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
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Class Site Modules.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */
if(!defined('SGS_INIT')){ exit; }

class Site_Modules {

		/**
		 * modPrefs
		 *
		 * @var mixed $modPrefs an array of prefrences or null
		 */
		public static $modPrefs;


		/**
		 * loadConfig
		 * @param viod
		 *
		 * @return array
		 */

		public static function loadConfig()
		{
			if(is_array($config = @unserialize(@file_get_contents(Configuration::get('data_path').'moduleconfig.db')))){
				return $config;
			}else{
				return array();
			}
		}

		/**
		 * getLayouts
		 * @param void
		 *
		 * @return mixed array | bool FALSE
		 */

		public static function getLayouts()
		{
	    	if ($dir = @opendir(Configuration::get('theme_path'))) {
	  	        while (false !== ($tmpfile = readdir($dir))){
		        	if(is_file(Configuration::get('theme_path').$tmpfile) && sgs_eregi('page', $tmpfile) && sgs_eregi('.html', $tmpfile)){
						if($tmpfile =='page.html' || sgs_eregi('page_', $tmpfile)){
		        			$layouts[] = str_ireplace('.html', '',$tmpfile);
						}
		        	}
		        }
		        return $layouts;
	    	}else{
	    		return FALSE;
	    	}
		}

		/**
		 * loadLayout
		 * @param string $layout
		 *
		 * @return mixed string | bool FALSE
		 */

		public static function loadLayout($layout)
		{
			if(is_file(Configuration::get('theme_path').(isset($layout) ? $layout : 'page').'.html') && is_readable(Configuration::get('theme_path').(isset($layout) ? $layout : 'page').'.html')){
				$source = file_get_contents(Configuration::get('theme_path').(isset($layout) ? $layout : 'page').'.html',TRUE);
			}
			if(isset($source) && $source !=FALSE){
				return $source;
			}else{
				return FALSE;
			}
		}

		/**
		 * getModuleArea
		 * @param string $source
		 *
		 * @return array
		 */

		public static function getModuleArea($source)
		{
			$tmp = explode("\n", $source);
			$area[]= array('none'=>Site_Language::display('admin_modules_select_area'));
			foreach($tmp as $line) {
				if (preg_match("/\{MODULEAREA=(.*?)(:.*?)?\}/si", $line, $match)) {
						$area[] = array($match[1]=>$match[1]);
				}
			}
			return $area;
		}

		/**
		 * getModuleStatic
		 * @param string $source
		 *
		 * @return array
		 */

		public static function getModuleStatic($source)
		{
			$tmp = explode("\n", $source);
			$current = array();
			foreach($tmp as $line) {
				if (preg_match("/\{MODULE=(.*?)(:.*?)?\}/si", $line, $match)) {
						$current[$match[1]] = array($match[1]=>'static');
				}

				if (preg_match("/\{GAMENAV}/si", $line, $match)) {
						$current['gamenav'] = array('gamenav'=>'static');
				}

				if (preg_match("/\{SEARCH}/si", $line, $match)) {
						$current['search'] = array('search'=>'static');
				}
			}
			return $current;
		}

		/**
		 * getModules
		 * @param void
		 *
		 * @return mixed array | bool FALSE
		 */

		public static function getModules()
		{
		    $ganEnabled = Configuration::get('ganenabled');
	
		    $disAllowModulesForGan = array('online','language');
		    
	    	if ($dir = @opendir(Configuration::get('module_path'))) {
		        while (false !== ($tmpdir = readdir($dir))){
		            
		            $modAvailable = true;
      
		            if($ganEnabled && in_array($tmpdir,$disAllowModulesForGan)){
		               $modAvailable = false;
		            }
	            
		        	if($modAvailable && is_dir(Configuration::get('module_path').$tmpdir)){
	        	    
						if($moddir = @opendir(Configuration::get('module_path').$tmpdir)){
							while (false !== ($modfile = readdir($moddir))){

								if(sgs_eregi('menu_', $modfile)){
									$search = array('menu_','.php');
									$replace = array('','');
									$modfile = str_replace($search,$replace,$modfile);
									$modules[$modfile]= $modfile;
								}
							}
		        		}
    	        	}
		        }
		        return $modules;
	    	}
		  	return false;
		}

		/**
		 * getModuleConfig
		 * @param void
		 *
		 * @return mixed array | bool FALSE
		 */

		public static function getModuleConfig()
		{

		    if(!defined('ADMIN_ICONPATH')){
				define('ADMIN_ICONPATH',SGS_BASE_URL.'images/admin/icons/');
			}

			$config[] = array('page'=>'modules.php','query'=>'','text'=>'Modules');
			$query = FALSE;


	    	if ($dir = @opendir(Configuration::get('module_path'))) {
		        while (false !== ($tmpdir = readdir($dir))){
					$name = FALSE;
					$description = FALSE;
					$icon = FALSE;
		        	if(is_dir(Configuration::get('module_path').$tmpdir)){

		        		if(is_file(Configuration::get('module_path').$tmpdir.'/admin.php')){

							/**
							 * sgs 0.7+ module support
							 */
							if(is_file(Configuration::get('module_path').$tmpdir.'/module.php')){
								Site_Language::loadLanguageFile(Configuration::get('module_path').$tmpdir.'/language/'.LOCALE.'_language.php');


								require_once(Configuration::get('module_path').$tmpdir.'/module.php');

								if(!$icon){
									$icon = ADMIN_ICONPATH.'modules.png';
								}
								
								if(!$author){
								    $author = '';
								}
								
							    if(!$version){
								    $version = '';
								}

							}else{
								/**
								 * sgs 0.6 module support
								 */

								$fp=fopen(Configuration::get('module_path').$tmpdir.'/admin.php', 'r');
								$modinfo = fread($fp, filesize(Configuration::get('module_path').$tmpdir.'/admin.php'));
								fclose($fp);

								preg_match('/query(\s*?=\s*?)("|\')(.*?)("|\');/si', $modinfo, $info);
								if($info[3] !=''){ $query = $info[3]; }else{ $query = ''; }

								/**
								 * sgs 0.6 module support
								 */
								preg_match('/description(\s*?=\s*?)("|\')(.*?)("|\');/si', $modinfo, $info);

								if($info[3] !=''){
									$description = $info[3];
								}else{
									$description = 'no description provided';
								}

								preg_match('/icon(\s*?=\s*?)("|\')(.*?)("|\');/si', $modinfo, $info);

								if($info[3] !=''){
									$icon = Configuration::get('module_path').$tmpdir.'/'.$info[3];
								}else{

									$icon = ADMIN_ICONPATH.'modules.png';
								}
							}

							$config[] = array('page'=>Configuration::get('module_base_url').$tmpdir.'/admin.php','query'=>$query,'text'=>(($name !=FALSE) ? $name : $tmpdir),'description'=>$description,'icon'=>$icon,'author'=>$author,'version'=>$version);
		        		}
		        	}
		        }
		        return $config;
	    	}
		  	return FALSE;
		}

		/**
		 * moduleEdit
		 * @param string $area
		 * @param string $module
		 * @param int $order
		 * @param array $moduleConfig
		 *
		 * @return string
		 */

		public static function moduleEdit($area,$module,$order, $moduleConfig)
		{
			$edit = '<span class="moduleEdit">';
			if(($order !=1) && ($order !=2)){
				$edit .= '<a href="#" onClick=\'parent.location="modules.php?layout='.PAGETEMPLATE.'&amp;area='.$area.'&amp;module='.$module.'&amp;order='.(1).'"\'><img src="'.SGS_BASE_URL.'images/admin/top.gif" alt="top" /></a>';
			}else{
				$edit .= '<img src="'.SGS_BASE_URL.'images/admin/top_dis.gif" alt="top" />';
			}
			if($order !=1){

				$edit .= '<a href="#" onClick=\'parent.location="modules.php?layout='.PAGETEMPLATE.'&amp;area='.$area.'&amp;module='.$module.'&amp;order='.($order-1).'"\'><img src="'.SGS_BASE_URL.'images/admin/up.gif" alt="top" /></a>';
			}else{
				$edit .= '<img src="'.SGS_BASE_URL.'images/admin/up_dis.gif" alt="top" />';
			}
			if($order !=count($moduleConfig[PAGETEMPLATE][$area])){

				$edit .= '<a href="#" onClick=\'parent.location="modules.php?layout='.PAGETEMPLATE.'&amp;area='.$area.'&amp;module='.$module.'&amp;order='.($order+1).'"\'><img src="'.SGS_BASE_URL.'images/admin/down.gif" alt="down" /></a>';
			}else{
				$edit .= '<img src="'.SGS_BASE_URL.'images/admin/down_dis.gif" alt="down" />';
			}
			if(($order !=count($moduleConfig[PAGETEMPLATE][$area])) && ($order !=count($moduleConfig[PAGETEMPLATE][$area]) - 1)){
				$select[] = array('bottom',count($moduleConfig[PAGETEMPLATE][$area]));
				$edit .= '<a href="#" onClick=\'parent.location="modules.php?layout='.PAGETEMPLATE.'&amp;area='.$area.'&amp;module='.$module.'&amp;order='.count($moduleConfig[PAGETEMPLATE][$area]).'"\'><img src="'.SGS_BASE_URL.'images/admin/bottom.gif" alt="bottom" /></a>';
			}else{
				$edit .= '<img src="'.SGS_BASE_URL.'images/admin/bottom_dis.gif" alt="bottom" />';
			}
			$edit .= '<a href="#" onClick=\'parent.location="modules.php?layout='.PAGETEMPLATE.'&amp;area='.$area.'&amp;module='.$module.'&amp;disable"\'><img src="'.SGS_BASE_URL.'images/admin/close.gif" alt="close" /></a>';
			$edit .='</span>';
			return $edit;
		}

		/**
		 * enableModule
		 * @param string $layout
		 * @param string $area
		 * @param string $emodule
		 * @param string $moduleConfig
		 *
		 * @return array
		 */

		public static function enableModule($layout, $area, $emodule, $moduleConfig)
		{
            
			if(isset($moduleConfig[$layout][$area]) && is_array($moduleConfig[$layout][$area])){

				foreach($moduleConfig[$layout][$area] as $module=>$info){
					$order[$module] = $info['order'];
				}
				if(isset($order) && is_array($order)){
					array_multisort($order,SORT_ASC, SORT_NUMERIC, $moduleConfig[$layout][$area]);
				}

			}else{
				$moduleConfig[$layout][$area] = array();
			}

			$moduleConfig[$layout][$area][$emodule] = array('order'=>(count($moduleConfig[$layout][$area]) + 1));

			return $moduleConfig;
		}

		/**
		 * orderModule
		 * @param string $layout
		 * @param string $area
		 * @param string $omodule
		 * @param int $order
		 * @param array $moduleConfig
		 *
		 * @return array
		 */

		public static function orderModule($layout,$area,$omodule,$order,$moduleConfig)
		{
			$cur = $moduleConfig[$layout][$area][$omodule]['order'];
			foreach($moduleConfig[$layout][$area] as $module=>$info){
				if($omodule == $module){
					$info['order'] = $order;
				}else{
					if($info['order'] < $cur && $info['order'] >= $_GET['order']){
						$info['order'] = $info['order'] + 1;
					}else if($info['order'] > $cur && $info['order'] <= $_GET['order']){
						$info['order'] = $info['order'] - 1;
					}
				}
				$moduleConfig[$layout][$area][$module] = array('order'=>$info['order']);
			}
			return $moduleConfig;
		}

		/**
		 * disableModule
		 *
		 * @param string $layout
		 * @param string $area
		 * @param string $dmodule
		 * @param array $moduleConfig
		 *
		 * @return array
		 */

		public static function disableModule($layout,$area,$dmodule,$moduleConfig)
		{
			unset($moduleConfig[$layout][$area][$dmodule]);
			foreach($moduleConfig[$layout][$area] as $module=>$info){
				$order[$module] = $info['order'];
			}

			if(isset($order) && is_array($order)){
				array_multisort($order,SORT_ASC, SORT_NUMERIC, $moduleConfig[$layout][$area]);
			}

			$i=1;
			foreach($moduleConfig[$layout][$area] as $module=>$info){
				$moduleConfig[$layout][$area][$module]['order'] = $i;
				$i++;
			}
			return $moduleConfig;
		}

		/**
		 * checkModuleAreas
		 * @param void
		 *
		 * @return void
		 */

		public static function checkModuleAreas()
		{
			$layouts = self::getLayouts();

			foreach($layouts as $page=>$layout){
				$source = self::loadLayout($layout);
				$tmp = explode("\n", $source);
			//	unset($area);
				$area = array();
				foreach($tmp as $line) {
					if (preg_match("/\{MODULEAREA=(.*?)(:.*?)?\}/si", $line, $match)) {
						$area[$match[1]] = $match[1];
					}
				}
				$chk[$layout] = $area;
			}

			$pagelayouts = self::loadConfig();

			foreach($pagelayouts as $page=>$modulearea){

				$areas = array_keys($modulearea);
				/**
				 * check if the current template layout exists
				 * if so we'll test for module areas
				 */
				if(array_key_exists($page,$chk)){
					/**
					 * layout exists so we must validate the module areas
					 */
					foreach($areas as $key=>$value){
						/**
						 * if the modul area does not exist in the current layout well unset
						 * any modules assigned to it.
						 */
						if(!array_key_exists($value,$chk[$page])){
							unset($pagelayouts[$page][$value]);
							if(count($pagelayouts[$page])>1){
								/**
								 * if there are no more module areas assigned modules unset the page array as well
								 */
								unset($pagelayouts[$page]);
							}
						}
					}
				}
			}
			self::writeConfig($pagelayouts);
		}

		/**
		 * writeConfig
		 * @param array $data
		 *
		 * @return bool
		 */

		public static function writeConfig($data)
		{
			$filename = Configuration::get('data_path').'moduleconfig.db';
			if(is_array($data)){
				$data = serialize($data);
			}else{
				return FALSE;
			}

			$fp = @fopen($filename, "w");
			if (!@fwrite($fp, $data)) {
				@fclose ($fp);
				return FALSE;
			}
			@fclose ($fp);
			return TRUE;
		}

		/**
		 * savePrefs
		 * @param string $module name of pref key
		 * @return array prefs
		 */

		public static function loadPrefs($module)
		{
			if(is_array(self::$modPrefs)){
				if(array_key_exists($module,self::$modPrefs)){
					return self::$modPrefs[$module];
				}
			}

			if(is_array($modPrefs = @unserialize(@file_get_contents(Configuration::get('data_path').'moduleprefs.db')))){
				self::$modPrefs = $modPrefs;
				if(array_key_exists($module,self::$modPrefs)){
					return self::$modPrefs[$module];
				}
			}

			return array();
		}

		/**
		 * savePrefs
		 * @param array $modeFile
		 *
		 * @return bool
		 */

		public static function savePrefs($module,$modePrefs)
		{
				$modPrefsTmp = @unserialize(@file_get_contents(Configuration::get('data_path').'moduleprefs.db'));

				$modPrefsTmp[$module] = $modePrefs;

				if(is_array($modPrefsTmp)){
					$modPrefsTmp = serialize($modPrefsTmp);
				}else{
					return FALSE;
				}

				$fp = @fopen(Configuration::get('data_path').'moduleprefs.db', "w");
				if (!@fwrite($fp, $modPrefsTmp)) {
					@fclose ($fp);
					return FALSE;
				}
				@fclose ($fp);
				return TRUE;
		}

		/**
		 * 
		 * Enter description here ...
		 * @param unknown_type $module
		 * @param unknown_type $fname
		 */
		public static function loadModule($module,$fname)
		{
		    
        	    
		        $ganEnabled = Configuration::get('ganenabled');
		    
		        $disAllowModulesForGan = array('online','language');
      
	            if($ganEnabled && in_array($fname,$disAllowModulesForGan)){
	               return false;
	            }
		    
				$modulePathArray = explode('/',$module);
				
				$moduleMenuName = array_pop($modulePathArray);
				
				$moduleConfigFile = str_replace($moduleMenuName,'module.php',$module);
							
				if(is_file($moduleConfigFile) && is_readable($moduleConfigFile)){
					require($moduleConfigFile);
				}

				if(isset($explicit_cache) && $explicit_cache == TRUE){
					//unset($explicit_cache);
					$modkey = 'module_'.$fname.'_'.LOCALE.'_'.PLATFORM.'_'.md5($module.Configuration::get('theme_url').SGS_PAGE.eregi_replace('&reset=cache','',html_entity_decode(SGS_QUERY)));
				}else{
					$modkey = 'module_'.$fname.'_'.LOCALE.'_'.PLATFORM.'_'.md5($module.Configuration::get('theme_url'));
				}

				if(isset($explicit_pages) && is_array($explicit_pages)){
						if(!in_array(SGS_PAGE,$explicit_pages) && isset($cachable)){
						unset($cachable,$explicit_pages);
					}
				}

				
			
				if(Configuration::get('module_cache')){
				    
				    
					if(isset($cachable) && $cachable == true){
					/**
					 * @todo fix cache
					 */
					    
					    Cache::setFile($modkey,array('ext'=>'mod'));

						if(isset($_GET['reset']) && $_GET['reset'] =='cache'){
							Cache::expire($modkey);
						}
						
						if(!Cache::needNewFile($modkey)){
						    return Cache::load($modkey);
						}
					}
				}

				if(is_file($module) && is_readable($module)){
					ob_start();
					require_once($module);
		 			$module = ob_get_contents();
	 				ob_end_clean();
	 				
					if(Configuration::get('module_cache') == true){
						if(isset($cachable) && $cachable == true){
						    
						    Cache::setFile($modkey,array('ext'=>'mod'));
						    Cache::save($modkey, $module);
						   
						}
					}

					unset($cachable,$explicit_cache);
	 				return $module;
				}else{
					unset($cachable);
					return FALSE;
				}
		}

		/**
		 * clear - clear module cache
		 * @param bool $all default False
		 * @return void
		 */
		public static function clear()
		{
   
			Site_CacheManager::flush('mod');

		}


}

?>