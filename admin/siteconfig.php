<?php
/**
 * PNP TOOLS Admin Area siteconfig
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

if(is_file(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_siteconfig.php')){
	Site_Language::loadLanguageFile(Configuration::get('language_path').LOCALE.'/admin/'.LOCALE.'_siteconfig.php');
}else{
	Site_Language::loadLanguageFile(Configuration::get('language_path').'en/admin/en_siteconfig.php');
}

if(!defined('ADMIN_ICONPATH')){
	define('ADMIN_ICONPATH',SGS_BASE_URL.'images/admin/icons/');
}

$message = array();
$update = true;
$error = false;

if(isset($_POST['update'])){
    
	$message = array();
	$update = true;

	Site_PageCache::clear();
	Site_Modules::clear();
    Site_CacheManager::flush('nav');
    
	if(SGS_QUERY =='language'){
		if($_POST['locale'] && in_array($_POST['locale'], array_values(Site_Language::getLocales()))){
			// destroy locale cookie to set default language
			setcookie('locale', $_POST['locale'], (time() - 3600),'/');
			
			Site_Language::loadLanguageFile(Configuration::get('language_path').$_POST['locale'].'/'.$_POST['locale'].'_language.php');
			
		
			if(is_file(Configuration::get('language_path').$_POST['locale'].'/admin/'.$_POST['locale'].'_siteconfig.php')){
				Site_Language::loadLanguageFile(Configuration::get('language_path').$_POST['locale'].'/admin/'.$_POST['locale'].'_siteconfig.php');
			}else{
				Site_Language::loadLanguageFile(Configuration::get('language_path').'en/admin/en_siteconfig.php');
			}
			
		}else{
		    $error = true;
		}
	}	
	
	if(SGS_QUERY=='preferences'){
		/**
		 * check sitename
		 */
		if($_POST['sitename'] ==''){ $error = true; $message[] = Site_Language::display('sitename_blank'); }
		if(strlen(trim($_POST['sitename'])) >= '51'){ $error = true; $message[] = Site_Language::display('sitename_toolong'); }

		/**
		 * check site tag
		 */
		if($_POST['sitetag'] ==''){ $error = true; $message[] = Site_Language::display('sitetag_blank'); }
		if(strlen(trim($_POST['sitetag'])) >= '51'){ $error = true; $message[] = Site_Language::display('sitetag_toolong'); }



	   /* 	if($_POST['siteurl'] ==''){ $error = true; $message[] = 'Site Url can not be blank.'; } */

		if($_POST['disclaimer'] ==''){ $error = true; $message[] = Site_Language::display('disclaimer_blank'); }
	}
	if(SGS_QUERY=='disclaimer'){
		if($_POST['disclaimer'] ==''){ $error = true; $message[] = Site_Language::display('disclaimer_blank'); }
	}
	if(SGS_QUERY=='frontpage'){	}
	if(SGS_QUERY=='metatags'){
		if($_POST['copyright'] ==''){ $error = true; $message[] = Site_Language::display('copyright_blank'); }
		if($_POST['keywords'] ==''){ $error = true; $message[] = Site_Language::display('keywords_blank'); }
		if($_POST['description'] ==''){ $error = true; $message[] = Site_Language::display('desc_blank'); }
	}
	if(SGS_QUERY =='template'){

		if($_POST['theme'] && Site_Template::checkTemplate($_POST['theme'])){
			/**
			 * we'll remove the template cookies if they exists so the admin 
			 * can view the selected site template
			 */
		    Site_Template::unSetUserTemplate(false);
		    Site_Template::unSetAdminTemplate(true);
		    
			/**
			 * module check
			 */
			Site_Modules::checkModuleAreas();
		}else{
			$error = true; $message[] = Site_Language::display('unable_to_save');
		}
	}
	if(SGS_QUERY=='cache'){}
	if(SGS_QUERY=='gameoptions'){

	}
	if(SGS_QUERY=='comments'){}
	if(SGS_QUERY=='pagination'){
		Site_PageCache::clear();
		Site_Modules::clear();
	}

	if(SGS_QUERY =='seo'){ }
	
	
	if($error != true){

		unset($_POST['update']);

		if($tmpsiteconfig = Site_Config::saveConfig($_POST)){
		   Configuration::load(array_merge(Configuration::getAll(),$tmpsiteconfig));
		}
		
		if($config){
			$message[] = Site_Language::display('config_updated');
		}else{
			$error = true;
			$message[] = Site_Language::display('config_failed');
		}
	}

}

function seo_test()
{
	
	$url = SGS_BASE_URL.'test.htm';
	$request = Fetch::getInstance($url,Configuration::get('fetch_method'),Configuration::get('fetch_timeout'));
	$responce = $request->fetch();
	
	if(sgs_eregi('seo_ok',$responce)){
		return true;
	}else{
		return false;
	}
}

