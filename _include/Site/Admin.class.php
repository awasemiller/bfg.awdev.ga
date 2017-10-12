<?php
/**
 * Site Admin Class, used to create navigation and page rendering for the administration area.
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
 * @category  Framework
 * @package PNP Tools
 * @subpackage SGS
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 1.0
 * @link      https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Class Site_Admin.
 *
 * @category  Framework
 * @package PNP Tools
 * @subpackage SGS
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 1.0
 * @link      https://affiliates.bigfishgames.com/tools/sgs/
 */
class Site_Admin {

		/**
		 * adminLogin
		 */
		public static function adminLogin()
		{
			Site_Parse::render_content(Site_Language::display('admin_signin'), Site_Auth::loginForm(),'admin_login');
		}

		/**
		 * navLinks
		 */
		public static function navLinks($name='adminnav',$navItems=array())
		{
			$links ='';
			if(count($navItems)<=0 || $navItems ==''){
				$navItems = array(
					array('query'=>'','text'=>Site_Language::display('admin_navlinks_main'),'url'=>Configuration::get('admin_base_url').'admin.php'),
					array('query'=>'','text'=>Site_Language::display('admin_navlinks_site_settings'),'url'=>Configuration::get('admin_base_url').'siteconfig.php'),
					array('query'=>'view','text'=>Site_Language::display('admin_navlinks_custom_pages'),'url'=>Configuration::get('admin_base_url').'custompage.php'),
					array('query'=>'modules','text'=>Site_Language::display('admin_navlinks_modules'),'url'=>Configuration::get('admin_base_url').'modules.php'),
					array('query'=>'general','text'=>Site_Language::display('admin_navlinks_php_info'),'url'=>Configuration::get('admin_base_url').'info.php'),
					array('query'=>'','text'=>Site_Language::display('admin_navlinks_leave_admin'),'url'=>SGS_BASE_URL.'index.php'),
					array('query'=>'logout','text'=>Site_Language::display('admin_navlinks_logout'),'url'=>SGS_BASE_URL.'index.php')

				);
			}

			if(!defined('PRE_'.strtoupper($name).'_LINKS')){
				define('PRE_'.strtoupper($name).'_LINKS', '<ul>');
				define('POST_'.strtoupper($name).'_LINKS', '</ul>');
				define('PRE_'.strtoupper($name).'_LINK', '<li>');
				define('POST_'.strtoupper($name).'_LINK', '</li>');
				define(strtoupper($name).'_ICON','');
				define(strtoupper($name).'CLASS', 'button');
				define(strtoupper($name).'CLASS_SEL', 'current');
				define(strtoupper($name).'CLASS_LAST', 'lasts');
			}

			$i=1;
			/** get the total count in order to set the last class if required */
			$lastlink = count($navItems);
			$links = defined('PRE_'.strtoupper($name).'_LINKS') ? constant('PRE_'.strtoupper($name).'_LINKS')."\n" : '';

			foreach($navItems as $item){

				if($item['query'] !='default' && (!isset($item['nolink']) || $item['nolink'] != true)){
					
					$adminnavclass = defined(strtoupper($name).'CLASS') ? constant(strtoupper($name).'CLASS') : '';
					/** base admin pages have urls so we'll do an additional check for page and query */
					if(isset($item['url'])){
						
						/** check for module selection */
						$adminnavclass_sel = (sgs_eregi(SGS_PAGE,$item['url']) && SGS_QUERY == $item['query']) ? ' '.(defined(strtoupper($name).'CLASS_SEL') ? constant(strtoupper($name).'CLASS_SEL') : '') : '';
					}else{
						$adminnavclass_sel = (SGS_QUERY == $item['query']) ? ' '.(defined(strtoupper($name).'CLASS_SEL') ? constant(strtoupper($name).'CLASS_SEL') : '') : '';


					}
					$linkclass_last = ($lastlink == $i && defined(strtoupper($name).'CLASS_LAST')) ? ' '.constant(strtoupper($name).'CLASS_LAST') : '';
					$class = $adminnavclass.$adminnavclass_sel.$linkclass_last;
					$pre_adminnav = (defined('PRE_'.strtoupper($name).'_LINK') && constant('PRE_'.strtoupper($name).'_LINK') !='') ? substr(constant('PRE_'.strtoupper($name).'_LINK'),0,-1).' class="'.$class.'">' : '';
					$post_adminnav = ($pre_adminnav != '') ? (defined('POST_'.strtoupper($name).'_LINK') ? constant('POST_'.strtoupper($name).'_LINK') : '') : '';
					$links .= $pre_adminnav.'<a '.($pre_adminnav == '' ? 'class="'.$class.'"' : '').' href="'.(isset($item['url']) ? $item['url'] : SGS_PAGE).($item['query'] !='' ? '?' : '').''.$item['query'].'">'.$item['text'].'</a>'.$post_adminnav."\n";
				}

				$i++;
			}

			$links .= defined('POST_'.strtoupper($name).'_LINKS') ? constant('POST_'.strtoupper($name).'_LINKS')."\n" : '';
			return  Site_Parse::parse_layout($links,'');
		}

