<?php
/**
 * Site Parse, for use in site level xhtml parse functions.
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
 * Class Site Parse XML.
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

class Site_Parse {

    /**
     * _tags
     * @var array $_tags parse tags
     */
    public static $_tags = array();
    
    /**
     * _vars
     * @var array $_vars runtime parse keys and vars
     */
    public static $_vars = array();
    
    public static $style;
    
    /**
     * _startTag
     * @var string _startTag pre var tag
     */
    public static $_startTag = "{";
    
    /**
     * _stopTag
     * @var string $_stopTag post var tag
     */
    public static $_stopTag = "}";
    
    /**
     * template
     * @var array $template loaded templates
     */
    public static $template = array();
    
    /**
     * games
     * @var array $gamelist custom loaded game archive
     */
     public static $gamelist = array();
    
    /**
     * loadgame
     * @var array $loadgame custom loaded games
     */
     public static $loadgame = array();
    
    /**
     * _main
     * @var string $_main main page content retrived from output buffer
     */
    public static $_main;
    
    /**
     * _showDebug
     * @var bool $_showDebug TRUE | FALSE
     */
    public static $_showDebug;
    
    /**
     * parsed
     * @var string $parsed parsed html
     */
    public static $parsed = '';
    
    /**
     * moduleconfig
     * @var array $moduleconfig module array
     */
    
    public static $moduleconfig;
    /**
     * Site_Parse
     *
     * Class Constructor
     *
     * @param array $options keys [ _showDebug (enable / disable debug output) ]
     *
     * @return void
     */
    
    
    
    public static $setCount = 0;
    
    /**
     * set
     * used to set class variables
     *
     * @param string $var variable to set
     * @param mixed $value value of the variable
     * @param string $key optional, if the variable is within an array it's key is passed to access it.
     * @return void
     */
    public static function set($var,$value,$key=NULL)
    {
    	if (!isset($key)) {
            self::$$var = $value;
        } else {
            self::$$var = array_merge(self::$$var,array($key=>$value));
        }
    }
    
    /**
     * get
     * @param string $var
     * @return mixed value
     * 
     * @test to see if this is ever used
     */
    function get($var)
    {
    	return self::$$var;
    }
    
    /**
     * setparsetags
     *
     * @param string $startTag set pre tag
     * @param string $stopTag set post tag
     * @return bool
     */
    public static function setParseTags($startTag=NULL,$stopTag=NULL)
    {
    	if(!isset($startTag) && !isset($stopTag)){
    		return FALSE;
    	}else{
    		self::set('_startTag',$startTag);
    		self::set('_stopTag',$stopTag);
    		return TRUE;
    	}
    }
    
    /**
     * setTag
     * used to bind data to a parsetag
     * @param string $tagname name of tag
     * @param string $data data to replace tag on parse execution
     * @return void
     */
    public static function setTag($tagname, $data)
    {
    	
    	self::set('_tags',array('tag'=>strtoupper($tagname),'data' =>$data),strtoupper($tagname));
    	
    }
    
    /**
     * @param none
     * @return array
     */
    public static function displayTags()
    {
    	return print_r(self::$_tags);
    }
    
    /**
     * removeTag
     * used to remove a preset tag from memory
     * @param string $tagname name of tag
     * @return void
     */
    public static function removeTag($tagname)
    {
    	unset(self::$_tags[strtoupper($tagname)]);
    }
    
    /**
     * cleartags
     * used to remove all preset _tags from memory
     */
    public static function cleartags()
    {
    	self::$_tags = array();
    }
    
    /**
     * clearvars
     * used to remove all preset _vars from memory
     * @param none
     * @return void
     */
    public static function clearvars()
    {
    	self::$_vars = array();
    }
    
    /**
     * set_template
     * @param string $template html source
     * @param string $name reference name for the template
     */
    public static function set_template($template, $name)
    {
    	self::$template[$name] = $template;
    }
    
    /**
     * is_template
     * @param string $name
     * @return bool
     */
    public static function is_template($name)
    {
    	if(isset(self::$template[$name])){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    /**
     * eval_template
     * @param string $name name of loaded template
     * @param string/array $code parse tags you wish to search
     * @return bool
     */
    
    public static function eval_template($name,$code)
    {
    	if(isset(self::$template[$name])){
    
    		if(is_array($code)){
    			foreach($code as $tag){
    				if(sgs_eregi($tag, self::$template[$name])){
    					return true;
    				}
    			}
    		}else if(sgs_eregi($code, self::$template[$name])){
    			return true;
    		}else{
    			return false;
    		}
    
    	}else{
    		return false;
    	}
    }
    
    /**
     * parse_codes
     *
     * @param string $source html to parse
     * @return parsed html
     */
    public static function parse_codes($source)
    {
    	$parsed = "";
    
    	$tmp = explode("\n", $source);
    	foreach($tmp as $line) {
    		if (preg_match("/{.+?}/", $line, $match)) {
    				$parsed .= preg_replace_callback("#\{(\S[^\x02]*?\S)\}#", array('self', 'do_code'), $line);
    		} else {
    			$parsed .= $line."\n";
    		}
    	}
    
    	return $parsed;
    }
    
    
    /**
     * do_code
     * callback function for parse_codes
     *
     *
     * @param array $matches matched parse tag
     * @return string parsed tag data
     */
    public static function do_code($matches)
    {
    
    	if (strpos($matches[1], '=')){
    		list($code, $param) = explode("=", $matches[1], 2);
    		$param = trim($param);
    	}else{
    		$code = $matches[1];
    		$param = '';
    	}
    	if($code == 'RSSLINK'){
    
    		if(is_file(Configuration::get('module_path').'rss/module.php') && is_readable(Configuration::get('module_path').'rss/module.php')){
    
    			require_once(Configuration::get('module_path').'rss/module.php');
    
    			if(function_exists('rsslink')){
    				return rsslink();
    			}
    		}
    
    	}else if($code =='DISPLAYTAGS'){
    		return $this->displayTags();
    	}else if($code == 'MODULE' && isset($param)){
    
  	
    		$module = Configuration::get('module_path').$param.'/menu_'.$param.'.php';
    		 
    		if(sgs_eregi('pmodules',SGS_PAGE)){
    			return '[MODULE '.$param.']<br />';
    		}else if($module = Site_Modules::loadModule($module,$param)){
    		    
    		   
    			return self::parse_codes($module);
    		}else{
    			return false;
    		}
    
    	}else if($code == 'MODULEAREA' && isset($param)){
    
    		if(!isset(self::$moduleconfig) && !is_array(self::$moduleconfig)){
    			self::$moduleconfig = Site_Modules::loadConfig();
    		}
    
    		if(sgs_eregi('pmodules',SGS_PAGE)){
    			$modules = '[MODULEAREA '.$param.']<br />';
    		}else{
    			$modules = '';
    		}
    
    		if(isset(self::$moduleconfig[PAGETEMPLATE][$param]) && is_array(self::$moduleconfig[PAGETEMPLATE][$param])){
    
    			foreach(self::$moduleconfig[PAGETEMPLATE][$param] as $module=>$info){
    				$order[$module] = $info['order'];
    			}
    
    			if(isset($order) && is_array($order)){
    				array_multisort($order,SORT_ASC, SORT_NUMERIC, self::$moduleconfig[PAGETEMPLATE][$param]);
    			}
    
    			$order = 1;
    
    			foreach(self::$moduleconfig[PAGETEMPLATE][$param] as $module=>$info){
    
    				if(sgs_eregi('pmodules',SGS_PAGE)){
    
    					$modules .= self::render_content($module, Site_Modules::moduleEdit($param,$module,$order,self::$moduleconfig),$module,'',TRUE);
    
    				}else{
    
  				    
    					$moddir = explode('_',$module);
    					$module = Configuration::get('module_path').$moddir[0].'/menu_'.$module.'.php';
                        
    					if($module =Site_Modules::loadModule($module,$moddir[0])){
    						$modules .=self::parse_codes($module);
    					}
    
    				}
    
    				$order++;
    			}
    		}
    
    		return $modules;
    
    	}else if($code == 'THEMEMODULE' && isset($param)){
    
    		$module = Configuration::get('theme_path').'menu_'.$param.'.php';
    		
            $fname = Configuration::get('theme').'_menu_'.$param.'.php';
    		
    		if(sgs_eregi('pmodules',SGS_PAGE)){
    
    			return '[THEMEMODULE '.$param.']<br />';
    
    		}else if($module = Site_Modules::loadModule($module,$fname)){
    
    			return self::parse_codes($module);
    
    		}
    
    		return false;
    
    
    	}else if($code == 'SETSTYLE' && isset($param)){
    		/**
    		 * set style
    		 * sets the current render style
    		 */
    		self::setstyle($param);
    		return ''; /** clear SETSTYLE */
    	}else if($code =='MAINNAV'){
    		if(sgs_eregi('pmodules',SGS_PAGE)){
    			return '[MAINNAV]';
    		}else{
    			return self::parse_codes(Site_MainNavigation::render());
    		}
    	}else if($code =='GAMENAV'){
    		if(sgs_eregi('pmodules',SGS_PAGE)){
    			return '[GAMENAV]';
    		}else{
    			return self::parse_codes(Site_Navigation::nav(defined('GAMENAV_AMOUNT') ? array('return'=>GAMENAV_AMOUNT) :''));
    		}
    	}else if(array_key_exists($code, self::$_tags)){
    		
    		return self::$_tags[$code]['data'];
    	}else if(array_key_exists($code, self::$_vars)){
    		
    		return self::$_vars[$code];
    		
    	}
    				
    }
    
    /**
     * parse_layout
     *
     * @param string $source html to parse
     * @param array $vars parsecode name and data to replace (optional)
     * example: array('GAMENAME'=>'game title');
     *
     * @return parsed html source
     */
    public static function parse_layout($source,$vars)
    {

        if(!is_array($vars) || (count($vars)<=0)){
            return self::parse_codes($source);
    	}else{
    	    
    		self::$_vars = array_change_key_case($vars, CASE_UPPER);
    		
    		$content = self::parse_codes($source);
    		self::clearvars();
    		return $content;
    
    	}
        
    }
    
    /**
     * load_template
     *
     * @param string $template path to template
     * @param string $name (optional)reference name for the template.
     * 	if no name is passed the source will be returned and future calls for this template will not be allowed.
     *
     * @return bool for named template (TRUE | FALSE) string html on none named template
     */
    public static function load_template($template, $name)
    {
    	if(!is_file($template) || !is_readable($template) || ( !$templateSrc = file_get_contents($template,TRUE) ) ){				
    		return false;
    	}
    
    	if(!$name){			
    		return $templateSrc;				
    	}
    	
    	self::set_template($templateSrc, $name);
    	return true;
    }
    
    public static function unload_template($name)
    {
    	if(isset(self::$template[$name])){
    		unset(self::$template[$name]);
    	}
    
    }
    
    /**
     * render_template
     *
     * @param string $template name of loaded template
     * @param array $vars parsecode name and data to replace
     * @param bool (true = return parsed layout | false = echo parsed layout)
     * @return string|false parsed template or error
     */
    public static function render_template($template,$vars,$return = false)
    {
    	if(!$template || !array_key_exists($template, self::$template) || !isset(self::$template[$template]) ){				
    		return false;
    	}			
    		
    	if ($return == true) {
    		return self::parse_layout(self::$template[$template],$vars);
    		
    	}else{
    	   
    		echo self::parse_layout(self::$template[$template],$vars);
    	}
    	
    }
    
    /**
     * render_content
     * @param string $caption
     * @param string $text
     * @param string $id
     * @param string $class
     * @param bool $return
     *
     * @return string|void
     */
    public static function render_content($caption, $text, $id='', $class='', $return=false)
    {
    
    	if(!isset(self::$style)){
    		if(!defined('MAINSTYLE')){
    			self::setstyle('default');
    		}else{
    			self::setstyle(MAINSTYLE);
    		}
    	}
    				
    	ob_start();
    	if(!function_exists('contentstyle')){
    		$this->contentstyle($caption, $text, $id, $class, isset(self::$style) ? self::$style : '');
    	}else{
    		call_user_func('contentstyle', $caption, $text, $id, $class, isset(self::$style) ? self::$style : '');
    	}
    	
    	$content= ob_get_contents();
    	ob_end_clean();
    	
    	if($return){
    	    return $content;
    	}
    	
    	echo $content;
    	
    }
    /**
     * @param string $caption
     * @param string $text
     * @param string $id
     * @param string $class
     * @param string $style
     *
     * @return void
     */
    public static function contentstyle($caption, $text, $id='', $class='', $style='')
    {	    
    	echo '<div'.($id !='' ? ' id="'.$id.'"' : '').($class !='' ? ' class="'.$class.'"' : '').'>'."\n";
    
    	if($caption){
    		echo '<h4>'.$caption.'</h4>'."\n";
    	}
    	if($text){
    		echo $text."\n";
    	}
    	echo '</div>'."\n";
    }
    
    /**
     *
     * @param string $style
     * @return void
     */
    public static function setstyle($style)
    {
    	self::$style = $style;
    	self::setTag('STYLE', $style);
    }
    
    /**
     * @param string $cssclass
     * @return void
     */
    public static function setcssclass($cssclass)
    {
    	self::$cssclass = $cssclass;
    	self::setTag('CSSCLASS', self::$cssclass);
    }
    
    /**
     * setcssid
     * set the current menu id parsetag
     *
     * @param string $cssid
     * @return void
     */
    public static function setcssid($cssid)
    {
    	self::$cssid = $cssid;
    	self::setTag('CSSID', self::$cssid);
    }
    
    /**
     * setcaption
     *
     * used to set custom page captions
     * @param string $caption
     * @return void
     */
    public static function setcaption($caption)
    {
    	self::$caption = $caption;
    }
    
    /**
     * page_start
     *
     * start our page render, begin output buffer and mark current time.
     * @param bool $cacheable is this view $cacheable defaults to true.
     * @return void
     */
    public static function page_start($cacheable=true)
    {
       
        Site_PageCache::$cacheable = $cacheable;
        
    	if(method_exists('Timer','mark')){
    		Timer::mark(SGS_PAGE);
    	}

        ob_start();
    	/**
    	 * check for page cache only if we are not in the admin area
    	 */
    
        Site_PageCache::retrievePage();
    	
    }
    
    /**
     * page_end
     *
     * get buffer contents, load and render page template.
     * @param void
     * @return void
     */
    public static function page_end()
    {
    	self::$_main = ob_get_contents();
    
    	ob_end_clean();

    	if(defined('ADMINDISPLAY') && ADMINDISPLAY == TRUE){
    		
    		if(!self::is_template('admin')){
    			/**
    			 * No admin override template has been loaded by the user so we'll load one for them.
    			 * First we'll attempt to load a custom layout for the current page if that fails
    			 * We will check for the theme default admin layout.
    			 */
    		    
    			if(is_file(Configuration::get('theme_path').'admin_'.(str_replace('.php', '', SGS_PAGE)).'.html') && is_readable(Configuration::get('theme_path').'admin_'.(str_replace('.php', '', SGS_PAGE)).'.html')){
    				self::load_template(Configuration::get('theme_path').'admin_'.(eregi_replace('.php', '', SGS_PAGE)).'.html','admin');
    			}else if(!self::load_template(Configuration::get('theme_path').'admin.html','admin')){
    				/**
    				 * If custom and defult theme admin layouts failed we'll load the core admin layout.
    				 */
    				self::load_template(Configuration::get('admin_base_url').'admin.html','admin');
    			}
    		}
    
    		self::render_template('admin',array('MAIN'=>self::$_main));
    
    	}else{
    		/** we are in game mode */
    		if(!self::is_template('page')){
    			/**
    			 * No page override template has been loaded by the user so we'll load one for them.
    			 * First we'll attempt to load a custom page layout if it fails attempt to load the theme default page layout.
    			 */
    			if(is_file(Configuration::get('theme_path').'page_'.(str_replace('.php', '', SGS_PAGE)).'.html') && is_readable(Configuration::get('theme_path').'page_'.(str_ireplace('.php', '', SGS_PAGE)).'.html')){
    				define('PAGETEMPLATE', 'page_'.(str_replace('.php', '', SGS_PAGE)));
    				self::load_template(Configuration::get('theme_path').'page_'.(str_ireplace('.php', '', SGS_PAGE)).'.html','page');
    			}else if(!self::load_template(Configuration::get('theme_path').'page.html','page')){
    				/**
    				 * If custom and defult (page)layouts from the current theme failed we'll attempt to load the default themes page.html
    				 */
    				self::load_template(Configuration::get('default_theme_path').'page.html','page');
    			}
    
    			if(!defined('PAGETEMPLATE')){
    				define('PAGETEMPLATE', 'page');
    			}
    		}
    		
    		if(method_exists('Timer','retrieve')){
    		    self::setTag('RENDERTIME', ' Page was created in ' .Timer::retrieve(SGS_PAGE). ' seconds.');
    		}
    		
    		if(method_exists('File','bytesToReadableSize')){
    		    self::setTag('MEMORYUSAGE', ' Memory usage ' .File::bytesToReadableSize(self::pageMemory()));
    		}
    	
    		Site_PageCache::cachePage();
    		
    		self::render_template('page',array('MAIN'=>self::$_main));
    		
    	}
    
    	//Timer::retrieve('realtime');
    }
    
    /**
     * pageMemory
     *
     * @param bool $real_usage Set this to TRUE to 
     *        get the real size of memory allocated 
     *        from system. If not set or FALSE only 
     *        the memory used by emalloc() is reported. 
     *
     * @return int the amount of memory, in bytes
     */
    
    public static function pageMemory($real_usage = false)
    {
        if (function_exists('memory_get_usage')) {
            return memory_get_usage($real_usage);
        }
        return 0;
    }

}
?>