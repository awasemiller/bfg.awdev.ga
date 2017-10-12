<?php
/**
 * Site Template
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
 * Class Site Template.
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

class Site_Template {

		/**
		 * setPreview
		 * @param array $_GET key required for process ( previewtemplate )
		 * 
		 * @return void 
		 */
		public static function setPreview($template)
		{
			if(isset($template['previewtemplate'])){
				if(self::checkTemplate($template['previewtemplate'])){
				     Configuration::set('theme',$template['previewtemplate']);
				}
			}
		}

		/**
		 * setUserTemplate
		 * @param array $_GET key required for process ( setusertemplate )
		 * 
		 * @return void
		 */
		public static function setUserTemplate($template)
		{
			if(isset($template['setusertemplate']) && self::checkTemplate($template['setusertemplate'])){
				setcookie('usertemplate', $template['setusertemplate'], (time() + 3600 * 24 * 30),'/');
				self::setTemplate($template['setusertemplate']);
			}
		}

		/**
		 * setUserTemplate
		 * @param array $_GET key required for process ( setadmintemplate )
		 * 
		 * @return void
		 */
		public static function setAdminTemplate($template)
		{
		   
			if(isset($template['setadmintemplate']) && self::checkTemplate($template['setadmintemplate'])){
				setcookie('admintemplate', $template['setadmintemplate'], (time() + 3600 * 24 * 30),'/');
				self::setTemplate($template['setadmintemplate']);
			}
		}	
			
		/**
		 * unSetUserTemplate
		 * @param void
		 * 
		 * @return void 
		 */
		public static function unSetUserTemplate($redirect=true)
		{
			setcookie('usertemplate', null, (time() - 3600),'/');
			if($redirect){
			    header('location: '.SGS_SELF);
			}
		}

		/**
		 * unSetAdminTemplate
		 * @param void
		 * 
		 * @return void 
		 */
		public static function unSetAdminTemplate($redirect=true)
		{
			setcookie('admintemplate', null, (time() - 3600),'/');
			if($redirect){
			    header('location: '.SGS_SELF.'?'.SGS_QUERY);
			}
			
		}
	
		
		/**
		 * setUserTemplate - loads the user template if template checks pass
		 * @param void
		 * 
		 * @return void
		 */
		public static function getUserTemplate()
		{
   
			if(!isset($_GET['previewtemplate'])){
				if(isset($_COOKIE['usertemplate']) && self::checkTemplate($_COOKIE['usertemplate'])){
					self::setTemplate($_COOKIE['usertemplate']);
				}
			}
		}

		/**
		 * getAdminTemplate loads the admin template if template checks pass
		 * @param void
		 * 
		 * @return void 
		 */
		public static function getAdminTemplate()
		{
   
			if(!isset($_GET['previewtemplate'])){
				if(isset($_COOKIE['admintemplate']) && self::checkTemplate($_COOKIE['admintemplate'])){
					self::setTemplate($_COOKIE['admintemplate']);
				}
			}
		}
				
		/**
		 * setTemplate
		 * @param string template name
		 */
		public static function setTemplate($template)
		{
		    Configuration::set('theme',$template);
		}

		/**
		 * getTemplates
		 * @param none
		 * @return array of template name bool False if unable to read template directory
		 */
		public static function getTemplates()
		{

			$templates = array();
			$tmpfile = null;
			
			
			if ($dir = @opendir(Configuration::get('templates_path'))) {

		        while (false !== ($tmpfile = readdir($dir))){

		       		if(self::checkTemplate($tmpfile) && $tmpfile !='.' && $tmpfile !='..' && $tmpfile !='.svn' && $tmpfile !='default'){
		        		$templates[] = $tmpfile;
		        	}
		        }

		        return $templates;
			}else{
				return false;
			}
		}

		/**
		 * checkTemplate
		 * @param string template name
		 * @return bool
		 */
		public static function checkTemplate($template)
		{

			$page = 'page.html';
			$css = 'style.css';
			$valid = false;

			if(is_file(Configuration::get('templates_path').$template.'/'.$page) && is_readable(Configuration::get('templates_path').$template.'/'.$page) && is_file(Configuration::get('templates_path').$template.'/'.$css) && is_readable(Configuration::get('templates_path').$template.'/'.$css)){

				if(is_file(Configuration::get('templates_path').$template.'/functions.php') && is_readable(Configuration::get('templates_path').$template.'/functions.php')){
					$fp=fopen(Configuration::get('templates_path').$template.'/functions.php', 'r');
					$templateFunctions = fread($fp, filesize(Configuration::get('templates_path').$template.'/functions.php'));
					fclose($fp);
					preg_match('/sgs_version(\s*?=\s*?)("|\')(.*?)("|\');/si', $templateFunctions, $compat);
				}else{
					$compat = NULL;
				}
	
				if(isset($compat[3]) && $compat[3] >= Configuration::get('sgs_version')){
					$valid = true;
				}
			}
			
			return $valid;
		}


}
?>