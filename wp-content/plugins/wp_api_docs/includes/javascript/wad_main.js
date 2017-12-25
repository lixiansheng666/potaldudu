
var AtlasCookie = wad_cookie() ? Cookies.noConflict() : '';
	
//var is_mobile = is_mobile();
//alert(is_mobile.any());

var sb_def_open = 240, // the default sidebar width when it's opend.
	sb_def_closed = 50,
	sb_closing_w = 200; // the min width before the sidebar gets closed.


function wad_main_js(){

	// Sidebar Toggle	
	jQuery("[data-toggle]").on('click', function() {
		var toggle_el = jQuery(this).data("toggle");
		jQuery(toggle_el).toggleClass("open-sidebar");
		jQuery('#wad_bottom_menu').toggleClass("sb_bottom_is_closed");
		
		/** 
		 * DESKTOP Action
		 */
		if( jQuery(window).width() > 480 ){
			if( jQuery('#sidebar').hasClass('open-sidebar') ){
				jQuery("#sidebar").css({width:sb_def_open});
			}else{
				jQuery("#sidebar").css({width:sb_def_closed});
			}
		}
		
		/** 
		 * MOBILE Action
		 */
		if( jQuery(window).width() <= 480 ){
			if( jQuery('#sidebar').hasClass('open-sidebar') ){
				jQuery("#sidebar").show();
				jQuery('#sidebar').css({"width": jQuery(window).width() }); // - 50
				//jQuery('body').addClass('noscroll');
				jQuery('html, body').css({"overflow-x": "hidden", "overflow-y": "hidden"});
				
			}
			else
			{
				//$('body').removeClass('noscroll');
				jQuery('html, body').css({"overflow-x": "", "overflow-y": ""});
				jQuery("#sidebar").hide();
			}
		}
		
		resize_content();
	});
	
	
	// Sidebar Bottom Toggle
	jQuery("#wad_bottom_menu").on('click', function() {
		
		if( jQuery(window).width() > 480 ){
			jQuery(this).toggleClass("sb_bottom_is_closed");
			jQuery('#sidebar').toggleClass("open-sidebar");
			
			if( jQuery('#sidebar').hasClass('open-sidebar') ){
				jQuery("#sidebar").css({width:sb_def_open});
			}else{
				jQuery("#sidebar").css({width:sb_def_closed});
			}
			
			resize_content();
		}
	});
	
	
	// Swipe actions
	jQuery(".swipe-area").swipe({
		swipeStatus:function(event, phase, direction, distance, duration, fingers)
		{
			if (phase=="move" && direction =="right") {
				 jQuery("#sidebar").addClass("open-sidebar");
				 jQuery("#sidebar").css({width:sb_def_open});
				 resize_content();
				 return false;
			}
			if (phase=="move" && direction =="left") {
				 jQuery("#sidebar").removeClass("open-sidebar");
				 jQuery("#sidebar").css({width:sb_def_closed});
				 resize_content();
				 return false;
			}
		}
	});
	
	
	
	/**
	 * Submenu Slider
	 */
	var sb_max_w = jQuery(window).width();
	var mainmin = jQuery(window).width() / 2;
	
	jQuery('#split_bar').mousedown(function (e) {
		e.preventDefault();
		jQuery(document).mousemove(function (e) {
			e.preventDefault();
			var x = e.pageX - jQuery('#sidebar').offset().left;
			if (x > sb_def_closed && x < sb_max_w && e.pageX < (jQuery(window).width() - mainmin)) {  
				jQuery("#sidebar").addClass("sliding-sidebar");
				jQuery('#sidebar').css("width", x);
				jQuery('.main-content').css("margin-left", x);
				jQuery('.swipe-area').css({"width": x });
				jQuery('#sidebar-toggle').css({"height": jQuery('#sidebar-toggle').width() });
				//jQuery('#footer').css({"margin-left": x });
				resize_content();
			}
		})
	});
	jQuery(document).mouseup(function (e) {
		jQuery("#sidebar").removeClass("sliding-sidebar");
		jQuery("#sidebar").removeAttr( "width" );
		
		// If sibar is wider then 100px we know it's opened. So we add the .open-sidebar class.
		page_load_resize();
		jQuery(document).unbind('mousemove');
	});	
	
	
	
	
	
	/**
	 * Menu actions
	 */
	jQuery('.wad_menu').on('click', function(){
		jQuery(this).parent().toggleClass('open');
	});
	
	/*jQuery(".wad_cat *").on('click', function(e) {
        e.stopPropagation();
	});*/
		
	
	
	
	
	jQuery(window).bind('resize', function () {
		
		// Set default item sizes.
		default_sizes();
		
		var sidebar =  wad_cookie() ? AtlasCookie.get('sidebar') : null;
		if(sidebar){
			jQuery('#sidebar').css({width: sidebar});
			page_load_resize();
		}
		
		resize_content();
	}).trigger('resize'); 
	
}




