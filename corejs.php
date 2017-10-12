<?php
/**
 * Core JS
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
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 */
require_once 'core_gamesite.php';
header('Content-type: text/javascript'); 

$bfg_server = Configuration_Locale::get('bfg_servers');
$channel_param = Configuration::get('channel_param');
$channel = Configuration::get('channel');
$identifier_param = Configuration::get('identifier_param');
$identifier = Configuration::get('identifier');

$rand = rand(100000000000 , 900000000000);

$playcount_url = $bfg_server.'/ajax.php?ol_playcount={gameid}&callback=jsonp'.$rand.'&'.$channel_param.'='.$channel.'&'.$identifier_param.'='.$identifier.'&afcode='.$identifier;
?>

   
var $config = {
        'playcount_url' : '<?php echo $playcount_url; ?>'
    };
    

/**
 * @deprecated
 */
function open_window(url,name,wth,hgt,display)
{

	return false;

}
/**
 * @deprecated
 */
function FitPic()
{
	return false;
}

function Generateobj($src, $flashvars, $width, $height, $alt){

	var width = ' width="'+ $width +'"';
	var height = ' height="'+ $height +'"';
	var alt = (typeof $alt !='undefined') ? '<img src="'+ $alt +'" width="'+ $width +'" height="'+ $height +'" alt="" />' : '';

  	var str = '';
 	str += '<!--[if IE]>\n';
	str += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" '+ width + height +'>\n';
	str += '<param name="movie" value="'+ $src +'" />\n';
	str += '<param name="flashvars" value="'+ $flashvars +'" />\n';
	str += '<param name="allowscriptaccess" value="always" />\n';
	str += '<param name="quality" value="best" />\n';
	str += '<param name="wmode" value="transparent" />\n';
	str += alt +'\n';
	str += '</object>\n';
	str += '<![endif]-->\n';
	str += '<!--[if !IE]> <-->\n';
	
	
	str += '<object type="application/x-shockwave-flash" data="'+ $src +'" '+ width + height + '>\n';
	str += '<param name="flashvars" value="'+ $flashvars +'" />\n';
	str += '<param name="allowscriptaccess" value="always" />\n';
	str += '<param name="quality" value="best" />\n';
	str += '<param name="wmode" value="transparent" />\n';
	str += alt +'\n';
	str += '</object>\n';
	str += '<!--> <![endif]-->\n';
	
	return str;
}


