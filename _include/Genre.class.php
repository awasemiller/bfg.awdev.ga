<?php
/**
 * Genre
 * 
 * @category  Framework
 * @package   Simple_XML
 * @author    William Moffett <william.moffett@bigfishgames.com>
 * @copyright 2007-2011 Big Fish Games, Inc.
 * @license   http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version   Release: 0.3.0
 * @link      https://affiliates.bigfishgames.com/tools/xml/#Simple%20XML%20Library
 */
class Genre
{
    
    protected static $genreList = array();
    
    protected static $locale = 'en';
    
    public function __construct()
    {
        
    }

    public static function setLocale($locale)
    {
        
        if (Game_Locales::isValidLocale($locale)) {
            self::$locale = $locale;
        }
        
    }

    public static function isValidGenreID($id)
    {
        
        return is_array(self::getGenreInfoByID($id)) ? true : false;
        
    }

    public static function isValidGenreSname($sname)
    {
        
        return is_array(self::getGenreInfoBySname($sname)) ? true : false;
        
    }
    
    public static function getGenreInfoBySname($sname)
    {
        self::_loadGenre();
        
        $genreList = self::$genreList[self::$locale];
        
        if (!is_array($genreList)) {
            return false;
        } 
           
        foreach($genreList as $key=>$genre)
        {
                
            if (isset($genre['sname']) && $genre['sname']==$sname) {
                
                return $genre;
            }
        }
        
        return false;
    }
    
    
    public static function getGenreInfoByID($id)
    {
         
        self::_loadGenre();
        
        $genreList = self::$genreList[self::$locale];
        
        if (!is_array($genreList)) {
            return false;
        } 
           
        foreach($genreList as $key=>$genre)
        {
                
           
            if (isset($genre['genreid']) && intval($genre['genreid'])==intval($id)) {
                
                return $genre;
            }
            
        }

        return false;
    }

    public static function getGenreNameBySname($sname)
    {
        
        $genre = self::getGenreInfoBySname($sname);
        
        return isset($genre['name']) ? $genre['name'] : false;
        
       
    }    
    
    public static function getPrimaryGenreList()
    {
        
        self::_loadGenre();
        
        $genreList = self::$genreList[self::$locale];
        
        if (!is_array($genreList)) {
            return false;
        } 

        $out = array();
        
        foreach($genreList as $key=>$genre)
        {
                
            if (isset($genre['ispri']) && $genre['ispri']=='yes') {
                
                $out[] = $genre;
            }
        }

        return $out;
        
    }    

    public static function getGenreList()
    {
        self::_loadGenre();
        
        $genreList = self::$genreList[self::$locale];
        
        if (!is_array($genreList)) {
            return array();
        }

        return $genreList;
    }    
    
    public static function getPrimaryGenreListSnames()
    {

        self::_loadGenre();
        
        $genreList = self::$genreList[self::$locale];
        
        if (!is_array($genreList)) {
            return array();
        } 

        $out = array();
        
        foreach($genreList as $key=>$genre)
        {
                
            if (isset($genre['ispri']) && 
                $genre['ispri']=='yes' &&
                isset($genre['sname'])
                ) {
                
                $out[] = $genre['sname'];
            }
        }
        
        return $out;
        
    }  

    public static function getGenreListSnames()
    {
        self::_loadGenre();
        
        $genreList = self::$genreList[self::$locale];
        
        if (!is_array($genreList)) {
            return array();
        }
        
        $out = array();
        
    	foreach($genreList as $key=>$genre)
	    {
	        if(isset($genre['sname'])){	    
	            $out[] = $genre['sname'];
	        }
	    }
	    
        return $out;
    }     
    /**
     * 
     * Enter description here ...
     */
    private static function _loadGenre()
    {
        
        if (isset(self::$genreList[self::$locale]) && count(self::$genreList[self::$locale]) > 0)
        {
            return null;
        }
       
        $url = Parsing::ParseTemplate(
                                Configuration::get('genre_xml_request'),
                                array(
                                    'xml_server'=>Configuration::get('xml_server'),
                                    'locale'=>self::$locale
                                )
                            );
        $name = md5($url);
        
        $sc = new Cache();
                
        $sc->setFile($name,$options=array('ext'=>'db', 'serialize'=>true,'lifetime'=>Configuration::get('lifetime_cache_genre')));
        /**
         * @todo var out the request method
         *
         */
      
        if ($sc->needNewFile($name)) {
         
            $curl = Fetch::getInstance($url, Configuration::get('fetch_method'), Configuration::get('fetch_timeout'));
            
            $genre = $curl->fetch();
             
            $genre = XML::parse($genre);
          
           
			
            if(!is_array($genre)){
            	
            	/**
				 * @todo message admin unable to fetch new feed
            	 */
            	
            	$genre =$sc->load($name);
            	
              	if(!$genre){
                	return array();
                }
            	
            	return $genre;
            }
            
            if (is_array($genre)) {
            	
				$genre[] = array('name'=>Site_Language::display('genre_info_253_caption'),'sname'=>'all','description'=>Site_Language::display('genre_info_253_text'));
				$genre[] = array('name'=>Site_Language::display('genre_info_254_caption'),'sname'=>'glrelease','description'=>Site_Language::display('genre_info_254_text'));
				$genre[] = array('name'=>Site_Language::display('genre_info_255_caption'),'sname'=>'glrank','description'=>Site_Language::display('genre_info_255_text'));
				$genre[] = array('name'=>Site_Language::display('genre_info_256_caption'),'sname'=>'glreleaseog','description'=>Site_Language::display('genre_info_256_text'));
				$genre[] = array('name'=>Site_Language::display('genre_info_257_caption'),'sname'=>'glrankog','description'=>Site_Language::display('genre_info_257_text'));
				
                $sc->save($name, $genre);
            
            }
            
        } else {
    
            $genre =$sc->load($name);
        }

        if (!is_array($genre)) {
             $genre = array();
        }
       
       
      
        self::$genreList[self::$locale] = $genre;
    }
     
} 
?>