$pages = array(
// first element is always default and will be removed from main and options nav
array('query'=>'default','text'=>Site_Language::display('default_text'),'description'=>Site_Language::display('default_description'),'icon'=>ADMIN_ICONPATH.'pathtoimage'),
array('query'=>'preferences','text'=>Site_Language::display('preferences_text'),'description'=>Site_Language::display('preferences_description'),'icon'=>ADMIN_ICONPATH.'preferences.png'),
array('query'=>'frontpage','text'=>Site_Language::display('frontpage_text'),'description'=>Site_Language::display('frontpage_description'),'icon'=>ADMIN_ICONPATH.'frontpage.png'),
array('query'=>'metatags','text'=>Site_Language::display('metatags_text'),'description'=>Site_Language::display('metatags_description'),'icon'=>ADMIN_ICONPATH.'meta.png'),
array('query'=>'template','text'=>Site_Language::display('template_text'),'description'=>Site_Language::display('template_description'),'icon'=>ADMIN_ICONPATH.'template.png'),
array('query'=>'cache','text'=>Site_Language::display('cache_text'),'description'=>Site_Language::display('cache_description'),'icon'=>ADMIN_ICONPATH.'cache.png'),
array('query'=>'gameoptions','text'=>Site_Language::display('gameoptions_text'),'description'=>Site_Language::display('gameoptions_description'),'icon'=>ADMIN_ICONPATH.'gameoptions.png'),
array('query'=>'comments','text'=>Site_Language::display('comments_text'),'description'=>Site_Language::display('comments_description'),'icon'=>ADMIN_ICONPATH.'comments.png'),
array('query'=>'seo','text'=>Site_Language::display('seo_text'),'description'=>Site_Language::display('seo_description'),'icon'=>ADMIN_ICONPATH.'seo.png')
);

if(!Configuration::get('ganenabled')){
    array_push($pages, array('query'=>'language','text'=>Site_Language::display('language_text'),'description'=>Site_Language::display('language_description'),'icon'=>ADMIN_ICONPATH.'language.png'));
}

