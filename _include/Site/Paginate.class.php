<?php
/**
 * Site Paginate
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
 * Original code comes from the e107 website system.
 *

 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author Steve Dunstan Steve Dunstan <jalist@e107.org> 
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Class Site Paginate.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author Steve Dunstan Steve Dunstan <jalist@e107.org>  
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

if(!defined('SGS_INIT')){ exit; }

class Site_Paginate 
{

		/**
		 * nextprev
		 *
		 * used to create pagination links.
		 *
		 * @param string $url current page
		 * @param intager $from start element count
		 * @param intager $view total number elements to view per page
		 * @param intager $total total number of elements
		 * @param string $cname custom page name appended to the end of the pagination url.
		 * @param string $qs query string
		 * @param bool $return default false | return pagination html | echo to screen
		 * @param bool $seo  default false | used to build custom page url for Search Engine Optimization Urls. will remove (?) from $qs param.
		 */

		public static function nextPrev($url, $from, $view, $total, $cname='', $qs, $return = false,$seo=false)
		{
            
			if ($total > $view) {
				$a = $total / $view;
				$r = explode(".", $a);
				if (isset($r[1]) && $r[1] != 0 ? $pages = ($r[0] + 1) : $pages = $r[0]);
			} else {
				$pages = FALSE;
			}

			if(defined('PRE_PAGINATE_SEL') && defined('POST_PAGINATE_SEL')){
				$PRE_PAGINATE_SEL = PRE_PAGINATE_SEL;
				$POST_PAGINATE_SEL = POST_PAGINATE_SEL;
			}else{
				$PRE_PAGINATE_SEL = '[<span style="text-decoration:underline">';
				$POST_PAGINATE_SEL = '</span>] ';
			}

			if(defined('PAGINATE_TEXT')){
				$npage = PAGINATE_TEXT;
			}else{
				$nppage = Site_Language::display('paginate_page');
			}

			if ($pages) {

				if ($pages > 10) {
					$current = ($from/$view)+1;

					for($c = 0; $c <= 2; $c++) {
						$nppage .= ($view * $c == $from ? $PRE_PAGINATE_SEL.($c + 1).$POST_PAGINATE_SEL : "<a href='{$url}".($seo ? $qs : ($qs ? "?{$qs}" : "")).($view * $c).($cname ? "{$cname}" : "")."'>".($c + 1)."</a> ");
					}

					if ($current >= 3 && $current <= 5) {
						for($c = 3; $c <= $current; $c++) {
							$nppage .= ($view * $c == $from ? $PRE_PAGINATE_SEL.($c+1).$POST_PAGINATE_SEL : "<a href='{$url}".($seo ? $qs : ($qs ? "?{$qs}" : "")).($view * $c).($cname ? "{$cname}" : "")."'>".($c + 1)."</a> ");
						}
					}
					else if($current >= 6 && $current <= ($pages-5)) {
						$nppage .= " ... ";
						for($c = ($current-2); $c <= $current; $c++) {
							$nppage .= ($view * $c == $from ? $PRE_PAGINATE_SEL.($c+1).$POST_PAGINATE_SEL : "<a href='{$url}".($seo ? $qs : ($qs ? "?{$qs}" : "")).($view * $c).($cname ? "{$cname}" : "")."'>".($c + 1)."</a> ");
						}
					}
					$nppage .= " ... ";

					if (($current + 5) > $pages && $current != $pages) {
						$tmp = ($current-2);
					} else {
						$tmp = $pages-3;
					}

					for($c = $tmp; $c <= ($pages-1); $c++) {
						$nppage .= ($view * $c == $from ? $PRE_PAGINATE_SEL.($c + 1).$POST_PAGINATE_SEL : "<a href='{$url}".($seo ? $qs : ($qs ? "?{$qs}" : "")).($view * $c).($cname ? "{$cname}" : "")."'>".($c + 1)."</a> ");
					}

				} else {
					for($c = 0; $c < $pages; $c++) {
						if ($view * $c == $from ? $nppage .= $PRE_PAGINATE_SEL.($c + 1).$POST_PAGINATE_SEL : $nppage .= "<a href='{$url}".($seo ? $qs : ($qs ? "?{$qs}" : "")).($view * $c).($cname ? "{$cname}" : "")."'>".($c + 1)."</a> ");
					}
				}

				if(defined('PRE_PAGINATION') && defined('POST_PAGINATION')){
					$text = PRE_PAGINATION.$nppage.POST_PAGINATION;
				}else{
					$text = '<div class="pagination" style="text-align:right">'.$nppage.'</div>'."\n";
				}

				if($return == true){
					return $text;
				} else {
					echo $text;
					return null;
				}
			}
		}
}
?>