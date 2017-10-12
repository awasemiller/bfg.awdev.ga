<?php
/**
 * Site Comment Class
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
 * Site Comments Class.
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
class Site_Comments {
 
        private static $message_comment;
        
        private static $comment_error;    
		/**
		 * @param string $type
		 * @param string $id
		 * @param bool $return default=true return parsed comments, if return is false echo to screen
		 */
		public static function renderComments($type,$id,$return=true)
		{
			if(!Site_Parse::is_template('comments')){
				if(!Site_Parse::load_template(Configuration::get('theme_path').'comments.html','comments')){
					Site_Parse::load_template(Configuration::get('default_theme_path').'comments.html','comments');
				}
			}

			Site_Parse::setTag('COMMENTS_TXT',Site_Language::display('comments_comments_txt'));
			Site_Parse::setTag('ADD_COMMENTS_TXT',Site_Language::display('comments_add_comment'));

			if($return){
 				return Site_Parse::render_template('comments',self::comments($type,$id),true);
			}else{
				Site_Parse::render_template('comments',self::comments($type,$id),false);
			}
		}

		/**
		 * @param string $type
		 * @param string $id
		 * @return string comment html form
		 */
		public static function commentForm($type,$id)
		{

				Site_Forms::start_form('CommentForm', SGS_SELF.'?'.SGS_QUERY.'#CommentForm');
				
				if(defined('MESSAGE_COMMENT')){

					if(defined('COMMENT_ERROR') && COMMENT_ERROR == true){
						$class = ((defined('ERRORCLASS') && ERRORCLASS !='') ? ' class="'.ERRORCLASS.'"' : ' class="error"');
					}else{
						$class = ((defined('SUCCESSCLASS') && SUCCESSCLASS !='') ? ' class="'.SUCCESSCLASS.'"' : ' class="success"');
					}
					Site_Forms::add_plain_html('<p'.$class.'>'.MESSAGE_COMMENT.'</p>');
				}
				Site_Forms::add_plain_html('<p>');
				Site_Forms::add_input_data('name', isset($_POST['name']) ? stripslashes($_POST['name']) : '', Site_Language::display('comments_form_name'), 'textbox');
				Site_Forms::add_input_data('email', isset($_POST['email']) ? stripslashes($_POST['email']) : '', Site_Language::display('comments_form_email'), 'textbox');
				Site_Forms::add_input_data('url', isset($_POST['url']) ? stripslashes($_POST['url']) : '', Site_Language::display('comments_form_url'), 'textbox');
				Site_Forms::add_text_data('comment', isset($_POST['comment']) ? stripslashes($_POST['comment']) : '', Site_Language::display('comments_form_comment'), 'textbox');
				Site_Forms::add_hidden_data('type', $type);
				Site_Forms::add_hidden_data('id', $id);
				Site_Forms::add_hidden_data('comment_submit', true);
				Site_Forms::add_button('commentsubmit', Site_Language::display('comments_form_submit'), 'submit', 'button');
				Site_Forms::add_plain_html('</p>');

				return  Site_Forms::return_form();
		}

		/**
		 * @param string $type
		 * @param string $id
		 * @return string comments in html format
		 */
		public static function comments($type,$id)
		{

    		if(!Site_Parse::is_template('comment')){
    			if(!Site_Parse::load_template(Configuration::get('theme_path').'comment.html','comment')){
    				Site_Parse::load_template(Configuration::get('default_theme_path').'comment.html','comment');
    			}
    		}
    		$comments = self::loadCommentFile($type,$id);
    		
    		
    		$rcomments = '';
    
    		if(count($comments)>=1){
    
    			if(isset($_REQUEST['from'])){
    				$from=$_REQUEST['from'];
    			}else{
    				$from='0';
    			}
    
    			if(isset($_REQUEST['view'])){
    				$view=$_REQUEST['view'];
    			}else{
    			    /**
    			     * @todo come from Configuration
    			     */

    				if(Configuration::get('commentviewtotal')){
    					$view = Configuration::get('commentviewtotal');
    				}else{
    					$view='10';
    				}
    			}
    
    			$i='0';
    			$viewtotal='1';
    
    			foreach($comments as $comment){
    
    				foreach($comment as $key=>$value){
    						$comment[$key] = self::strip_decode($value);
    				}
    
    				if($i>= $from && $viewtotal <= $view){
    					if(SGS_ADMIN){
    						$comment['admin_options'] = Site_Elements::anchorTag(SGS_SELF.'?id='.$id.'&delete_comment='.$type.'_'.$id.'_'.$comment['date'].'&platform='.PLATFORM, Site_Language::display('comments_delete'));
    					}
    					
    					if(filter_var($comment['email'],FILTER_VALIDATE_EMAIL)){
    						$rating ='PG';
    						$size = '40';
    						$default = SGS_BASE_URL.'images/avatar/logo.gif';
    						$comment['avatar'] = Site_Elements::imageTag('http://www.gravatar.com/avatar.php?gravatar_id='.md5($comment['email']).'&amp;rating='.$rating.'&amp;size='.$size.'default='.urlencode($default), 'avatar', '', 'float-left', $size, $size);
    					}else{
    						$comment['avatar'] ='';
    					}
    
    					// validate urls
    					/**
    					 * @todo test FILTER_VALIDATE_URL
    					 */
    					
    					
    					if(preg_match("/^(http(s?):\\/\\/)((\w+\.)+)\w{2,}(\/?)$/i", $comment['url'])){
    						$comment['name'] = Site_Elements::anchorTag($comment['url'], $comment['name'],'', '', '', '', '', '');
    					}
    
    					$comment = array_merge($comment,self::convertDate($comment['date']));
    					$rcomments .= Site_Parse::render_template('comment',$comment,true);
    					++$viewtotal;
    				}
    				$i++;
    			}
    
    			return array('comments'=>$rcomments,'paginate'=>Site_Paginate::nextPrev(SGS_SELF, $from, $view, $i, '#comments', 'id='.$id.'&amp;type='.$type.'&amp;platform='.PLATFORM.'&amp;from=', true,false),'comment_form'=>self::commentForm($type,$id));
    
    		}else{
    
    			return array('comments'=>'<p'.((defined('COMMENT_CLASS') && COMMENT_CLASS !='') ? ' class="'.COMMENT_CLASS.'"' : '').'>'.str_replace('{TYPE}',$type,Site_Language::display('comments_no_comments_type')).'</p>','paginate'=>'','comment_form'=>self::commentForm($type,$id));
    
    		}
		}

		/**
		 * @param array $_GET
		 * @return bool true on success false on failure
		 */
		public static function deleteComment($_GET)
		{
			if(defined('SGS_ADMIN') && SGS_ADMIN ==true){
				Site_PageCache::$expirePage == true;
				$comment = $_GET['delete_comment'];
				$saveComments = false;
				$tmp = explode('_',$comment);
				$type = $tmp[0];
				$id  = $tmp[1];
				$date = $tmp[2];
				$comments = self::loadCommentFile($tmp[0],$tmp[1]);

				if(is_array($comments)){
					foreach($comments as $key=>$comment){
						if($comment['date'] == $date){
							unset($comments[$key]);
							$saveComments = true;

						}
					}
				}

				if($saveComments){

				    $locale = isset($_GET['locale']) ? $_GET['locale'] : LOCALE;

				    $file = Configuration::get('data_path').$locale.'_comment_'.$type.'_'.$id.'.db';
				    
					$data = serialize($comments);
					
					if(!File::writeAll($file, $data)){
					    return false;
					}

					define('MESSAGE_COMMENT', Site_Language::display('comment_deleted'));
					self::writeCounterFile(array('type'=>$type,'id'=>$id,'delete'=>true));

					return true;
				}

			}

		}

		/**
		 * loadCommentDir
		 *
		 * load all comment files for a current language
		 *
		 * @param void
		 * @return mixed array | bool False
		 */
		public static function loadCommentDir($type='game'){
            
		    
			$commentFiles = array();

			$locale = isset($_GET['locale']) ? $_GET['locale'] : LOCALE;
			
	    	if ($dir = @opendir(Configuration::get('data_path'))) {
		        while (false !== ($tmpfile = readdir($dir))){
		        	if(is_file(Configuration::get('data_path').$tmpfile) && sgs_eregi($locale.'_comment_'.$type,$tmpfile)){
		        		$tmpname = explode('.', $tmpfile);
		        		$commentFiles[fileatime(Configuration::get('data_path').$tmpfile)] = str_replace($locale.'_comment_'.$type.'_','',$tmpname[0]);
		        	}
		        }
	    	}

			if(count($commentFiles)>=1){

				ksort($commentFiles,SORT_NUMERIC );
		    	return $commentFiles;

			}else{

				return false;

			}
		}

		/**
		 * @param string $type
		 * @param string $id
		 * @return array commets array on success, empty array on failure
		 */
		public static function loadCommentFile($type,$id)
		{
		    $locale = isset($_GET['locale']) ? $_GET['locale'] : LOCALE;
		    
		    $file = Configuration::get('data_path').$locale.'_comment_'.$type.'_'.$id.'.db';
		    
			if($data = File::read($file)){
		        return	unserialize($data);
		    }else{
		        return array();
		    }
		}

		/**
		 * @param string $type
		 * @return array count array on success, empty array on failure
		 */
		public static function loadCounterFile($type)
		{
		    
		    $locale = isset($_GET['locale']) ? $_GET['locale'] : LOCALE;
		    
		    $file = Configuration::get('data_path').$locale.'_comment_counter_'.$type.'.db';
		    
		    if($data = File::read($file)){
		        return	unserialize($data);
		    }else{
		        return array();
		    }
		}

		/**
		 * @param string $str
		 * @return string entity decoded html striped string
		 */
		public static function strip_decode($str)
		{
			return stripslashes(strip_tags(html_entity_decode($str)));
		}

		/**
		 * @param array $comment
		 * @return mixed array on success bool false on failure
		 */
		public static function cleanPost($comment)
		{
	    
		
			define('PUNCT', '!.?\_\-~');
			define('ALPHA_LOWER', 'áéíóúàèìòùäëïöüâêîôûñçþæðåý');
			define('ALPHA_UPPER', 'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑÇÞÆÐÅÝ');
            define('KATAKANA', '\x{30A0}-\x{30FF}');
            define('HIRAGANA', '\x{3040}-\x{309F}');
            define('KANJI', '\x{4E00}-\x{9FBF}');
            
            $pattern ='/^['.ALPHA_LOWER.ALPHA_UPPER.PUNCT.'[:alnum:][:punct:][:space:]_'.HIRAGANA.KATAKANA.KANJI.'\s]*$/u';

			$postkeys = array('name','email','url','comment');

			$comment['name'] = self::strip_decode($comment['name']);
			$comment['email'] = self::strip_decode($comment['email']);
			$comment['url'] = self::strip_decode($comment['url']);
			$comment['comment'] = self::strip_decode($comment['comment']);

			foreach($postkeys as $key){
				$_POST[$key] = $comment[$key];
			}
			
			/**
			 * Name
			 */
			
			if(Configuration::get('comments_require_name') == true && $comment['name'] ==''){
				define('COMMENT_ERROR', true);
				define('MESSAGE_COMMENT', Site_Language::display('comments_name_req'));

				return false;
			}else if(!$comment['name']){
				$comment['name'] = Site_Language::display('comment_name_anonymous');
			}	
			
			if(!preg_match($pattern, $comment['name'])){
				define('COMMENT_ERROR', true);
				define('MESSAGE_COMMENT', Site_Language::display('comments_name_invalid'));
				return false;
			}
			/**
			 * Email
			 */
			if(Configuration::get('comments_require_email') == true && $comment['email'] ==''){
					define('COMMENT_ERROR', true);
					define('MESSAGE_COMMENT', Site_Language::display('comments_email_req'));
					return false;
			}

			if($comment['email'] !=''){
				if(!filter_var($comment['email'],FILTER_VALIDATE_EMAIL)){
					define('COMMENT_ERROR', true);
					define('MESSAGE_COMMENT', Site_Language::display('comments_email_invalid'));
					return false;
				}
			}

			/**
			 * URL
			 */

			if(Configuration::get('comments_require_url') == true && $comment['url'] ==''){
					define('COMMENT_ERROR', true);
					define('MESSAGE_COMMENT', Site_Language::display('comments_url_req'));
					return false;
			}

			if($comment['url'] !=''){
				//validate url
				if(!preg_match("/^(http(s?):\\/\\/)((\w+\.)+)\w{2,}(\/?)$/i", $comment['url'])){
					define('COMMENT_ERROR', true);
					define('MESSAGE_COMMENT', Site_Language::display('comments_url_invalid'));
					return false;
				}
			}
			/**
			 * Comment
			 */
			if($comment['comment'] ==''){
				define('COMMENT_ERROR', true);
				define('MESSAGE_COMMENT', Site_Language::display('comments_txt_req'));
				return false;
			}

            if(!preg_match($pattern, $comment['comment'])){
				define('COMMENT_ERROR', true);
				define('MESSAGE_COMMENT', Site_Language::display('comments_txt_invalid'));
				return false;
			}

			return $comment;
		}

		/**
		 * @param array $comment
		 * @return bool true on success flase on failure
		 */
		public static function writeCommentFile($comment)
		{
            Site_PageCache::$expirePage = true;

			/**
			 * run cleanPost for validation
			 */
            $locale = isset($_GET['locale']) ? $_GET['locale'] : LOCALE;
			/**
			 * check for site comments
			 */
			if(!Configuration::get('sitecomments')){
				return false;
			}

			/**
			 * check for game comments
			 */
			if($comment['type'] == 'game' && !Configuration::get('gamecomments')){
				return false;
			}
			/**
			 * check for page comments
			 */

			if($comment['type'] == 'page'){
			    /**
			     * what happens if we are in preview mode
			     * Enter description here ...
			     * @var unknown_type
			     */
			    
				$page = unserialize(file_get_contents(Configuration::get('custom_path').$locale.'_'.$comment['id'].'.page'));
				
				if(!isset($page['allow_comments']) || $page['allow_comments'] == false){
					return false;
				}
			}
	
			if($comment = self::cleanPost($comment)){
			   		    
				$comments = self::loadCommentFile($comment['type'],$comment['id']);

				/**
				 * check for duplicate post.
				 */
				$lastPost = end($comments);

				if($lastPost['name'] == $comment['name'] && $lastPost['comment'] == $comment['comment']){
					define('COMMENT_ERROR', true);
					define('MESSAGE_COMMENT', Site_Language::display('comment_duplicate'));
					return false;
				}

				$comments[] = array('name'=>$comment['name'],'email'=>$comment['email'],'url'=>$comment['url'],'comment'=>$comment['comment'],'date'=>time(),'ip'=>'000.000.0.0');
				$data = serialize($comments);
				$file = Configuration::get('data_path').$locale.'_comment_'.$comment['type'].'_'.$comment['id'].'.db';
				
				
				if(!File::writeAll($file, $data)){
					define('COMMENT_ERROR', true);
					define('MESSAGE_COMMENT', Site_Language::display('comment_fail_save'));
					return false;				    
				}
				
				self::writeCounterFile($comment);
				define('MESSAGE_COMMENT', Site_Language::display('comment_saved'));
				unset($_POST['name']);
				unset($_POST['email']);
				unset($_POST['url']);
				unset($_POST['comment']);


				return true;
			}else{
				return false;

			}
		}

		/**
		 * @param array $countdata
		 * @return bool true on success flase on failure
		 */
		public static function writeCounterFile($countdata)
		{

			$countfile = self::loadCounterFile($countdata['type']);

			if(isset($countdata['delete']) && $countdata['delete'] == true){
				if(array_key_exists($countdata['id'],$countfile)){
					$countfile[$countdata['id']]['count'] = --$countfile[$countdata['id']]['count'];
				}

			}else{
				if(!array_key_exists($countdata['id'],$countfile)){
					$countfile[$countdata['id']] = array('id'=>$countdata['id'],'count'=>'1');
				}else{
					$countfile[$countdata['id']]['count'] = ++$countfile[$countdata['id']]['count'];
				}
			}

			$data = serialize($countfile);

			$locale = isset($_GET['locale']) ? $_GET['locale'] : LOCALE;
			
			$file = Configuration::get('data_path').$locale.'_comment_counter_'.$countdata['type'].'.db';
			
			if(!File::writeAll($file, $data)){
			    return false;
			}
			
			return true;
		}

		/**
		 * getCommentCount
		 * @param array $countdata
		 * @return intager
		 */

		public static function getCommentCount($countdata)
		{
			$countfile = self::loadCounterFile($countdata['type']);
			if(!array_key_exists($countdata['id'],$countfile)){
				return '0';
			}else{
				return $countfile[$countdata['id']]['count'];
			}
		}

		/**
		 * @param string message key
		 * @return string message
		 */
		public static function getText($message)
		{
			$lang = array('readmore_txt'=>Site_Language::display('comments_read_more'),'comments_txt'=>Site_Language::display('comments_comments_txt'),'add_txt'=>Site_Language::display('comments_add_comment'));
			return $lang[''.$message.''];
		}

		/**
		 * @param intager datestamp
		 * @return array date in human readable format ( cmon, cday, cyear, chour, cmin, csec, cmeridiem )
		 */
		public static function convertDate($dateStamp)
		{
			return array('cmon'=>ucfirst(date('F',$dateStamp)),'cday'=>date('jS',$dateStamp),'cyear'=>date('Y',$dateStamp),'chour'=>date('h',$dateStamp),'cmin'=>date('i',$dateStamp), 'csec'=>date('s',$dateStamp),'cmeridiem'=>date('a',$dateStamp));
		}

}
?>