if(SGS_QUERY !='' && SGS_QUERY !='default'){

	$text = Site_Admin::messages($message);

	Site_Forms::start_form('site_config', SGS_SELF.'?'.SGS_QUERY, 'post');

	Site_Forms::add_plain_html('<table '.(defined('TABLE_CLASS') ? 'class="'.TABLE_CLASS.'"' : '').' cellpadding="0" cellspaceing="0"><tr><td>');

	// GENERAL SITE INFORMATION
	if(SGS_QUERY=='preferences'){

		Site_Forms::add_input_data('sitename', stripslashes(htmlentities(Configuration::get('sitename'))), Site_Language::display('sitename'), "textbox", '50');

		Site_Forms::add_plain_html('</td></tr><tr><td>');

		Site_Forms::add_input_data('sitetag', stripslashes(htmlentities(Configuration::get('sitetag'))), Site_Language::display('sitetag'), "textbox", '50');

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		/* Removed per QA request
		 *
		 *Site_Forms::add_input_data('siteurl', $siteconfig['siteurl'], "Site Url:", "textbox");
		 *Site_Forms::add_plain_html('</div><div>');
		 */

		Site_Forms::add_text_data('disclaimer', stripslashes(htmlentities(Configuration::get('disclaimer'))), Site_Language::display('disclaimer'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
	}

	// DEFAULT PAGE VIEW
	if(SGS_QUERY=='frontpage'){
		Site_Forms::add_input_data('front_page', Configuration::get('front_page'), Site_Language::display('user_defined'), "textbox");

		Site_Forms::add_plain_html('<br /> '.Site_Language::display('must_be_absolute'));

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		
		$custompages = Site_CustomPage::getCustompages();

		$custom[] = 'Index View';
    	function underscoreToLocales($s)
        {
            return $s.'_'; 
        }	
		//$cleanSearch = function($s){ return $s.'_'; };
		
		$search = array_map('underscoreToLocales' , Site_Language::getLocales());
      
        
		foreach($custompages as $page){
			if(sgs_eregi(LOCALE.'_',$page)){
				$custom[] = str_replace($search,'',$page);
			}
		}
		
	    Site_Forms::add_select_item('custom_page', $custom, Configuration::get('custom_page') ? Configuration::get('custom_page') : '', Site_Language::display('default_page'), (Configuration::get('front_page') != '' ? 'textbox-disable' : 'textbox'),(Configuration::get('front_page') != '' ? true : false));

		Site_Forms::add_plain_html((Configuration::get('front_page') != '' ? Site_Language::display('select_default') : '').'</td></tr><tr><td>');
		/**
		 * index requests
		 */

		$items = array();

		$default_index_view = Site_Navigation::load_nav();

		foreach($default_index_view as $view){
			array_push($items,array($view['name']=>$view['linktext']));
		}

		Site_Forms::add_select_item('default_index_view', $items, Configuration::get('default_index_view'), Site_Language::display('index_view'), ((Configuration::get('front_page') != '' || Configuration::get('custom_page') !='Index View') ? 'textbox-disable' : 'textbox'),((Configuration::get('front_page') != '' || Configuration::get('custom_page')  !='Index View') ? true : false));

		Site_Forms::add_plain_html((Configuration::get('front_page') == '' && Configuration::get('custom_page') !='Index View' ? Site_Language::display('select_index') : '').'</td></tr><tr><td>');
	}
	// METATAGS
	if(SGS_QUERY=='metatags'){
		Site_Forms::add_input_data('copyright', Configuration::get('copyright'), Site_Language::display('copyright'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		Site_Forms::add_text_data('description', Configuration::get('description'), Site_Language::display('desc'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		Site_Forms::add_text_data('keywords', Configuration::get('keywords'), Site_Language::display('keywords'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
	}
	// TEMPLATE
	if(SGS_QUERY =='template'){

		$templates = Site_Template::getTemplates();

		$js = '<script>'."\n";
		$js .='	function display(template){'."\n";
		$js .='		document.getElementById("preview").src= "'.Configuration::get('templates_base_url').'"+ template+"/preview.png";'."\n";
		$js .='	}'."\n";
		
		if(Configuration::get('theme') && Configuration::get('theme') !=''){
			$js .='display("'.Configuration::get('theme').'");';
		}else if(isset($templates[0]) && $templates[0] !=''){
			$js .='display("'.$templates[0].'");';
		}
		$js .='</script>'."\n";

		Site_Forms::add_select_item('theme', $templates, Configuration::get('theme'), Site_Language::display('Site_Template'), "textbox",'',' onChange=display(this.value)');

		Site_Forms::add_plain_html('<br /><img id="preview" src="'.Configuration::get('templates_path').'/'.$templates[0].'/preview.png" alt="" />');

		Site_Forms::add_plain_html($js);

		Site_Forms::add_plain_html('</td></tr><tr><td>');
	}
	// CACHE OPTIONS
	if(SGS_QUERY=='cache'){
		Site_Forms::add_select_item('lifetime_cache', array('12','24'), Configuration::get('lifetime_cache'), Site_Language::display('cache_time'), "textbox");
		/* TODO add flash cache back to core?
		Site_Forms::add_plain_html('</td></tr><tr><td>');
		Site_Forms::add_select_item('cache_flash', array(array(false=>'no'),array(true=>'yes')), Configuration::get('cache_flash'), 'Cache Flash:', "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		Site_Forms::add_input_data('memcache_host', isset(Configuration::get('memcache_host')) ? Configuration::get('memcache_host') : '' , "Memcache Host:", "textbox");
		Site_Forms::add_input_data('memcache_port', isset(Configuration::get('memcache_port')) ? Configuration::get('memcache_port') : '', "Memcache Port:", "textbox");
		Site_Forms::add_plain_html('<br /> enter your memcache settings');
		*/
		Site_Forms::add_plain_html('</td></tr><tr><td>');

		$items = array(
			array(1=>'yes'),
			array(0=>'no')

		);
		

		Site_Forms::add_select_item('page_cache', $items, Configuration::get('page_cache')  ? Configuration::get('page_cache') : 0, Site_Language::display('enable_page_cache'), 'textbox');

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		Site_Forms::add_select_item('module_cache', $items, Configuration::get('module_cache')  ? Configuration::get('module_cache') : 0, Site_Language::display('enable_module_cache'), 'textbox');

		Site_Forms::add_plain_html('</td></tr><tr><td>');

	}
	// GAME DISPLAY
	if(SGS_QUERY=='gameoptions'){

		// TO DO add user defined platform option
		/**
		 * Site_Forms::add_select_item('platform', array(array('pc'=>'pc'),array('mac'=>'mac')), Configuration::get('platform'), 'default download platform', "textbox");
		 * Site_Forms::add_plain_html('</td></tr><tr><td>');
		 */
		Site_Forms::add_select_item('feature_flash', array(array(false=>'no'),array(true=>'yes')), Configuration::get('feature_flash'), Site_Language::display('display_flash'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		/**
		 *
		 */
		Site_Forms::add_select_item('browseviewtotal', array('5','10','15','20','25'), Configuration::get('browseviewtotal') ? Configuration::get('browseviewtotal') : '10', Site_Language::display('browse_view'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		Site_Forms::add_select_item('searchviewtotal', array('5','10','15','20','25'),Configuration::get('searchviewtotal') ? Configuration::get('searchviewtotal') : '10', Site_Language::display('search_view'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		/**
		 * altversion
		 */
		Site_Forms::add_select_item('altversion', array(array(false=>'no'),array(true=>'yes')), Configuration::get('altversion'), Site_Language::display('display_alt'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
	}
	// COMMENTS
	if(SGS_QUERY=='comments'){

		Site_Forms::add_select_item('sitecomments', array(array(false=>'no'),array(true=>'yes')), Configuration::get('sitecomments'), Site_Language::display('allow_site_cmt'), "textbox");

		Site_Forms::add_plain_html('</td></tr><tr><td>');
		/**
		 * comment view
		 */
		Site_Forms::add_select_item('commentviewtotal', array('5','10','15','20','25'), Configuration::get('commentviewtotal') ? Configuration::get('commentviewtotal') : '10', Site_Language::display('comment_view'), (Configuration::get('sitecomments') == false ? 'textbox-disable' : 'textbox'),(Configuration::get('sitecomments') == false ? true : false));

		Site_Forms::add_plain_html('</td></tr><tr><td>');

		/**
		 * game comments
		 */
		Site_Forms::add_select_item('gamecomments', array(array(false=>'no'),array(true=>'yes')),(Configuration::get('gamecomments') ? Configuration::get('gamecomments') : 'no'), Site_Language::display('allow_game_cmt'), (Configuration::get('sitecomments') == false ? 'textbox-disable' : 'textbox'),(Configuration::get('sitecomments') == false ? true : false));

		Site_Forms::add_plain_html('</td></tr><tr><td>');


		/**
		 * require name
		 */
		Site_Forms::add_select_item('comments_require_name', array(array(false=>'no'),array(true=>'yes')),(Configuration::get('comments_require_name') ? Configuration::get('comments_require_name') : 'no'), Site_Language::display('name_req'), (Configuration::get('sitecomments') == false ? 'textbox-disable' : 'textbox'),(Configuration::get('sitecomments') == false ? true : false));

		Site_Forms::add_plain_html('</td></tr><tr><td>');


		/**
		 * require email
		 */
		Site_Forms::add_select_item('comments_require_email', array(array(false=>'no'),array(true=>'yes')),(Configuration::get('comments_require_email') ? Configuration::get('comments_require_email') : 'no'), Site_Language::display('email_req'), (Configuration::get('sitecomments') == false ? 'textbox-disable' : 'textbox'),(Configuration::get('sitecomments') == false ? true : false));

		Site_Forms::add_plain_html('</td></tr><tr><td>');

		/**
		 * require url
		 */
		Site_Forms::add_select_item('comments_require_url', array(array(false=>'no'),array(true=>'yes')),(Configuration::get('comments_require_url') ? Configuration::get('comments_require_url') : 'no'), Site_Language::display('url_req'), (Configuration::get('sitecomments') == false ? 'textbox-disable' : 'textbox'),(Configuration::get('sitecomments') == false ? true : false));

		Site_Forms::add_plain_html('</td></tr><tr><td>');
	}

	// PAGINATION
	if(SGS_QUERY=='pagination'){

		/**
		 * moved to game options
		 */
	}

	// DEFAULT LANGUAGE
	if(SGS_QUERY=='language'){

		foreach(array_values(Site_Language::getLocales()) as $language){
			$locales[] = array($language=>Site_Language::display($language));
		}

		Site_Forms::add_select_item('locale', $locales, Configuration::get('locale'), Site_Language::display('default_lang'), "textbox");
		Site_Forms::add_plain_html('</td></tr><tr><td>');		Site_Forms::add_select_item('mulitilanguage', array(array(false=>'Disable'),array(true=>'Enable')), Configuration::get('mulitilanguage'), Site_Language::display('multi_lang'), "textbox");
		Site_Forms::add_plain_html('</td></tr><tr><td>');
	}
	// SEO
	if(SGS_QUERY=='seo'){

		if(seo_test()){
			Site_Forms::add_select_item('seo', array(array(false=>'Disable'),array(true=>'Enable')), Configuration::get('seo'), Site_Language::display('seo_option'), "textbox");
		}else{
			Site_Forms::add_plain_html(Site_Language::display('seo_unavailable'));
		}
		Site_Forms::add_plain_html('</td></tr><tr><td>');
	}
	// SUBMIT BUTTON
	Site_Forms::add_hidden_data('update', 'true');
	Site_Forms::add_button('submit', Site_Language::display('button_submit'), 'submit', 'button');

	Site_Forms::add_plain_html('</td></tr></table>');

	$text .= Site_Forms::return_form();
}else{
	$text = Site_Admin::mainLinks($pages);
}





Site_Admin::renderAdmin($pages,$text);

?>