function default_sizes(){
	
	jQuery('.toppadding').css({"padding-top": jQuery('header').outerHeight() });
	jQuery('.main').find('.inside').css({"min-height": jQuery(window).height() - jQuery('#footer').outerHeight() });
	jQuery('#sidebar').css({"padding-top": jQuery('header').outerHeight() });
	
	/** 
	 * DESKTOP Resizing
	 */
	if( jQuery(window).width() > 480 ){
		jQuery('#sidebar').css({"width":sb_def_open });
		jQuery('.swipe-area').css({"width": sb_def_closed });
		jQuery('#sidebar-toggle').css({"height": jQuery('#sidebar-toggle').width() });
		
		//var main_margin_left = wad_full_page() ? 0 : jQuery('#sidebar').width();
		 jQuery('.main').css({"margin-left": jQuery('#sidebar').width() });
		
		//jQuery('#footer').css({"margin-left":jQuery('#sidebar').width() });
	}
	
	/** 
	 * MOBILE Resizing
	 */
	if( jQuery(window).width() <= 480 ){
		jQuery('#sidebar').removeClass('open-sidebar');
		jQuery('.main').css({"margin-left": 0 });
		jQuery('.main').css({"width": jQuery(window).width });
		//jQuery('#footer').css({"margin-left": 0 });
	}
}



/**
 * Check if the page is full width
 * 0 - sidebar exists
 * 1 - No sidebar so it's full width
 */
function wad_full_page(){
	return jQuery("#sidebar").length ? 0 : 1;
}



function resize_content(){
	
	/**
	 * Default resizing for all devices.
	 */
	var sidebar = jQuery('#sidebar').width();
	// Set cookie
	if( wad_cookie() ){
		AtlasCookie.set('sidebar', sidebar);
		//AtlasCookie.remove('sidebar');
	}
	
	
	jQuery('#sidebar').css({top: jQuery('.header').height()*2});
	
	/** 
	 * DESKTOP Resizing
	 */
	if( jQuery(window).width() > 480 ){
		jQuery('#sidebar').show();
		jQuery('.main-content').css("margin-left", sidebar);
		jQuery('.main-content').css({"width": jQuery(window).width() - sidebar });
		//jQuery('#footer').css({"margin-left": sidebar });
		
		if(sidebar < sb_closing_w){
			jQuery('#sidebar').removeClass('open-sidebar');
			//jQuery('.swipe-area').css({"visibility": "visible"});
		}else{
			jQuery('#sidebar').addClass('open-sidebar');
		}
	}
	
	/** 
	 * MOBILE Resizing
	 */
	if( jQuery(window).width() <= 480 ){
		jQuery('.main').css({ "width": jQuery(window).width() });
		jQuery('.main').css({"margin-left": 0 });
		//jQuery('#footer').css({"margin-left": 0 });
	}
	
	
}
 
 
 
 
function page_load_resize(){
	
	/**
	 * DESKTOP Resizing
	 */
	if( jQuery(window).width() > 480 ){
		if(!wad_full_page()){
			if(jQuery('#sidebar').width() > sb_closing_w){
				jQuery('#sidebar').addClass('open-sidebar');
				jQuery('#wad_bottom_menu').removeClass("sb_bottom_is_closed");
			}else{
				// If the sidebar is smaller then the min. with we close it.
				jQuery('#sidebar').removeClass('open-sidebar');
				jQuery('#wad_bottom_menu').addClass("sb_bottom_is_closed");
				jQuery('#sidebar').css({width: sb_def_closed});
				jQuery('.swipe-area').css({"width": sb_def_closed });
				jQuery('#sidebar-toggle').css({"height": jQuery('#sidebar-toggle').width() });
				jQuery('.main-content').css("margin-left", sb_def_closed);
				//jQuery('#footer').css({"margin-left":sb_def_closed});
			}
		}
	}
	
	
	resize_content();	
}



function wad_cookie(){
	return wad_data.cookie > 0 ? true : false;
}


/**
 * Check if page is visited with mobile device.
 *
 * Usage:
 * var is_mobile = is_mobile();
 * alert(is_mobile.any());
 */
function is_mobile(){
	
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	
	return isMobile;
}