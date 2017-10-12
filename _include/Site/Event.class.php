<?php 
/**
 * Site_Event, used to execure site wide events.
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
 * Site_Event, used to execure site wide events.
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

class Site_Event{
    
		/**
		 * register_event
		 * @todo phpdoc comments
		 */
		function register_event($event,$processor)
		{
			$this->events[$event] = $processor;
		}

		/**
		 * process_events
		 * @todo phpdoc comments
		 */
		function process_events()
		{
			/**
			 * we need to order our events to run autoload process's first
			 */
			foreach($this->events as $event=>$process){
				$order[$event] = $process[0];
			}

			array_multisort($order,SORT_ASC, SORT_STRING, $this->events);
			
			foreach($this->events as $event=>$process){
			    
				switch($process[0]){
					case 'post':
						if(isset($_POST[$event])){
							if(method_exists($process[1],$process[2])){
								call_user_func(array($process[1], $process[2]),$_POST);
							}
						}
					break;

					case 'get':
						if(isset($_GET[$event])){
							if(method_exists($process[1],$process[2])){
								call_user_func(array($process[1], $process[2]),$_GET);
							}
						}
					break;

					case 'cookie':
						if(isset($_GET[$event])){
							if(method_exists($process[1],$process[2])){
								call_user_func(array($process[1], $process[2]),$_COOKIE);
							}
						}
					break;

					case 'autorun':
						if(method_exists($process[1],$process[2])){
							call_user_func(array($process[1], $process[2]));
						}
					break;

					case 'default':
					break;
				}
			}
		
			unset($this->events); // cleanup events
	 		
		}    
    
}
?>