		/**
		 * mainLinks
		 */
		public static function mainLinks($main)
		{

			define('ADMINCOLUMNS', '2');

			$default = array_shift($main);
			$total_pages = count($main);

			$pageList = array_chunk($main, ceil($total_pages / ADMINCOLUMNS));

			array_unshift($pageList,$default);
			$pageList = array_reverse($pageList, true);
			array_pop($pageList);
			$pageList = array_reverse($pageList, true);
			/**
			 *  Add extra blank spaces to un-equal arrays.
			 */
			if(is_array($pageList)){
				foreach($pageList as $key=>$value){
						while(count($pageList[1])-count($pageList[''.$key.'']) != 0){
						array_push($pageList[''.$key.''],array('query'=>'#','text'=>'&nbsp;','description'=>'&nbsp;','author'=>'&nbsp;','version'=>'&nbsp;'));
					}
				}
			}

			if(defined('TABLE_OPEN')){
				$text = TABLE_OPEN;
			}else{
				$text = '<table  class="tablecontent" cellpadding="0" cellspaceing="0">'."\n";
			}

			if(defined('ODD_CLASS') && defined('EVON_CLASS')){
				$class = EVON_CLASS;
				$evon = EVON_CLASS;
				$odd = ODD_CLASS;
			}else{
				$class = 'evon';
				$evon = 'evon';
				$odd = 'odd';
			}

			$mywidth = '';



			foreach($pageList[1] as $key=>$column){
				$class = ($class == $odd ? $evon : $odd);
				for($i=1; $i<=ADMINCOLUMNS;$i++){

					if(!defined('PRE_COLUMN_'.$i)){
						define('PRE_COLUMN_'.$i, ($i == 1) ? str_replace('TDVAR', 'style="width:'.round(100/ADMINCOLUMNS).'%"', '<tr class="{CLASS}">'."\n".'<td TDVAR>'."\n") : str_replace('TDVAR', 'style="width:'.round(100/ADMINCOLUMNS).'%"', "\n".'<td TDVAR>'."\n"));
					}

					if(!defined('POST_COLUMN_'.$i)){
						define('POST_COLUMN_'.$i,($i == 1 && ADMINCOLUMNS !=1) ? '</td>'."\n" : (($i != ADMINCOLUMNS) ?  '</td>'."\n" : "\n".'</td>'."\n".'</tr>'."\n"));
					}

					if($pageList[$i][$key]['query'] == '#' && $pageList[$i][$key]['text'] =='&nbsp;' && $pageList[$i][$key]['description'] =='&nbsp;'){
						$text .= str_replace('{CLASS}', $class, constant('PRE_COLUMN_'.$i)).'&nbsp;'.constant('POST_COLUMN_'.$i);
					}else{
					    
					    $author = ((isset($pageList[$i][$key]['author']) && $pageList[$i][$key]['author'] !='&nbsp;') ? '<br />Author: '.$pageList[$i][$key]['author'] : '');
					    $version = ((isset($pageList[$i][$key]['version']) && $pageList[$i][$key]['version'] !='&nbsp;') ? '<br />Version: '.$pageList[$i][$key]['version'] : '');
					    
					    
						$text .= str_replace('{CLASS}', $class, constant('PRE_COLUMN_'.$i)).Site_Elements::anchorTag((isset($pageList[$i][$key]['page']) ? $pageList[$i][$key]['page'] : SGS_SELF).((isset($pageList[$i][$key]['query']) && $pageList[$i][$key]['query'] !='default') ? '?'.$pageList[$i][$key]['query'] : '' ), self::checkIcon($pageList[$i][$key]['icon']).$pageList[$i][$key]['text']).'<br />'.$pageList[$i][$key]['description'].$author.$version.constant('POST_COLUMN_'.$i);
					}
				}
			}

			if(defined('TABLE_CLOSE')){
				$text .= TABLE_CLOSE;
			}else{
				$text .= '</table>'."\n";
			}

			return $text;
		}