$(document).ready(function(){

/******************************************************************************************************************
 * @name: bPopup
 * @type: jQuery
 * @author: Bjoern Klinggaard (http://dinbror.dk/bpopup)
 * @version: 0.4.1
 * @requires jQuery 1.3
 *
 * DEFAULT VALUES:
 * amsl(Above Mean Sea Level): 150px // Vertical distance from the middle of the window, + = above, - = under
 * appendTo: 'body' // Which element the popup should append to (append to 'form' when ASP.net)
 * closeClass: 'bClose' // Class to bind the close event to
 * content: 'ajax' // [iframe, ajax, xlink] COMING SOON
 * contentContainer: null //if null, contentContainer == $(this)
 * escClose: true // Close on esc
 * fadeSpeed: 250 // Animation speed on fadeIn/out
 * follow: true // Should the popup follow the screen on scroll/resize? 
 * followSpeed: 500 // Animation speed for the popup on scroll/resize
 * loadUrl: null // External page or selection to load in popup
 * modal: true // Modal overlay
 * modalClose: true // Shold popup close on click on modal overlay?
 * modalColor: #000 // Modal overlay color
 * opacity: 0.7 // Transparency, from 0.1 to 1.0 (filled)
 * scrollBar: true // Scrollbars visible
 * vStart: null // Vertical start position for popup
 * zIndex: 9999 // Popup z-index, modal overlay = popup z-index - 1
 *
 * TODO: REFACTOR CODE!!!
 *******************************************************************************************************************/ 
;(function($) {
  $.fn.bPopup = function(options, callback) {
    if($.isFunction(options)) {
        callback = options;
        options = null;
    }
    o = $.extend({}, $.fn.bPopup.defaults, options); 
    //HIDE SCROLLBAR?  
    if(!o.scrollBar)
        $('html').css('overflow', 'hidden');


    var $selector = $(this),
        $modal = $('<div id="bModal"></div>'),
        d = $(document),
        w = $(window),
        cp = getCenterPosition($selector, o.amsl),
        vPos = cp[0],
        hPos = cp[1],
        isIE6 = $.browser.msie && parseInt($.browser.version) == 6 && typeof window['XMLHttpRequest'] != 'object'; // browser sniffing is bad
     
    //PUBLIC FUNCTION - call it: $(element).bPopup().close();
    this.close = function() {
        o = $selector.data('bPopup');
        close();
    }
        
    return this.each(function() { 
          if($selector.data('bPopup'))return; //POPUP already exists?
          // MODAL OVERLAY
          if(o.modal) {
             $modal
                .css(getModalStyle())
                .appendTo(o.appendTo)   
                .animate({'opacity': o.opacity}, o.fadeSpeed);
          }   
          $selector.data('bPopup', o);
          // CREATE POPUP  
          create();
    }); 
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // HELP FUNCTIONS - PRIVATE
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function create() {
        var hasInputField = $('input[type=text]', $selector).length != 0;
        var t = o.vStart != null ? o.vStart : d.scrollTop() + vPos;
        $selector
            .css( {'left': d.scrollLeft() + hPos, 'position': 'absolute', 'top': t, 'z-index': o.zIndex } )
            .appendTo(o.appendTo)
            .hide(function(){
                if(hasInputField) {
                    // Resets input fields
                    $selector.each(function() {
                        $selector.find('input[type=text]').val('');    
                    });
                } 
                if(o.loadUrl != null) 
                    createContent();                         
            })
            .fadeIn(o.fadeSpeed, function(){
                if(hasInputField) {
                    $selector.find('input[type=text]:first').focus();
                } 
                // Triggering the callback if set    
                $.isFunction(callback) && callback();          
            }); 
        //BIND EVENTS
        bindEvents(); 
    }
    function close() { 
        if(o.modal) {
            $('#bModal')   
                .fadeOut(o.fadeSpeed, function(){
                    $('#bModal').remove();
                });  
        }
        $selector.fadeOut(o.fadeSpeed, function(){
            if(o.loadUrl != null && o.content != 'xlink') {
                o.contentContainer.empty();
            }
        });  
        unbindEvents();
        return false;
    }
    function getModalStyle() {
        if(isIE6) {
            var dd = getDocumentDimensions();
            return {'background-color': o.modalColor,'height': dd[0], 'left': getDistanceToBodyFromLeft(), 'opacity': 0, 'position': 'absolute', 'top': 0, 'width': dd[1], 'z-index': o.zIndex - 1};
        }
        else
            return {'background-color': o.modalColor,'height': '100%', 'left': 0, 'opacity': 0, 'position': 'fixed', 'top': 0, 'width': '100%', 'z-index': o.zIndex - 1};     
    }
    function createContent() {
        o.contentContainer = o.contentContainer == null ? $selector : $(o.contentContainer);
        switch(o.content){
            case('ajax'):
                o.contentContainer.load(o.loadUrl); 
                break;
            case('iframe'):               
                $('<iframe width="100%" height="100%"></iframe>').attr('src',o.loadUrl).appendTo(o.contentContainer);
                break;
            case('xlink'):
                //Better implementation coming soon!
                $('a#bContinue').attr({'href': o.loadUrl});
                $('a#bContinue .btnLink').text($('a.xlink').attr('title'))
                break;
        }
    }
    function bindEvents() {
       $('.' + o.closeClass).live('click', close);
       if(o.modalClose) {
            $('#bModal').live('click', close).css('cursor','pointer');
       }
       if(o.follow) {
           w.bind('scroll.bPopup', function() { 
                $selector
                   .stop()
                   .animate({'left': d.scrollLeft() + hPos, 'top': d.scrollTop() + vPos }, o.followSpeed);
           })
           .bind('resize.bPopup', function() {
                // MODAL OVERLAY IE6
                if(o.modal && isIE6) {
                    var dd = getDocumentDimensions(); 
                    $modal
                        .css({ 'height': dd[0], 'width': dd[1], 'left': getDistanceToBodyFromLeft() });
                }
                // POPUP
                var pos = getCenterPosition($selector, o.amsl);
                vPos = pos[0];
                hPos = pos[1];
                $selector
                    .stop()
                    .animate({'left': d.scrollLeft() + hPos, 'top': d.scrollTop() + vPos }, o.followSpeed);               
           });
       } 
       if(o.escClose) {
           d.bind('keydown.bPopup', function(e) {
                if(e.which == 27) {  //escape
                    close();
                }
           });  
       }   
    }
    function unbindEvents() {
        if(!o.scrollBar)  {
            $('html').css('overflow', 'auto');
        }
        $('.' + o.closeClass).die('click');
        $('#bModal').die('click');
        d.unbind('keydown.bPopup');
        w.unbind('.bPopup');
        $selector.data('bPopup', null);
    }
    function getDocumentDimensions() {
        return [d.height(), d.width()];
    }	
    function getDistanceToBodyFromLeft() {
        return (w.width() < $('body').width()) ? 0 : ($('body').width() - w.width()) / 2;
    }
    
    function getCenterPosition(s, a) {
        var vertical = ((w.height() - s.outerHeight(true)) / 2) - a;
        var horizontal = ((w.width() - s.outerWidth(true)) / 2) + getDistanceToBodyFromLeft(); 
        return [vertical < 20 ? 20 : vertical, horizontal];
    } 
  };
  $.fn.bPopup.defaults = {
        amsl: 150, 
        appendTo: 'body',
        closeClass: 'bClose',
        content: 'ajax',
        contentContainer: null,
        escClose: true,
        fadeSpeed: 250,
        follow: true,
        followSpeed: 500,
        loadUrl: null,
        modal: true,
        modalClose: true,
        modalColor: '#000',
        opacity: 0.7,
        scrollBar: true,
        vStart: null,
        zIndex: 9999
  };
})(jQuery);
    /************************************************************************
     * @end: bPopup
     ************************************************************************/

	/**
	 * Use to test for the existance of an object.
	 *
	 * $("#Module_GamePlayButton").exists();
	 * 
	 * returns bool
	 */
    jQuery.fn.exists = function(){
        return this.length > 0 ? true : false;
    }

	$(".flash").each(
		function()
		{

			var data = $(this).attr('data');
			
			
			data = eval('(' + data + ')');
		    var flash = Generateobj(data.src,data.flashvars,data.width,data.height,data.alt);
			$(flash).insertBefore($(this));
			

		}
	);

    $("#Module_GamePlayButton").click(function(){
                       
            var gameData = $("#Module_GamePlayButton").attr('data');
            var gameid =    $("#Module_GamePlayButton").attr('gameid');
       
            var $playcount = $('<iframe></iframe>').appendTo('body');
            
            $playcount.css('display','none').attr('src',$config.playcount_url.replace('\{gameid\}', gameid));
            
            $(this).fadeOut();
                        
            $("#Module_GameContainerWrapper").show('slow',
                function(){
                    $("#Module_GameContainer").fadeIn('slow',
                      function(){
                            $('html, body').animate({scrollTop:200}, 'slow');
                        }
                    
                    );
                }
            );
            
    });

	if($("#Module_GamePlayButton").exists()){
		setTimeout('$("#Module_GamePlayButton").trigger("click")', 1500);
	}

	var $popWindow = $('<div />').attr('width','640').attr('height','480').attr('class','sgspopup').appendTo('body').hide();

	function SGSpopup(data)
	{
		$('.sgspopup').html(data);
		
		$('<span />').attr('class','close').appendTo('.sgspopup');

		$('.sgspopup').bPopup({opacity:0.8,'closeClass':'close'},
      		function(){
      			$('.sgspopup').show();
      		}
      	);	
	}


   $('.screenshots > a').bind('click', function(e){
		e.preventDefault();
		
		
		var $screenshot = $('<img />').attr('width','640').attr('height','480').attr('src',$(this).attr('href'));
		
		SGSpopup($screenshot);

   });
     
   $('.btn_video').bind('click', function(e){
   
   		e.preventDefault();

   		var $flashvars = 'videoinfo='+ $(this).attr('href');
      	var $flash = Generateobj('videoshell.swf',$flashvars,'600','480','','');
      	
      	SGSpopup($flash);
        		
   });      
   
});