		/**
		 * messages
		 */
		public static function messages($message)
		{
			global $error;

			if(is_array($message) && count($message) >=1){

				$messages = '<div class="'.($error ? 'error' : 'success').'">';
				$messages .= '<h4>'.(($error == TRUE) ? Site_Language::display('admin_error') : Site_Language::display('admin_success')).'</h4>';
				foreach($message as $text){
					$messages .= '<p>'.$text.'</p>';
				}
				$messages .='</div>';
			}else{
				$messages = '';
			}

			return $messages;
		}

		/**
		 * checkIcon
		 */
		public static function checkIcon($image)
		{
			return Site_Elements::imageTag($image, $alt='', $id='', $class='', $height='', $width='', $js='', $longdesc='').'&nbsp;';
		}
		/**
		 * renderAdmin
		 *
		 */
		public static function renderAdmin($pages=array(),$text,$sidebar='',$scaption='')
		{
			if(is_array($pages)){
				foreach($pages as $key=>$value){

					if(sgs_eregi('=',$value['query'])){
						$query = explode('=',$value['query']);
						$value['query'] = $query[0];
					}

					$captions[$value['query']] = $value['text'];
				}
			}

			if(sgs_eregi('=',SGS_QUERY)){
				$query = explode('=',SGS_QUERY);
				$query = $query[0];
			}else{
				$query = SGS_QUERY;
			}

			/** menus */
			Site_Parse::setstyle(defined('ADMINNAV_STYLE') ? ADMINNAV_STYLE : 'default');
			Site_Parse::setTag('adminnav',Site_Parse::render_content(Site_Language::display('admin_renderadmin_menu'), self::navLinks('adminnav',array()), $id='', $class='',TRUE));

			Site_Parse::setstyle(defined('OPTIONSNAV_STYLE') ? OPTIONSNAV_STYLE : 'sidebar');
			/** options */

			if(count($pages)>=2 && !$sidebar){
				Site_Parse::setTag('options',Site_Parse::render_content(Site_Language::display('admin_renderadmin_options'), self::navLinks('optionsnav',$pages), $id='', $class='',TRUE));
			}else{
				Site_Parse::setTag('options',Site_Parse::render_content(isset($scaption) ? $scaption : 'Options scaption', $sidebar, $id='', $class='',TRUE));
			}

			Site_Parse::setstyle(defined('MAIN_STYLE') ? MAIN_STYLE : 'default');

			/** main data */
			Site_Parse::render_content(array_key_exists($query,$captions) ? $captions[''.$query.''] : $captions['default'], $text, $id='', '',FALSE);

			Site_Parse::page_end();
		}
}

?>