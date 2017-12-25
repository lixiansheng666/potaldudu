/*jshint unused: false, newcap: false, nonew: false*/
/*globals jQuery, google, Modernizr, MediaElement, theme_objects, Froogaloop */


/* JS GUIDE
-------------------------------------------------------------------------------------

     1. Header
    	1.1 Menu Click Mobile
    	1.2 Menu Scroll Mobile
    	1.3 Header Scroll
    
     2. Modal Share
    	2.1 Open Modal
    	2.2 Close Modal
    	2.3 Reset Mobile/Desktop
    
     3. Modal Search
    	3.1 Open Modal
    	3.2 Close Modal
    
     4. Full-Screen Section/Title Header
    
     5. Scroll FX
    	5.1 Scroll FX Slider
    
     6. Scroll Button Full-Screen Areas
    
     7. AZ Slider Title Headers
    
     8. MediaElements
    
     9. Vimeo
    
    10. Youtube
    
    11. FitVids ( Responsive Video )
    
    12. Google Maps
    
    13. FancyBox
    
    14. Back to Top
    
    15. Infinite Scroll for Blog
    
    16. Show/Hide Comments
    
    17. Team Modal Creative
    
    18. Porfolio
    	18.1 Filter
    	18.2 Infinite Scroll
    	18.3 Portfolio Creative Modal
    
    19. AZ Testimonial Slider
    
    20. AZ Twitter Feed Slider
    
    21. AZ Gallery Images
    
    22. AZ Buttons
    
    23. AZ Box Icons
    
    24. AZ Tooltips
    
    25. Page Loader
    
    26. Animation on Scroll
    
    27. Columns Equal Height
    
    28. Windows Phone Fix
    
    29. Disable Right Click
    
    30. Responsive Typo

    31. Init

-------------------------------------------------------------------------------------*/


jQuery(function($){

'use strict';

var ALICE = window.ALICE || {};


/* 1. Header
-------------------------------------------------------------------------------------*/
ALICE.listenerDesktopMenu = function(){
	if($('#header').length > 0){
		
		// Add Block Layer to body
		$('.wrap_all').append('<div id="blocker"></div>');
	
		// Open Trigger Menu
	    $('.menu-trigger').on('click', function(){

	        if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {

	        	$('#my-menu.mobile-menu').velocity("fadeIn", { duration: 450, easing: 'easeOutExpo' });

	        } else {

	        	// Add Classes
	        	$(this).addClass('open');
		        $('#header').addClass('menu-open');
		        $('#my-menu').addClass('menu-visible').removeClass('menu-not-visible');

		        // Block Scroll Page
		        $('html, body').addClass('block-scroll');

		        // Animation Reverse
	        	if($(this).hasClass('open')) {

	        		// Different Animation if Slogan Menu is active
	        		if($('#my-menu').hasClass('slogan-disabled')) {

	        			$('.wrap_all, #header, .title-header-container').velocity({ 
			        		right: "33.3%", 
			        	}, 550, 'easeOutExpo');

	        		} else {

	        			$('.wrap_all, #header, .title-header-container').velocity({ 
			        		right: "66.6%", 
			        	}, 550, 'easeOutExpo');

	        		}

		        	$('.wrap_all').addClass('menu-is-open');

			        $('#blocker').velocity("fadeIn", { duration: 450, easing: 'easeOutExpo' });

			    } else {

		        	$('.wrap_all, #header, .title-header-container').velocity({ 
		        		right: "0", 
		        	}, 550, 'easeOutExpo');

		        	$('.wrap_all').removeClass('menu-is-open');

			    	$('#blocker').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });
			    }

	        }
	        
	    });

	    // Close Trigger Menu
	    $('.menu-trigger-close').on('click', function(){

	    	if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {

	    		$('#my-menu.mobile-menu').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });

	    	} else {

	    		$('.menu-trigger').removeClass('open');
	    		$('#header').removeClass('menu-open');
	    		$('html, body').removeClass('block-scroll');
	    		$('#my-menu').removeClass('menu-visible').addClass('menu-not-visible');

	    		$('.wrap_all, #header, .title-header-container').velocity({ 
	        		right: "0", 
	        	}, 550, 'easeOutExpo');

	        	$('.wrap_all').removeClass('menu-is-open');
			    
			    $('#blocker').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });

	    	}

	    });
		
		// Close Menu by Body
	    $('#blocker').on('click', function(){
	
	    	if( !Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {

	    		$('#my-menu').removeClass('menu-visible').addClass('menu-not-visible');
		    	$('.menu-trigger').removeClass('open');
		    	$('#header').removeClass('menu-open');
		    	$('html, body').removeClass('block-scroll');

	    		$('#blocker').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });
	    		$('.wrap_all, #header, .title-header-container').velocity({ 
		    		right: "0", 
		    	}, 550, 'easeOutExpo');

	    		$('.wrap_all').removeClass('menu-is-open');

	    	}

	    });

	    // Prevent Scroll if the link is empty
	    $('.mm-panel ul li a[href$="#"]').click(function(e) {
	    	e.preventDefault();
	    });

	    $('.sf-menu li').each(function(){
			if($(this).find('> ul').length > 0) {
				$(this).children('.sub-menu').hide();
				//$(this).find('> a').append('<span class="cont"><i class="font-icon-arrow-down-triangle"></i></span>');
			}
		});

		// Hover Classic Menu
		$('.mm-classic-panel .sf-menu li').hover(function(){

	        if ( $(this).children('.sub-menu').length > 0 ) {

	            $(this).children('.sub-menu').stop().fadeIn({
	            	duration: 350,
	            	easing: 'easeInQuad'
	            });

	        }

	    }, function(){

	        if ( $(this).children('.sub-menu').length > 0 ) {

	            $(this).children('.sub-menu').stop().fadeOut({
	            	duration: 350,
	            	easing: 'easeOutQuad'
	            });

	        }

	    });

		// Hover Creative/Mobile Menu
	    $('.mm-panel .sf-menu li').hover(function(){

	        if ( $(this).children('.sub-menu').length > 0 ) {

	            $(this).children('.sub-menu').stop().slideDown({
	            	duration: 350,
	            	easing: 'easeInQuad'
	            });

	        }

	    }, function(){

	        if ( $(this).children('.sub-menu').length > 0 ) {

	            $(this).children('.sub-menu').stop().slideUp({
	            	duration: 350,
	            	easing: 'easeOutQuad'
	            });

	        }

	    });

		/* Workaround for dropdown menu hover on mobile browsers */
	    ALICE.mobileMenuClick();

	    /* Menu Scroll if > of Viewport Height */
	    ALICE.mobileMenuScroll();

		// Reset
		if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {
			$('#my-menu').addClass('mobile-menu').removeClass('menu-not-visible');
		} else {
			$('#my-menu').removeClass('mobile-menu').addClass('menu-not-visible');
		}

		$(window).resize(function(){
		
			if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {

				if($('.menu-trigger').hasClass('open')) {

					$('#my-menu').removeClass('menu-visible').addClass('menu-not-visible');
			    	$('.menu-trigger').removeClass('open');
			    	$('#header').removeClass('menu-open');
					$('html, body').removeClass('block-scroll');

					$('.wrap_all, #header, .title-header-container').css({'right':''});
					$('#blocker').css({ 'display':'', 'opacity':''});
					$('#my-menu').addClass('mobile-menu');

					$('.wrap_all').removeClass('menu-is-open');

				} else {

					$('#my-menu').addClass('mobile-menu');

				}

			} else {

				$('#my-menu').removeClass('mobile-menu').css({ 'display':'', 'opacity':''});

			}

		});

	}
};


/* 1.1 Menu Click Mobile
--------------------------------*/
ALICE.mobileMenuClick = function() {

    function isTouchDevice(){
		return typeof window.ontouchstart !== 'undefined';
	}
	
	if( isTouchDevice() ) {
		// 1st click, add "clicked" class, preventing the location change. 2nd click will go through.
        $('.sf-menu > li').click(function(e) {

        	if ( $(this).children('.sub-menu').length > 0 ) {

        		// Perform a reset - Remove the "clicked" class on all other menu items
            	$('.sf-menu > li > a').not(this).removeClass('clicked');

            	$(this).toggleClass('clicked');
            }

        });
    }
	
};


/* 1.2 Menu Scroll Mobile
--------------------------------*/
ALICE.mobileMenuScroll = function() {
	var elem = $('.mm-panel').outerHeight() + 105;
    var winH = window.innerHeight ? window.innerHeight:$(window).height();

    if ( elem > winH ) {
	    $('#my-menu').addClass('overflow-height');
	} else {
		$('#my-menu').removeClass('overflow-height');
	}
};


/* 1.3 Header Scroll
--------------------------------*/
ALICE.headerScroll = function() {

	var offset_container = 0,
		total_offset_container = 0;

	if($('.no-page-header').length > 0) {
		offset_container = 5;
		total_offset_container = 200;
	} 
	else {
		offset_container = $('.wrap-title-header').outerHeight() / 2;
		total_offset_container = $('.wrap-title-header').outerHeight();

		$(window).resize(function() {
			offset_container = $('.wrap-title-header').outerHeight() / 2;
			total_offset_container = $('.wrap-title-header').outerHeight();
		});
	}

	if($('#error-page').length > 0) {

		$('#header').headroom("destroy");

	} else {

		if( $(window).scrollTop() > offset_container ) {
	        $('#header').addClass('scrollable').removeClass('is-container');
		} 
		else if( $(window).scrollTop() < offset_container ){
	        $('#header').removeClass('scrollable').addClass('is-container');
	    }

		if( $(window).scrollTop() > total_offset_container ) {
	        $('#header').removeClass('is-container').addClass('is-not-container');
		}
		else if( $(window).scrollTop() < total_offset_container ){
	        $('#header').removeClass('is-not-container').addClass('is-container');
	    }

		$(window).scroll(function(){
			if( $(this).scrollTop() > offset_container ) {
		        $('#header').addClass('scrollable').removeClass('is-container');
			} 
			else if( $(this).scrollTop() < offset_container ){
		        $('#header').removeClass('scrollable').addClass('is-container');
		    }

			if( $(this).scrollTop() > total_offset_container ) {
		        $('#header').removeClass('is-container').addClass('is-not-container');
			} 

			else if( $(this).scrollTop() < total_offset_container ){
		        $('#header').removeClass('is-not-container').addClass('is-container');
		    }
		});

	}

	$('#header').headroom({
	    // vertical offset in px before element is first unpinned
	    offset : offset_container,
	    // scroll tolerance in px before state changes
	    tolerance : 0,
	    // css classes to apply
	    classes : {
	        // when element is initialised
	        initial : "headroom",
	        // when scrolling up
	        pinned : "scrollUp",
	        // when scrolling down
	        unpinned : "scrollDown",
	        // when above offset
	        top : "above-offset",
	        // when below offset
	        notTop : "below-offset"
	    }
	});
};


/* 2. Modal Share
-------------------------------------------------------------------------------------*/
ALICE.modalSharePage = function(){

	if($('.modal-container-share').length > 0 ){

		var l = $('.share-btn-footer').length;
		if ( l > 4 ) {
			$('.modal-share').addClass('five');
		}
		else if ( l > 3 ) {
			$('.modal-share').addClass('four');
		}
		else if ( l > 2 ) {
			$('.modal-share').addClass('three');
		}
		else if ( l > 1 ) {
			$('.modal-share').addClass('two');
		}
		else {
			$('.modal-share').addClass('one');
		}

	}

	$('.open-modal-share').on('click', function(){
		openShareModal();
    });

    $('.header-share, .close-modal-share').on('click', function(){
		closeShareModal();
    });


    /* 2.1 Open Modal
	--------------------------------*/
    function openShareModal(){
		$('html, body').addClass('block-scroll');
		$('.modal-container-share').addClass('open');

		if( Modernizr.mq('(min-width: 320px) and (max-width: 1023px)') ) {
			
			$('.modal-container-share').velocity("fadeIn", { duration: 450, easing: 'easeOutExpo' });
		
		} else {
			
			$('.modal-container-share').velocity("fadeIn", { duration: 450, easing: 'easeOutExpo', complete: function() { 
	       			var delay = 0;
	       			$('.share-btn-footer').each(function(){ 
					    $(this).delay(delay).velocity({ height: "100%"}, { duration: 500, easing: 'easeOutExpo', complete: function() {
					    		$('.share-btn-footer > i').velocity({ opacity: 1 }, 150, 'easeInOutExpo' );
					    	}
					    });
					    delay += 90;
					});
	    		} 
			});

		}
	}


	/* 2.2 Close Modal
	--------------------------------*/
    function closeShareModal(){
    	$('.modal-container-share').removeClass('open');

    	if( Modernizr.mq('(min-width: 320px) and (max-width: 1023px)') ) {

    		$('.modal-container-share').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });
			$('html, body').removeClass('block-scroll');


    	} else {

    		$('.share-btn-footer > i').velocity({ opacity: 0 }, { duration: 300, easing: 'easeInOutExpo', complete: function(){
					$('.share-btn-footer').velocity({ height: "0%"}, { duration: 450, easing: 'easeOutExpo', complete: function() { 
			       			$('.modal-container-share').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });
			       			$('html, body').removeClass('block-scroll');
			       		}
					});
				}
			});

    	}

	}

	/* 2.3 Reset Mobile/Desktop
	--------------------------------*/
	$(window).resize(function(){
		
		if( Modernizr.mq('(min-width: 1024px)') ) {
			if( $('.modal-container-share').hasClass('open') ){
				$('.share-btn-footer').css('height', '100%');
				$('.share-btn-footer > i').css('opacity', '1');
			}
		} else {
			if( $('.modal-container-share').hasClass('open') ){
				$('.share-btn-footer').css('height', '');
				$('.share-btn-footer > i').css('opacity', '');
			} else {
				$('.share-btn-footer').css('height', '');
				$('.share-btn-footer > i').css('opacity', '');
			}
		}

	});
};


/* 3. Modal Search
-------------------------------------------------------------------------------------*/
ALICE.modalSearchPage = function(){
	if($('.modal-container-search').length > 0 ){

		$('.open-modal-search').on('click', function(){
			openSearchModal();
	    });

	    $('.modal-container-search-fake, .close-modal-search').on('click', function(){
			closeSearchModal();
	    });

	}


	/* 3.1 Open Modal
	--------------------------------*/
	function openSearchModal(){
		$('html, body').addClass('block-scroll');

		$('.modal-container-search').css({ visibility: 'visible' });
		$('.modal-container-search').velocity({ opacity: 1, left: 0 }, { duration: 450, easing: 'easeInOutExpo', complete: function() {
				$('#searchform').addClass('ole');

				if( $('body').hasClass('desktop-version') ){
					$('#searchform').find('#search-modal').focus();
				}

			} 
		});
	}


	/* 3.2 Close Modal
	--------------------------------*/
    function closeSearchModal(){
		$('html, body').removeClass('block-scroll');

		$('#searchform').removeClass('ole');
		$('.modal-container-search').velocity({ opacity: 0, left: '105%' }, { delay: 300, duration: 450, easing: 'easeInOutExpo', complete: function() {
				$(this).css({ visibility: 'hidden' });
			    $("#search-modal").val("");
			}
		});
	}
};


/* 4. Full-Screen Section/Title Header
-------------------------------------------------------------------------------------*/
ALICE.fullPageHeight = function(){

	var winH = window.innerHeight ? window.innerHeight:$(window).height();

    $('.full-container').each(function(){
        var elem = $(this),
        	elemH = $('.fake-layer-spacer');

        elemH.css({'height': winH + 'px'});
        elem.css({'height': winH + 'px'});
    });

    $('.section-full-area, .modal-container-search, .modal-container-share').each(function(){
        var elem = $(this);

        elem.css({'height': winH + 'px'});
    });

    // Map Full Area
    if ( $('.az-map.full-area').length > 0) {
	    $('.az-map.full-area').each(function(){
	        var elem = $(this);
	        
	        elem.css({'height': winH + 'px'});
	    });
	}

	// Slider Shortcode Full Area
    if ( $('.az-slider-output.full-area').length > 0) {
	    $('.az-slider-output.full-area').each(function(){
	        var elem = $(this);
	        
	        elem.css({'height': winH + 'px'});
	    });
	}

};


/* 5. Scroll FX
-------------------------------------------------------------------------------------*/
ALICE.fxToScroll = function(){

	// Stop CSS Animation Pattern
	var heightHeader = $('.title-header-container').outerHeight();

	if ( $('.title-header-container.animate-bg-scroll').length > 0) {
		var $div = $('.title-header-container.animate-bg-scroll'),
			heightresult = heightHeader - 150;

		if( $(window).scrollTop() >= heightresult ) {
	        $div.addClass('paused');
		}
		else {
	        $div.removeClass('paused');
	    }

		$(window).scroll(function(){
			if( $(this).scrollTop() >= heightresult ) {
		    	$div.addClass('paused');
			} 
			else {
		        $div.removeClass('paused');
		    }
		});

	}

	// Opacity Scroll Title Headers Text and Scroll Button
	if ( $('.box-content-titles').length > 0) {
		var divs = $('.box-content-titles, .scroll-btn-full-area-title-header'),
	    	outputHeader = heightHeader/2;

	    if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {
	    	$(window).on('scroll', function() {
			   divs.css({ 'opacity' : 1 });
			});
	    } else {
	    	$(window).on('scroll', function() {
			   var st = $(this).scrollTop();
			   divs.css({ 'opacity' : (1 - st/outputHeader) });
			});
	    }
	}
    
    // Parallax Scroll
    if ( $('.title-header-container.imagize-parallax').length > 0) {
	    var parallax_cont = $('.title-header-container.imagize-parallax');
	    if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {
	    	$(window).on('scroll', function() {
			   parallax_cont.css({
			   	"-webkit-transform":"translateY(0px)",
			   	"transform":"translateY(0px)"
			   });
			});
	    } else {
	    	$(window).on('scroll', function() {
			   var st = $(this).scrollTop();
			   parallax_cont.css({
			   	"-webkit-transform":"translateY("+(0 - st/7)+"px)",
			   	"transform":"translateY("+(0 - st/7)+"px)"
			   });
			});
	    }
	}

	/* 5.1 Scroll FX Slider
	--------------------------------*/
	if ( $('#title-header-flexslider').length > 0) {
		scrollFxSlider();
	}

	function scrollFxSlider (){

		var parallax_cont = $('#title-header-flexslider.flexslider .slides > li'),
			elements = $('.scroll-btn-full-area-title-header, #title-header-flexslider.flexslider .slider-content, #title-header-flexslider.flexslider .flex-control-nav'),
			heightHeader = $('.title-header-container').outerHeight(),
	    	outputHeader = heightHeader/2;

		if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {

			// Remove Scroll Effect on Tablet/Mobile Devices
	    	$(window).on('scroll', function() {

			   	// Opacity
			   	elements.css({ 'opacity' : 1 });

			   	// Parallax
			   	if ( $('#title-header-flexslider[data-parallax^="true"]').length > 0) {
			   		parallax_cont.css({
			   			"-webkit-transform":"translateY(0px)",
			   			"transform":"translateY(0px)"
					});
			   	}
			});

	    } else {

	    	// Scroll Effect on Large Devices
	    	$(window).on('scroll', function() {
			    var st = $(this).scrollTop();

			    // Opacity
			    elements.css({ 'opacity' : (1 - st/outputHeader) });

			    // Parallax
			    if ( $('#title-header-flexslider[data-parallax^="true"]').length > 0) {
				   parallax_cont.css({
				   	"-webkit-transform":"translateY("+(0 - st/7)+"px)",
				   	"transform":"translateY("+(0 - st/7)+"px)"
				   });
				}
			});

	    }
		
	}

	/* 5.2 Parallax Section Scroll FX
	--------------------------------*/
	if ( $('.image-parallax-cont').length > 0) {

		var contentSections = $('.img-parallax-layer');

		if( !Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {
			updateNavigation();

			contentSections.each(function(){
				var pos = ( $(window).scrollTop() - $(this).offset().top );
				$(this).css({
					"-webkit-transform":"translateY("+(pos/7)+"px)",
					"transform":"translateY("+(pos/7)+"px)"
				});
			});

			$(window).on('scroll', function(){
				updateNavigation();
			});
		}

	}

	function updateNavigation() {
		contentSections.each(function(){
			if ( ( $(this).offset().top + $(this).outerHeight() < $(window).scrollTop() ) || ( $(this).offset().top > $(window).scrollTop() + $(window).height() ) ) {
				$(this).addClass('parallax-stop').removeClass('parallax-start');
			} else {
				$(this).addClass('parallax-start').removeClass('parallax-stop');
				var pos = ( $(window).scrollTop() - $(this).offset().top );
				$(this).css({
					"-webkit-transform":"translateY("+(pos/7)+"px)",
					"transform":"translateY("+(pos/7)+"px)"
				});
			}
		});
	}
    
};


/* 6. Scroll Button Full-Screen Areas
-------------------------------------------------------------------------------------*/
ALICE.scrollBtnFullArea = function(){
	// Section 
	if ( $('.scroll-btn-full-area, .az-smooth-scroll').length > 0) {
		$('.scroll-btn-full-area, .az-smooth-scroll, .az-smooth-scroll > a').on('click', function() {
		    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
		        var target = $(this.hash);
		        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		           if (target.length) {
		            $('html,body').animate({
		                 scrollTop: target.offset().top
		            }, 850, 'easeInOutExpo');
		            return false;
		        }
		    }
		});
	}

	// Title Header
	if ( $('.scroll-btn-full-area-title-header').length > 0) {
		$('.scroll-btn-full-area-title-header').on('click', function() {
			$('html,body').animate({scrollTop: $('.wrap_content').first().offset().top}, 850, 'easeInOutExpo');
		});
	}
};

ALICE.scrollDotsNavigation = function(){

	if ( $('.dots-menu-navigation').length > 0) {

		var contentSections = $('.master-section-content'),
			navigationItems = $('#vertical-dots-menu a');

		updateNavigation();
		removeDots();

		$(window).on('scroll', function(){
			updateNavigation();
		});

		//smooth scroll to the section
		navigationItems.on('click', function(event){
        	event.preventDefault();
        	smoothScroll($(this.hash));
    	});

	}

	function removeDots() {

		if ( $('#slider-header-revolution').length > 0) {

			$('.dots-menu-navigation').css('zIndex', '-1');

			var offset_container = 0;

			offset_container = $('.wrap-title-header').outerHeight() / 2;

			$(window).resize(function() {
				offset_container = $('.wrap-title-header').outerHeight() / 2;
			});


			if( $(window).scrollTop() > offset_container ) {
		        $('.dots-menu-navigation').css('zIndex', '30');
			} 
			else if( $(window).scrollTop() < offset_container ){
		        $('.dots-menu-navigation').css('zIndex', '-1');
		    }

			$(window).scroll(function(){
				if( $(window).scrollTop() > offset_container ) {
			        $('.dots-menu-navigation').css('zIndex', '30');
				} 
				else if( $(window).scrollTop() < offset_container ){
			        $('.dots-menu-navigation').css('zIndex', '-1');
			    }
			});

		}
	}

	function updateNavigation() {
		contentSections.each(function(){
			var activeSection = $('#vertical-dots-menu a[href="#'+$(this).attr('id')+'"]').data('number') - 1;
			if ( ( $(this).offset().top - $(window).height()/2 < $(window).scrollTop() ) && ( $(this).offset().top + $(this).outerHeight() - $(window).height()/2 > $(window).scrollTop() ) ) {

				navigationItems.eq(activeSection).addClass('is-selected');

				if ( $(this).hasClass('light-detect') ) {
					$('.dots-menu-navigation').addClass('dark').removeClass('light no-detect');
				}
				else if ( $(this).hasClass('dark-detect') ) {
					$('.dots-menu-navigation').addClass('light').removeClass('dark no-detect');
				}
				else {
					// Nothing
					$('.dots-menu-navigation').addClass('no-detect').removeClass('light dark')
				}

			} else {
				navigationItems.eq(activeSection).removeClass('is-selected');
			}
		});
	}

	function smoothScroll(target) {
		$('html,body').animate({
             scrollTop: target.offset().top
        }, 850, 'easeInOutExpo');
	}

};


/* 7. AZ Slider Title Headers
-------------------------------------------------------------------------------------*/
ALICE.azSlider = function(){

	var $slider_id = $('#title-header-flexslider');

	var animation_type = $slider_id.data('slide-type'),
		animation_speed = $slider_id.data('slide-speed'), 
		slideshow = $slider_id.data('slideshow'),
		slideshow_speed = $slider_id.data('slideshow-speed'),
		easing = $slider_id.data('slide-easing'),
		loop = $slider_id.data('slide-loop');

	$('#title-header-flexslider').flexslider({
		animation: animation_type,
		easing: easing,
		animationLoop: loop,
		slideshow: slideshow,
		slideshowSpeed: slideshow_speed,
		animationSpeed: animation_speed,
		initDelay: 0,
		pauseOnAction: true,
		pauseOnHover: false,
		useCSS: true,
		touch: true,
		controlNav: true,
		directionNav: false,
		manualControls: ".flex-control-nav li a"                     
	});
};

ALICE.azSliderShortcode = function(){
	
	if($('.az-slider-output').length > 0) {

		$('.az-slider-output').each(function(){

			var slider,
				$slider_g = $(this);

            var animation_type = $slider_g.data('slide-type'),
				slideshow = $slider_g.data('slideshow'),
				easing = $slider_g.data('slide-easing'),
				loop = $slider_g.data('slide-loop');

			$slider_g.flexslider({
				animation: animation_type,
				easing: easing,
				animationLoop: loop,
				slideshow: slideshow,
				animationSpeed: 600,
				initDelay: 0,
				pauseOnAction: true,
				pauseOnHover: false,
				useCSS: true,
				touch: true,
				controlNav: true,
				directionNav: false                  
			});

		});
	}

};


/* 8. MediaElements
-------------------------------------------------------------------------------------*/
ALICE.mediaElements = function(){
	$('.desktop-version .video-section-container.self-hosted-video .video-wrap').each(function(){
		var min_w = 1500,
			header_height = 0,
			vid_w_orig = 600,
			vid_h_orig = 400;
	    
	    var f = $(this).closest('.video-section-container').outerWidth(),
	    	e = $(this).closest('.video-section-container').outerHeight();

	    $(this).width(f);
	    $(this).height(e);

	    var a = f / vid_w_orig,
	    	d = (e - header_height) / vid_h_orig,
	    	c = a > d ? a : d;
	    
	    min_w = 1280 / 720 * (e + 20);
	    
	    if (c * vid_w_orig < min_w) {
	        c = min_w / vid_w_orig;
	    }
	    
	    $(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(c * vid_w_orig + 2));
	    $(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(c * vid_h_orig + 2));
	    $(this).scrollLeft(($(this).find("video").width() - f) / 2);
	    $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find("video").height() - (e)) / 2);
	    $(this).scrollTop(($(this).find('video').height() - (e)) / 2);
	});

	// For title header only
	if ( $('.desktop-version #video-header.self_hosted').length > 0) {

		var video_ID = $('video.video-header').attr('id'),
			video_image_fallback = $('.video-section-container.self-hosted-video').find('.no-autoplay-video-fallback-image-self');

		new MediaElement(video_ID, {
		    defaultVideoWidth: 480,
		    defaultVideoHeight: 270,
		    videoWidth: -1,
		    videoHeight: -1,
		    pluginPath: theme_objects.base + '/_include/js/mediaelement/',
		    flashName: 'flashmediaelement.swf',
		    silverlightName: 'silverlightmediaelement.xap',
		    enableAutosize: true,
		    alwaysShowControls: false,
		    iPadUseNativeControls: false,
		    iPhoneUseNativeControls: false,
		    AndroidUseNativeControls: false,
		    alwaysShowHours: false,
		    showTimecodeFrameCount: false,
		    framesPerSecond: 25,
		    enableKeyboard: true,
		    pauseOtherPlayers: false,
		    keyActions: [],
		    success: function (media) { 

		    	if( $('video.video-header[data-volume^="mute"]').length > 0) {
		    		media.setMuted(true);
		    	}

		    	if( $('video.video-header[data-autoplay^="true"]').length > 0) {
		    		media.play();
		    		scrollPlayPauseVideo();
		    	}

		    	activateVideoClick();
		    	reactivateVideoClick();
		    	playPauseBgSelfClick();
		    	menuPlayPauseSelf();

		    	function activateVideoClick(){
		    		$('.self_player_button').on('click', function(e){
		    			$(window).on('scroll.player_self_scroll', scrollPlayPauseVideo(media));
                        $('.self_player_button').addClass('playButtonAnimation').removeClass('playButtonAnimationReverse');

		    			if ($('.box-content').length > 0) {
		    				$('.video-header-status-self').removeClass('pause').addClass('play');
                        	$('.box-content').velocity({ opacity: 0 }, { visibility: "hidden" }, { duration: 1000 }); 
                        }

                        video_image_fallback.addClass('played');

                        setTimeout(function() {
                        	media.play();
                        }, 450);
                        e.preventDefault();
                	});
		    	}

		    	function reactivateVideoClick(){
		    		media.addEventListener('ended', function(){
		    			$(window).off('scroll.player_self_scroll', scrollPlayPauseVideo(media));
		    			$('.self_player_button').css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');

		    			if ( $('.box-content').length > 0) {
		    				$('.video-header-status-self').removeClass('play').addClass('pause');
		    				$('.box-content').velocity({ opacity: 1 }, { visibility: "visible" }, { duration: 1000 }); 
		    			}

                        video_image_fallback.removeClass('played');

		                setTimeout(function() {
		                	$('.self_player_button').removeClass('playButtonAnimationReverse').css({ visibility:''});
		                }, 950);
		    		});
		    	}

				function scrollPlayPauseVideo(){
					var offset_container = $('.wrap-title-header').outerHeight() - 150;

					$( window ).resize(function() {
						offset_container = $('.wrap-title-header').outerHeight() - 150;
					});

					if( $(window).scrollTop() > offset_container ) {
				        $('.video-header-status-self').removeClass('play').addClass('pause');
					    media.pause();
					}

					$(window).on('scroll.player_self_scroll', function(){
						if( $(this).scrollTop() > offset_container ) {
							$('.video-header-status-self').removeClass('play').addClass('pause');
							media.pause();
						} 
						else if( $(window).scrollTop() < offset_container ){
							$('.video-header-status-self').removeClass('pause').addClass('play');
							media.play();
						}
					});
				}

				function menuPlayPauseSelf(){

					var header_menu = $('#header'),
						optional_menu = $('.optional-menu'),
						video_block = $('.video-header-status-self');

					header_menu.on('menuEvent', function() {
						if( $(this).hasClass('menu-open') || $('.video-header-status-self').hasClass('pause') ) {
							media.pause();
						}
						else {
							media.play();
						}
					});

					$('.menu-trigger, .menu-trigger-close, #blocker').click(function(){
						header_menu.trigger('menuEvent');
					});

					/* Share and Search */
					optional_menu.on('openOptionalEvent', function() {
						if( $('.video-header-status-self').hasClass('play') ) {
							media.pause();
						} else {
							media.pause();
						}
					});

					$('.open-modal-share, .open-modal-search').click(function(){
						optional_menu.trigger('openOptionalEvent');
					});

					optional_menu.on('closeOptionalEvent', function(){
						if( $('.video-header-status-self').hasClass('play') ) {
							setTimeout(function(){
								media.play();
							}, 700);
						} else {
							media.pause();
						}
					});

					$('.header-share, .close-modal-share, .modal-container-search-fake, .close-modal-search').click(function(){
						optional_menu.trigger('closeOptionalEvent');
					});

				}

		    	function playPauseBgSelfClick(){
		    		if ($('.video-header-status-self').length > 0) {

		    			var video_block = $('.video-header-status-self'),
		    				button_player = 0;

		    			if ($('.box-content').length > 0) {
                        	button_player = $('.self_player_button');
                        } else {
                        	button_player = video_block.find('.self_player_button');
                        }

                        video_block.on('click', function() {
                            $(this).toggleClass('play pause');

                            if($(this).hasClass('play')) {
                                media.play();
                            	button_player.addClass('playButtonAnimation').removeClass('playButtonAnimationReverse').css({ visibility:''});

                            	if ($('.box-content').length > 0) {
		                        	$('.box-content').velocity({ opacity: 0 }, { visibility: "hidden" }, { duration: 1000 }); 
		                        }

		                        if( !video_image_fallback.hasClass('played') ){
									video_image_fallback.addClass('played');
								}

                            	$(window).on('scroll.player_self_scroll', scrollPlayPauseVideo(media));
                            } else {
                                media.pause();
                                button_player.css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');

                                if ($('.box-content').length > 0) {
		                        	$('.box-content').velocity({ opacity: 1 }, { visibility: "visible" }, { duration: 1000 }); 
		                        }

                                $(window).off('scroll.player_self_scroll', scrollPlayPauseVideo(media));
                            }
                        });

                        media.addEventListener('ended', function(){
                        	video_block.removeClass('play').addClass('pause');
                        });

		    		}
		    	}		         
		    }
		});
	}

	// For Section Page Self-Hosted Video Background
	if ($('.desktop-version.main-content > .video-section-container.self-hosted-video').length > 0) {	

		$('video.video-section.decorative_video_self_hosted').each(function(){
			var video_dec_ID = $(this).attr('id');

			new MediaElement(video_dec_ID, {
			    defaultVideoWidth: 480,
			    defaultVideoHeight: 270,
			    videoWidth: -1,
			    videoHeight: -1,
			    pluginPath: theme_objects.base + '/_include/js/mediaelement/',
			    flashName: 'flashmediaelement.swf',
			    silverlightName: 'silverlightmediaelement.xap',
			    loop: true,
			    enableAutosize: true,
			    alwaysShowControls: false,
			    iPadUseNativeControls: false,
			    iPhoneUseNativeControls: false,
			    AndroidUseNativeControls: false,
			    alwaysShowHours: false,
			    showTimecodeFrameCount: false,
			    framesPerSecond: 25,
			    enableKeyboard: true,
			    pauseOtherPlayers: false,
			    keyActions: [],
			    success: function (media) { 

			    	media.setMuted(true);
			    	media.play();
	         
			    }
			});
		});

		$('video.video-section.play_pause_video_self_hosted').each(function(){
			var video_section_ID = $(this).attr('id'),
				button_global_ID = $(this).closest('.video-section-container.self-hosted-video').find('.self_player_section_button'),
				video_block_global_ID = $(this).closest('.video-section-container.self-hosted-video').find('.video-status-self'),
				video_image_fallback = $(this).closest('.video-section-container.self-hosted-video').find('.no-autoplay-video-fallback-image-self');

			new MediaElement(video_section_ID, {
			    defaultVideoWidth: 480,
			    defaultVideoHeight: 270,
			    videoWidth: -1,
			    videoHeight: -1,
			    pluginPath: theme_objects.base + '/_include/js/mediaelement/',
			    flashName: 'flashmediaelement.swf',
			    silverlightName: 'silverlightmediaelement.xap',
			    loop: false,
			    enableAutosize: true,
			    alwaysShowControls: false,
			    iPadUseNativeControls: false,
			    iPhoneUseNativeControls: false,
			    AndroidUseNativeControls: false,
			    alwaysShowHours: false,
			    showTimecodeFrameCount: false,
			    framesPerSecond: 25,
			    enableKeyboard: true,
			    pauseOtherPlayers: false,
			    keyActions: [],
			    success: function (mediaSection) { 

			    	activateVideoSectionClick();
			    	reactivateVideoSectionClick();
			    	playPauseVideoSectionClick();

			    	function activateVideoSectionClick(){
			    		button_global_ID.on('click', function(e){
							button_global_ID.addClass('playButtonAnimation hided').removeClass('playButtonAnimationReverse');
							
							video_image_fallback.addClass('played');

							setTimeout(function() {
								mediaSection.play();
							}, 450);
							e.preventDefault();
						});
			    	}

			    	function reactivateVideoSectionClick(){
			    		mediaSection.addEventListener('ended', function(){
			    			$('.self_player_section_button.hided').css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');
			    			
			    			video_image_fallback.removeClass('played');
			                
			                setTimeout(function() {
			                	$('.self_player_section_button').removeClass('playButtonAnimationReverse hided').css({ visibility:''});
			                }, 950);
			    		});
			    	}

			    	function playPauseVideoSectionClick(){
						if ($('.video-status-self').length > 0) {
							var button_player = video_block_global_ID.find('.self_player_section_button');

							video_block_global_ID.on('click', function(){
								$(this).toggleClass('play pause');

								if($(this).hasClass('play')) {

									if( !video_image_fallback.hasClass('played') ){
										video_image_fallback.addClass('played');
									}

						        	mediaSection.play();
						        	button_player.addClass('playButtonAnimation hided').removeClass('playButtonAnimationReverse').css({ visibility:''});
							    } else {
						        	mediaSection.pause();
						        	button_player.css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation hided');
							    }
							});

							mediaSection.addEventListener('ended', function(){
	                        	video_block_global_ID.removeClass('play').addClass('pause');
	                        });
						}
					}
	         
			    }
			});
		});
		
	}

	// For Sections	Shorcodes
	$('audio.audio-shortcode, video.video-shortcode').each(function(){
		var volume_set = $(this).data('volume');
	    $(this).mediaelementplayer({
		    defaultVideoWidth: 480,
		    defaultVideoHeight: 270,
		    videoWidth: -1,
		    videoHeight: -1,
		    audioWidth: 400,
		    audioHeight: 50,
		    startVolume: volume_set,
		    pluginPath: theme_objects.base + '/_include/js/mediaelement/',
		    flashName: 'flashmediaelement.swf',
		    silverlightName: 'silverlightmediaelement.xap',
		    loop: false,
		    enableAutosize: true,
		    alwaysShowControls: false,
		    iPadUseNativeControls: false,
		    iPhoneUseNativeControls: false,
		    AndroidUseNativeControls: false,
		    alwaysShowHours: false,
		    showTimecodeFrameCount: false,
		    framesPerSecond: 25,
		    enableKeyboard: false,
		    pauseOtherPlayers: false,
		    keyActions: []
	    });
	});

};

ALICE.ResizeSelfHostedBackgroundVideo = function(){
	$('.desktop-version .video-section-container.self-hosted-video .video-wrap').each(function(){
		var min_w = 1500,
			header_height = 0,
			vid_w_orig = 600,
			vid_h_orig = 400;
	    
	    var f = $(this).closest('.video-section-container').outerWidth(),
	    	e = $(this).closest('.video-section-container').outerHeight();
	    
	    $(this).width(f);
	    $(this).height(e);
	    
	    var a = f / vid_w_orig,
	    	d = (e - header_height) / vid_h_orig,
	    	c = a > d ? a : d;
	    
	    min_w = 1280 / 720 * (e + 20);
	    
	    if (c * vid_w_orig < min_w) {
	        c = min_w / vid_w_orig;
	    }
	    
	    $(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(c * vid_w_orig + 2));
	    $(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(c * vid_h_orig + 2));
	    $(this).scrollLeft(($(this).find('video').width() - f) / 2);
	    $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - (e)) / 2);
	    $(this).scrollTop(($(this).find('video').height() - (e)) / 2);
	});
};


/* 9. Vimeo
-------------------------------------------------------------------------------------*/
ALICE.VimeoPlayerInit = function(){

	$('.desktop-version .video-section-container.vimeo-video .video-embed-wrap').each(function(){
		var win = {};
		var el = $(this);
		var player_box = $(this).find('iframe');
		win.width = el.outerWidth();
		win.height = el.outerHeight();
		var margin = 24;
		var overprint = 100;
		var vid = {};

		var f = $(this).closest('.video-section-container').outerWidth(),
	     	e = $(this).closest('.video-section-container').outerHeight();

		$(this).width(f);
	    $(this).height(e);

		vid.width = win.width + ((win.width * margin) / 100);
		vid.height = Math.ceil((9 * win.width) / 16);
		vid.marginTop = -((vid.height - win.height) / 2);
		vid.marginLeft = -((win.width * (margin / 2)) / 100);

		if (vid.height < win.height) {
			vid.height = win.height + ((win.height * margin) / 100);
			vid.width = Math.floor((16 * win.height) / 9);
			vid.marginTop = -((win.height * (margin / 2)) / 100);
			vid.marginLeft = -((vid.width - win.width) / 2);
		}

		vid.width += overprint;
		vid.height += overprint;
		vid.marginTop -= overprint / 2;
		vid.marginLeft -= overprint / 2;

		player_box.css({width: vid.width, height: vid.height, marginTop: vid.marginTop, marginLeft: vid.marginLeft});	
	});

	// For Title Header Only
	if ( $('.desktop-version #video-header.vimeo_embed_code').length > 0) {

		// If present preloader start video after 2000ms
		if($('#preloader-container').length > 0){
			setTimeout(function(){
				$('iframe.vimeo.video-header').each(function(){
			        Froogaloop(this).addEvent('ready', ready );
			        menuPlayPause();
			        playPauseBgVClick();
			    });
			}, 2000);
		} else {
			$('iframe.vimeo.video-header').each(function(){
		        Froogaloop(this).addEvent('ready', ready );
		        menuPlayPause();
		        playPauseBgVClick();
		    });
		}

	}

	function ready(playerID){
    	// Variables
    	var volume_set = $('iframe.vimeo.video-header').data('volume'),
    		loop_set = $('iframe.vimeo.video-header').data('loop');

        // Add event listerns
       	if( $('iframe.vimeo.video-header[data-autoplay^="false"][data-loop^="0"]').length > 0) {
        	Froogaloop(playerID).addEvent('play', activateVideoClick(playerID));
        	Froogaloop(playerID).addEvent('finish', function(){
				reActivateVideoClick();
				$(window).off('scroll.player_vimeo_scroll', scrollPlayPause(playerID));
			});
        }

        else if( $('iframe.vimeo.video-header[data-autoplay^="false"][data-loop^="1"]').length > 0) {
        	Froogaloop(playerID).addEvent('play', activateVideoClick(playerID));
        }
        
        else if( $('iframe.vimeo.video-header[data-autoplay^="true"][data-loop^="0"]').length > 0) {
        	Froogaloop(playerID).api('play');

        	Froogaloop(playerID).addEvent('play', activateVideoClick(playerID));
        	Froogaloop(playerID).addEvent('finish', function(){
				reActivateVideoClick();
				$(window).off('scroll.player_vimeo_scroll', scrollPlayPause(playerID));
			});
			scrollPlayPause(playerID);
        }

        else if( $('iframe.vimeo.video-header[data-autoplay^="true"][data-loop^="1"]').length > 0) {
        	Froogaloop(playerID).api('play');
        	Froogaloop(playerID).addEvent('play', activateVideoClick(playerID));
        	scrollPlayPause(playerID);
        }
        
        // Fire an API method
        Froogaloop(playerID).api("setVolume", volume_set );
        Froogaloop(playerID).api("setLoop", loop_set);

    }

    function activateVideoClick(playerID){
    	$('.vimeo_player_button').on('click', function(e){
    		$(window).on('scroll.player_vimeo_scroll', scrollPlayPause(playerID));

			$('.vimeo_player_button').addClass('playButtonAnimation hided').removeClass('playButtonAnimationReverse');

			if ($('.box-content').length > 0) {
				$('.video-header-status-vimeo').removeClass('pause').addClass('play');
            	$('.box-content').velocity({ opacity: 0 }, { visibility: "hidden" }, { duration: 1000 }); 
            }

			setTimeout(function() {
				Froogaloop(playerID).api('play');
			}, 450);
			e.preventDefault();
		});

    }

    function reActivateVideoClick(){
    	$('.video-header-status-vimeo').removeClass('play').addClass('pause');
    	$('.vimeo_player_button.hided').css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');

		if ($('.box-content').length > 0) {
        	$('.box-content').velocity({ opacity: 1 }, { visibility: "visible" }, { duration: 1000 }); 
        }

    	setTimeout(function() {
			$('.vimeo_player_button').removeClass('playButtonAnimationReverse hided').css({ visibility:''});
		}, 950);
	}

	function scrollPlayPause(playerID){
		var offset_container = $('.wrap-title-header').outerHeight() - 150;

		$( window ).resize(function() {
			offset_container = $('.wrap-title-header').outerHeight() - 150;
		});

		if( $(window).scrollTop() > offset_container ) {
	        $('.video-header-status-vimeo').removeClass('play').addClass('pause');
		    Froogaloop(playerID).api('pause');
		}

		$(window).on('scroll.player_vimeo_scroll', function(){
			if( $(this).scrollTop() > offset_container ) {
		        $('.video-header-status-vimeo').removeClass('play').addClass('pause');
		        Froogaloop(playerID).api('pause');
			} 
			else if( $(window).scrollTop() < offset_container ){
				$('.video-header-status-vimeo').removeClass('pause').addClass('play');
		        Froogaloop(playerID).api('play');
		    }
		});
	}

	function menuPlayPause(){

		var header_menu = $('#header'),
			optional_menu = $('.optional-menu'),
			video_block = $('.video-header-status-vimeo'),
			player_video_ID = video_block.data('videovimeocheck');

		header_menu.on('menuEvent', function() {
			if( $(this).hasClass('menu-open') || $('.video-header-status-vimeo').hasClass('pause') ) {
				Froogaloop(player_video_ID).api('pause');
			}
			else {
				Froogaloop(player_video_ID).api('play');
			}
		});

		$('.menu-trigger, .menu-trigger-close, #blocker').click(function(){
			header_menu.trigger('menuEvent');
		});

		/* Share and Search */
		optional_menu.on('openOptionalEvent', function() {
			if( $('.video-header-status-vimeo').hasClass('play') ) {
				Froogaloop(player_video_ID).api('pause');
			} else {
				Froogaloop(player_video_ID).api('pause');
			}
		});

		$('.open-modal-share, .open-modal-search').click(function(){
			optional_menu.trigger('openOptionalEvent');
		});

		optional_menu.on('closeOptionalEvent', function(){
			if( $('.video-header-status-vimeo').hasClass('play') ) {
				setTimeout(function(){
					Froogaloop(player_video_ID).api('play');
				}, 700);
			} else {
				Froogaloop(player_video_ID).api('pause');
			}
		});

		$('.header-share, .close-modal-share, .modal-container-search-fake, .close-modal-search').click(function(){
			optional_menu.trigger('closeOptionalEvent');
		});

	}

	function playPauseBgVClick(){
		if ($('.video-header-status-vimeo').length > 0) {
						
			var video_block = $('.video-header-status-vimeo'),
				player_video_ID = video_block.data('videovimeocheck'),
				button_player = 0;

			if ($('.box-content').length > 0) {
            	button_player = $('.vimeo_player_button');
            } else {
            	button_player = video_block.find('.vimeo_player_button');
            }

			video_block.on('click', function() {
				$(this).toggleClass('play pause');

				if($(this).hasClass('play')) {
		        	Froogaloop(player_video_ID).api('play');
		        	button_player.addClass('playButtonAnimation hided').removeClass('playButtonAnimationReverse').css({ visibility:''});

		        	if ($('.box-content').length > 0) {
                    	$('.box-content').velocity({ opacity: 0 }, { visibility: "hidden" }, { duration: 1000 }); 
                    }

		        	$(window).on('scroll.player_vimeo_scroll', scrollPlayPause(player_video_ID));
			    } else {
		        	Froogaloop(player_video_ID).api('pause');
		        	button_player.css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation hided');

		        	if ($('.box-content').length > 0) {
                    	$('.box-content').velocity({ opacity: 1 }, { visibility: "visible" }, { duration: 1000 }); 
                    }

		        	$(window).off('scroll.player_vimeo_scroll', scrollPlayPause(player_video_ID));
			    }
			});

		}
	}


	// For Section Page Vimeo Video Background
	if ($('.desktop-version.main-content > .video-section-container.vimeo-video').length > 0) {	

		$('iframe.vimeo.video-section.decorative_video_vimeo').each(function(){
	        Froogaloop(this).addEvent('ready', decorativeReady);
	    });
	    $('iframe.vimeo.video-section.play_pause_video_vimeo').each(function(){
	        Froogaloop(this).addEvent('ready', playPauseReady);
	    });

	}

	function decorativeReady(playerID){
        Froogaloop(playerID).api('play');

        Froogaloop(playerID).api("setVolume", 0 );
        Froogaloop(playerID).api("setLoop", 1);
	}

	function playPauseReady(playerID){
        Froogaloop(playerID).addEvent('play', play() );
		Froogaloop(playerID).addEvent('finish', onFinish );

        Froogaloop(playerID).api("setVolume", 1 );
        Froogaloop(playerID).api("setLoop", 0);
	}

	function play(){
		$('.vimeo_player_Section_button').each(function(){	
			var button_playerID = $(this),
				video_playerID = $(this).data('videoid');

			// Animation Button / Play Video
    		button_playerID.on('click', function(e){
				button_playerID.addClass('playButtonAnimation hided').removeClass('playButtonAnimationReverse');

				setTimeout(function() {
					Froogaloop(video_playerID).api('play');
				}, 450);
				e.preventDefault();
			});
		});
	}

	function onFinish(playerID){
		$('.video-status-vimeo').removeClass('play').addClass('pause');
    	$('.vimeo_player_Section_button.hided').css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');
    	setTimeout(function() {
			$('.vimeo_player_Section_button').removeClass('playButtonAnimationReverse hided').css({ visibility:''});
		}, 950);
	}

	function playPauseSectionVClick(){
		if ($('.video-status-vimeo').length > 0) {

			$('.video-status-vimeo').each(function(){				
				var video_block = $(this),
					player_video_ID = video_block.data('videovimeocheck'),
					button_player = video_block.find('.vimeo_player_Section_button');

				video_block.on('click', function() {

					$(this).toggleClass('play pause');

					if($(this).hasClass('play')) {
			        	Froogaloop(player_video_ID).api('play');
			        	button_player.addClass('playButtonAnimation hided').removeClass('playButtonAnimationReverse').css({ visibility:''});
				    } else {
			        	Froogaloop(player_video_ID).api('pause');
			        	button_player.css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation hided');
				    }

				});
			});

		}
	}
	playPauseSectionVClick();

};

ALICE.ResizeVimeoBackgroundVideo = function(){
	$('.desktop-version .video-section-container.vimeo-video .video-embed-wrap').each(function(){
		
		var win = {};
		var el = $(this);
		var player_box = $(this).find('iframe');
		win.width = el.outerWidth();
		win.height = el.outerHeight();
		var margin = 24;
		var overprint = 100;
		var vid = {};

		var f = $(this).closest(".video-section-container").outerWidth(),
	     	e = $(this).closest(".video-section-container").outerHeight();

		$(this).width(f);
	    $(this).height(e);

		vid.width = win.width + ((win.width * margin) / 100);
		vid.height = Math.ceil((9 * win.width) / 16);
		vid.marginTop = -((vid.height - win.height) / 2);
		vid.marginLeft = -((win.width * (margin / 2)) / 100);

		if (vid.height < win.height) {
			vid.height = win.height + ((win.height * margin) / 100);
			vid.width = Math.floor((16 * win.height) / 9);
			vid.marginTop = -((win.height * (margin / 2)) / 100);
			vid.marginLeft = -((vid.width - win.width) / 2);
		}

		vid.width += overprint;
		vid.height += overprint;
		vid.marginTop -= overprint / 2;
		vid.marginLeft -= overprint / 2;

		player_box.css({width: vid.width, height: vid.height, marginTop: vid.marginTop, marginLeft: vid.marginLeft});
		
    });
};


/* 10. Youtube
-------------------------------------------------------------------------------------*/
ALICE.YoutubeBackgroundVideo = function(){

	// For Title Header Only
	if ( $('.desktop-version #video-header.youtube_url').length > 0) {

		$('.player_YT_Mod').mb_YTPlayer();

		activateVideoClickTitleHeader();
		reActivateVideoClickTitleHeader();
		menuPlayPauseYT();

		if($('.player_YT_Mod[data-autoplay^="true"]').length > 0) {
			scrollPlayPauseTitleHeader();
			menuPlayPauseYT();
		}

	}

	// Functions for Video Title Header Only
	function activateVideoClickTitleHeader(){
		var player_video_ID = $('.player_YT_Mod');

		$('.player_YT_Mod_button').on('click', function(e){
			$(window).on('scroll.player_youtube_scroll', scrollPlayPauseTitleHeader(player_video_ID));
			$('.player_YT_Mod_button').addClass('playButtonAnimation').removeClass('playButtonAnimationReverse');

			if ($('.box-content').length > 0) {
				$('.video-header-status-youtube').removeClass('pause').addClass('play');
            	$('.box-content').velocity({ opacity: 0 }, { visibility: "hidden" }, { duration: 1000 }); 
            }

			setTimeout(function() {
				player_video_ID.playYTP();
			}, 450);
			e.preventDefault();
		});
	}

	function reActivateVideoClickTitleHeader(){
		var player_video_ID = $('.player_YT_Mod');

		player_video_ID.on("YTPEnd",function(){
			$(window).off('scroll.player_youtube_scroll', scrollPlayPauseTitleHeader(player_video_ID));
			$('.player_YT_Mod_button').css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');

			if ($('.box-content').length > 0) {
				$('.video-header-status-youtube').removeClass('play').addClass('pause');
            	$('.box-content').velocity({ opacity: 1 }, { visibility: "visible" }, { duration: 1000 }); 
            }

	    	setTimeout(function() {
				$('.player_YT_Mod_button').removeClass('playButtonAnimationReverse').css({ visibility:''});
			}, 950);
		});
	}

	function scrollPlayPauseTitleHeader(){

		var offset_container = $('.wrap-title-header').outerHeight() - 150;

		$(window).resize(function() {
			offset_container = $('.wrap-title-header').outerHeight() - 150;
		});

		if( $(window).scrollTop() > offset_container ) {
	        $('.video-header-status-youtube').removeClass('play').addClass('pause');
		    $('.player_YT_Mod').pauseYTP();
		}

		$('.player_YT_Mod').on("YTPStart",function(){
			$(window).on('scroll.player_youtube_scroll', function(){
				if( $(this).scrollTop() > offset_container ) {
					$('.video-header-status-youtube').removeClass('play').addClass('pause');
			        $('.player_YT_Mod').pauseYTP();
				} 
				else if( $(window).scrollTop() < offset_container ){
					$('.video-header-status-youtube').removeClass('pause').addClass('play');
			        $('.player_YT_Mod').playYTP();
			    }
			});
		});
	}

	function menuPlayPauseYT(){

		var header_menu = $('#header'),
			optional_menu = $('.optional-menu'),
			video_block = $('.video-header-status-youtube');

		header_menu.on('menuEvent', function() {
			if( $(this).hasClass('menu-open') || $('.video-header-status-youtube').hasClass('pause') ) {
				$('.player_YT_Mod').pauseYTP();
			}
			else {
				$('.player_YT_Mod').playYTP();
			}
		});

		$('.menu-trigger, .menu-trigger-close, #blocker').click(function(){
			header_menu.trigger('menuEvent');
		});

		/* Share and Search */
		optional_menu.on('openOptionalEvent', function() {
			if( $('.video-header-status-youtube').hasClass('play') ) {
				$('.player_YT_Mod').pauseYTP();
			} else {
				$('.player_YT_Mod').pauseYTP();
			}
		});

		$('.open-modal-share, .open-modal-search').click(function(){
			optional_menu.trigger('openOptionalEvent');
		});

		optional_menu.on('closeOptionalEvent', function(){
			if( $('.video-header-status-youtube').hasClass('play') ) {
				setTimeout(function(){
					$('.player_YT_Mod').playYTP();
				}, 700);
			} else {
				$('.player_YT_Mod').pauseYTP();
			}
		});

		$('.header-share, .close-modal-share, .modal-container-search-fake, .close-modal-search').click(function(){
			optional_menu.trigger('closeOptionalEvent');
		});

	}

	function playPauseBgYTclick(){
		if ($('.video-header-status-youtube').length > 0) {
				
			var player_video_ID = $('.player_YT_Mod'),
				video_block = $('.video-header-status-youtube'),
				button_player = 0;

			if ($('.box-content').length > 0) {
            	button_player = $('.player_YT_Mod_button');
            } else {
            	button_player = video_block.find('.player_YT_Mod_button');
            }

			video_block.on('click', function() {
				$(this).toggleClass('play pause');

				if($(this).hasClass('play')) {
					$(player_video_ID).playYTP();
		        	button_player.addClass('playButtonAnimation').removeClass('playButtonAnimationReverse').css({ visibility:''});

		        	if ($('.box-content').length > 0) {
                    	$('.box-content').velocity({ opacity: 0 }, { visibility: "hidden" }, { duration: 1000 }); 
                    }

		        	$(window).on('scroll.player_youtube_scroll', scrollPlayPauseTitleHeader(player_video_ID));
			    } else {
		        	$(player_video_ID).pauseYTP();
		        	button_player.css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');

		        	if ($('.box-content').length > 0) {
                    	$('.box-content').velocity({ opacity: 1 }, { visibility: "visible" }, { duration: 1000 }); 
                    }

		        	$(window).off('scroll.player_youtube_scroll', scrollPlayPauseTitleHeader(player_video_ID));
			    }
			});

			$(player_video_ID).on("YTPEnd",function(){
				video_block.removeClass('play').addClass('pause');
			});

		}
	}
	playPauseBgYTclick();

	// For Section Page Youtube Video Background
	if ( $('.desktop-version.main-content > .video-section-container.youtube-video').length > 0) {
		$('.player_YT_Mod_section.decorative_video_youtube').each(function(){
	        $(this).mb_YTPlayer();
	    });

	    $('.player_YT_Mod_section.play_pause_video_youtube').each(function(){
	    	var playerID = $(this).data('player');

	    	$('#'+playerID).mb_YTPlayer();
	    	activateVideoClickSection();
	    });
	}

	function activateVideoClickSection(){
		$('.player_YT_Mod_Section_button').each(function(){
    		var button_playerID = $(this),
    			video_playerID = $(this).data('videoid');

    		// Animation Button / Play Video
    		button_playerID.on('click', function(e){
				button_playerID.addClass('playButtonAnimation').removeClass('playButtonAnimationReverse');
				setTimeout(function() {
					$('#'+video_playerID).playYTP();
				}, 450);
				e.preventDefault();
			});

    		// Reverse Animation Button / End Video
			$('#'+video_playerID).on("YTPEnd",function(){
				button_playerID.css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');

		    	setTimeout(function() {
					button_playerID.removeClass('playButtonAnimationReverse').css({ visibility:''});
				}, 950);
			});
    	});
	}

	function playPauseSectionYTclick(){
		if ($('.video-status-youtube').length > 0) {

			$('.video-status-youtube').each(function(){				
				var video_block = $(this),
					player_video_ID = video_block.data('videocheck'),
					button_player = video_block.find('.player_YT_Mod_Section_button');

				video_block.on('click', function() {
					$(this).toggleClass('play pause');

					if($(this).hasClass('play')) {
						$('#'+player_video_ID).playYTP();
			        	button_player.addClass('playButtonAnimation').removeClass('playButtonAnimationReverse').css({ visibility:''});
				    } else {
			        	$('#'+player_video_ID).pauseYTP();
			        	button_player.css({ visibility:'visible'}).addClass('playButtonAnimationReverse').removeClass('playButtonAnimation');
				    }
				});

				$('#'+player_video_ID).on("YTPEnd",function(){
					video_block.removeClass('play').addClass('pause');
				});
			});

		}
	}
	playPauseSectionYTclick();

};


/* 11. FitVids ( Responsive Video )
-------------------------------------------------------------------------------------*/
ALICE.responsiveVideo = function(){
	$('.videoWrapper, .video-embed').fitVids();
};


/* 12. Google Maps
-------------------------------------------------------------------------------------*/
ALICE.googleMaps = function(){
	if($('.az-map').length > 0) {

		$('.az-map').each(function(){

			var map,
				$map_g = $(this);


			function initializeMap(){
				// Set map style
				var styles=[
				    {
				        featureType: "all",
				        elementType: "labels.text.fill",
				        stylers: [
				            {
				                saturation: 36
				            },
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 40
				            }
				        ]
				    },
				    {
				        featureType: "all",
				        elementType: "labels.text.stroke",
				        stylers: [
				            {
				                visibility: "on"
				            },
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 16
				            }
				        ]
				    },
				    {
				        featureType: "all",
				        elementType: "labels.icon",
				        stylers: [
				            {
				                visibility: "off"
				            }
				        ]
				    },
				    {
				        featureType: "administrative",
				        elementType: "geometry.fill",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 20
				            }
				        ]
				    },
				    {
				        featureType: "administrative",
				        elementType: "geometry.stroke",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 17
				            },
				            {
				                weight: 1.2
				            }
				        ]
				    },
				    {
				        featureType: "landscape",
				        elementType: "geometry",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 20
				            }
				        ]
				    },
				    {
				        featureType: "poi",
				        elementType: "geometry",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 21
				            }
				        ]
				    },
				    {
				        featureType: "road.highway",
				        elementType: "geometry.fill",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 17
				            }
				        ]
				    },
				    {
				        featureType: "road.highway",
				        elementType: "geometry.stroke",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 29
				            },
				            {
				                weight: 0.2
				            }
				        ]
				    },
				    {
				        featureType: "road.arterial",
				        elementType: "geometry",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 18
				            }
				        ]
				    },
				    {
				        featureType: "road.local",
				        elementType: "geometry",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 16
				            }
				        ]
				    },
				    {
				        featureType: "transit",
				        elementType: "geometry",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 19
				            }
				        ]
				    },
				    {
				        featureType: "water",
				        elementType: "geometry",
				        stylers: [
				            {
				                color: "#28282E"
				            },
				            {
				                lightness: 17
				            }
				        ]
				    }
				];

                var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});
                var latlng = new google.maps.LatLng($map_g.data('map-lat'), $map_g.data('map-lon'));
                var mapOptions = {
                    zoom: $map_g.data('map-zoom'),
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    navigationControl: false,
                    streetViewControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    scrollwheel: false,
                    zoomControl: false,
                    disableDefaultUI: true
                };

                map = new google.maps.Map(document.getElementById($map_g.attr('id')), mapOptions);
	            map.mapTypes.set('map_style', styledMap);
	            map.setMapTypeId('map_style');

	            // Control if Image exist
	            var image;

	            if( $map_g.attr('data-map-pin') !== undefined ) {
	            	image = new google.maps.MarkerImage(
	                    $map_g.data('map-pin')
	                );
	            } else {
	            	image = '';
	            }

                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    clickable: false,
                    title: '',
                    icon: image
                });

                // Disable Drag on Mobile/Tablet
				if( Modernizr.mq('(min-width: 320px) and (max-width: 1024px)') ) {
					map.setOptions( { draggable: false });
				}

                //add custom buttons for the zoom-in/zoom-out on the map
				function CustomZoomControl(controlDiv, map) {
					//grap the zoom elements from the DOM and insert them in the map 
				  	var controlUIzoomIn= document.getElementById('cd-zoom-in'),
				  		controlUIzoomOut= document.getElementById('cd-zoom-out');
				  	controlDiv.appendChild(controlUIzoomIn);
				  	controlDiv.appendChild(controlUIzoomOut);

					// Setup the click event listeners and zoom-in or out according to the clicked element
					google.maps.event.addDomListener(controlUIzoomIn, 'click', function() {
					    map.setZoom(map.getZoom()+1);
					});
					google.maps.event.addDomListener(controlUIzoomOut, 'click', function() {
					    map.setZoom(map.getZoom()-1);
					});
				}

				var zoomControlDiv = document.createElement('div');
				zoomControlDiv.setAttribute('class','zoom-controls');
			 	var zoomControl = new CustomZoomControl(zoomControlDiv, map);

			  	//insert the zoom div on the top left of the map
			  	map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);

			}

			// Initialize the map on load
            if ( google )
            	google.maps.event.addDomListener(window, 'load', initializeMap);

		});
	}
};


/* 13. FancyBox
-------------------------------------------------------------------------------------*/
ALICE.fancyBox = function(){
	if($('.fancybox-thumb').length > 0 || $('.fancybox-media').length > 0 || $('.fancybox-various').length > 0){
		
		var $video_player, _videoHref, _videoPoster, _videoWidth, _videoHeight, _dataCaption, _player, _isPlaying = false;

		// For Image
		$('.fancybox-thumb').fancybox({				
			padding : 0,
			margin : 50,
			helpers : {
				title : { type: 'inside' }
			},
			aspectRatio : true,
    		scrolling   : 'no',
    		mouseWheel	: false,
			openMethod	: 'zoomIn',
            closeMethod	: 'zoomOut',
            nextEasing	: 'easeInQuad',
            prevEasing	: 'easeInQuad',
            beforeLoad : function() {
		        this.title = $(this.element).attr('data-fancybox-title');
		    },
			afterLoad : function() {
                this.title = (this.title ? '<h3 class="fancy-caption-title">' + this.title + '</h3>' : '') + '<span class="fancy-counter">' + (this.index + 1) + ' / ' + this.group.length + '</span>';
            },
            beforeShow : function(){
			    $(window).on({
			      	'resize.fancybox' : function(){
			        	$.fancybox.update();
			      	}
			    });
			},
			afterClose : function(){
			    $(window).off('resize.fancybox');
			}
		});
		
		// For Video Only
		$('.fancybox-media').fancybox({
			padding : 0,
			margin : 50,
			helpers : {
				media : true,
				title : { type: 'inside' }
			},
			width       : 1920,
    		height      : 1080,
    		aspectRatio : true,
    		scrolling   : 'no',
    		mouseWheel	: false,
    		openMethod	: 'zoomIn',
            closeMethod	: 'zoomOut',
            nextEasing	: 'easeInQuad',
            prevEasing	: 'easeInQuad',
            beforeLoad : function() {
		        this.title = $(this.element).attr('data-fancybox-title');
		    },
            afterLoad : function() {
            	if ( $(this.element).hasClass('fancybox-video-popup') ) {
            		this.title = '';
            	} else {
					this.title = (this.title ? '<h3 class="fancy-caption-title">' + this.title + '</h3>' : '') + '<span class="fancy-counter">' + (this.index + 1) + ' / ' + this.group.length + '</span>';            		
            	}
            },
    		beforeShow : function(){
			    $(window).on({
			      	'resize.fancybox' : function(){
			        	$.fancybox.update();
			      	}
			    });
			},
			afterClose : function(){
			    $(window).off('resize.fancybox');
			}
		});
		
		// Video Self-Hosted Pop-up
		$('.fancybox-video-popup-self-hosted').fancybox({
	        type : 'html',
	        padding : 0,
			margin : 0,
			helpers : {
				media : true,
			},
    		fitToView  : false,
        	autoSize   : false,
    		scrolling   : 'no',
    		mouseWheel	: false,
    		openMethod	: 'zoomIn',
            closeMethod	: 'zoomOut',
            nextEasing	: 'easeInQuad',
            prevEasing	: 'easeInQuad',
	        beforeLoad : function () {

	        	var winW = $(window).width() - 100;
	        	var winH = $(window).height() - 100;

	            _videoHref   = this.href;
	            _videoPoster = typeof this.element.data("poster")  !== "undefined" ? this.element.data("poster")  :  "";
	            _videoWidth  = typeof this.element.data("width")   !== "undefined" ? this.element.data("width")   : winW;
	            _videoHeight = typeof this.element.data("height")  !== "undefined" ? this.element.data("height")  : winH;

	            this.title = '';
	            this.content = "<div class='video-wrap'><video id='video_player' src='" + _videoHref + "' width='" + _videoWidth + "' height='" + _videoHeight + "' poster='" + _videoPoster + "' controls='controls' preload='none' style='background:#000;' ></video></div>";
	            this.width = _videoWidth;
	            this.height = _videoHeight;
	        },
	        beforeShow : function(){
			    $(window).on({
			      	'resize.fancybox' : function(){
			        	$.fancybox.update();
			      	}
			    });
			},
	        afterShow : function () {
	            var $video_player = new MediaElementPlayer('#video_player', {
                    defaultVideoWidth : this.width,
                    defaultVideoHeight : this.height,
                    success : function (mediaElement, domObject) {
                        _player = mediaElement;
                        _player.load();
                        _player.addEventListener('playing', function () {
                            _isPlaying = true;
                        }, false);
                    }
                });
	        },
	        afterClose : function(){
			    $(window).off('resize.fancybox');
			}
	    });
		
		// For Iframe and Others
		$('.fancybox-various').fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openMethod	: 'zoomIn',
            closeMethod	: 'zoomOut',
            nextEasing	: 'easeInQuad',
            prevEasing	: 'easeInQuad'
		});
	}
};


/* 14. Back to Top
-------------------------------------------------------------------------------------*/
ALICE.scrollToTop = function(){
	
	if ( $('.back-to-top').length > 0) {

		var offset 	 = 200,
			footer_h = $('.footer').outerHeight(),
			footer_h_o = $('.footer').outerHeight() + 30,
			$back_to_top = $('.back-to-top');

		if ( $('.normal-pagination').length > 0) {
			footer_h = $('.normal-pagination').outerHeight() + $('.footer').outerHeight();
			footer_h_o = $('.normal-pagination').outerHeight() + $('.footer').outerHeight() + 30;
		}

		$(window).resize(function(){

			footer_h = $('.footer').outerHeight();
			footer_h_o = $('.footer').outerHeight() + 30;

			if ( $('.normal-pagination').length > 0) {
				footer_h = $('.normal-pagination').outerHeight() + $('.footer').outerHeight();
				footer_h_o = $('.normal-pagination').outerHeight() + $('.footer').outerHeight() + 30;
			}

		});

		$(window).scroll(function(){
			if( $(this).scrollTop() > offset ) {
		        $back_to_top.css({'opacity':'1', 'visibility':'visible'});
			} 
			else if( $(window).scrollTop() < offset ){
		        $back_to_top.css({'opacity':'', 'visibility':'hidden'});
		    }

		    if ( $(this).scrollTop() + $(window).height() > $(document).height() - footer_h ) {
		        $back_to_top.css({'position':'absolute', 'bottom': footer_h_o +'px'});
		    } else {
		        $back_to_top.css({'position':'', 'bottom':''});
		    }
		});

		//smooth scroll to top
		$back_to_top.on('click', function(){
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, 850, 'easeInOutExpo'
			);
		});
	}
	
};


/* 15. Infinite Scroll for Blog
-------------------------------------------------------------------------------------*/
ALICE.infiniteBlogScroll = function(){
	if ( $('#blog-posts-container.infinite-scroll-pagination').length > 0 ) {
		var $infinite = $('.infinite-scroll'),
	        $infiniteLink = $('#infinite-link'),
	        $infiniteContainer = $('#blog-posts-container');

	    $(window).on('scroll.infinite', listenInfiniteScrollingBlog);
	}

	function listenInfiniteScrollingBlog(){
		
		var winH = ( window.innerHeight ? window.innerHeight:$(window).height() ) - 75;

        if($(window).scrollTop()+winH >= $infiniteContainer.offset().top+$infiniteContainer.height()){

            // Prepare loading
            $(window).off('scroll.infinite');
            $infinite.stop().slideDown(200);

            // Start AJAX call
            $.ajax({
                type: 'POST',
                url: $infinite.find('a').prop('href'),
                dataType: 'html',
                success: function(data){

                    var $data = $(data),
                        $posts = $data.find('.post');

                    if($posts.length>0){

                        // If there are posts
                        $posts.imagesLoaded(function(){

                            // When the images are loaded, setup & insert elements
                            $infiniteContainer.append($posts);

                            $posts.stop().css({
                            	'display': 'none',
                            	'opacity': 0
                            });
                            var i = 0;

                            $posts.each(function(){

                            	$(this).delay(++i*100).slideDown(200)
                            		.animate({
                            			'opacity': 1
                            		}, 200);

                            });

                            // Prepare for next page
                            $infinite.stop().slideUp(200);
                            $infiniteLink.prop('href', $data.find('#infinite-link').prop('href'));
                            $(window).on('scroll.infinite', listenInfiniteScrollingBlog);

                        });

                    } else {

                        // If no more posts
                        $infinite.find('span').stop().fadeOut(100);
                        $infinite.find('p').stop().fadeIn(100);

                        setTimeout(function(){
                        	$infinite.stop().slideUp(200);
                        }, 2500);

                    }

                },
                error: function(){
                	
                    $infinite.find('span').stop().fadeOut(100);
                    $infinite.find('p').stop().fadeIn(100);

                    setTimeout(function(){
                    	$infinite.stop().slideUp(200);
                    }, 2500);

                }

            });

        }

	}

};


/* 16. Show/Hide Comments
-------------------------------------------------------------------------------------*/
ALICE.toggleListComment = function(){
	if($('.toggle-comment').length > 0 ){

		// If present comment hash
		if(window.location.hash) {
		  	$('.toggle-comment').addClass('active');
		  	$('.comments-list').css('display','block');

		  	$('.toggle-comment').on('click', function(){
				$(this).toggleClass('active');
		        $('.comments-list').stop().slideToggle( 600, 'easeInOutExpo');
		    });

		} else {
		  	$('.toggle-comment').on('click', function(){
				$(this).toggleClass('active');
		        $('.comments-list').stop().slideToggle( 600, 'easeInOutExpo');
		    });
		}

	}
};


/* 17. Team Modal Creative
-------------------------------------------------------------------------------------*/
ALICE.teamCreativeModal = function(){

	if($('#team-people-section.creative-module').length > 0 ){

		// Fix Modal Z-Index and Wrap all Team Modals divs
		$('.container, .container-fluid').find('.modal.tm').appendTo('body').wrapAll('<div class="modal-team-divs"/>');
		$('.modal-team-divs').append('<div class="mask-team"></div>');

		// Calculate Min-Height based on Viewport Height
		calculateMinH();

		// currently shown div
		var now = 0;
		var divs = $('.modal-team-divs > .modal.tm');

		$('.creative-team-popup').on('click', function(e){
			e.preventDefault();

			var self = $(this);
			$('html').addClass('block-scroll');
			$('.modal-team-divs, .mask-team').velocity("fadeIn", { duration: 450, easing: 'easeOutExpo', complete: function(){
					$('.modal.tm[data-modal='+ self.data('target') +']').css({display:'block',opacity:1}).addClass('active team-modal-entranceAnimation');
				} 
			});

			now = $('.creative-team-popup').index(this);
		});

		$('.next-team-modal').on('click', function() {
			nextClickTeam(); 
		});

		$('.prev-team-modal').on('click', function() {
		    prevClickTeam();
		});

		// Close Events
		$('.modal.tm, .close-team-modal').on('click', function() {
			closeClickTeam();
		});

		$('.modal-dialog').click(function(e){
		    e.stopPropagation();
		});

		/* KeyEvents */
		var delay = (function(){
			var timer = 0;
		 	return function(callback, ms){
		    	clearTimeout (timer);
		    	timer = setTimeout(callback, ms);
		  	};
		})();

		$(document).keydown(function(e) { 
			if ($('.modal-team-divs').is(':visible')) {
				
				// Esc Key
		        if (e.keyCode == 27) {
		        	delay(function(){
		           		closeClickTeam();
		           	}, 100);
		        }

		        // Left Arrow
		        if (e.keyCode == 37) {
		        	delay(function(){
		        		prevClickTeam();
		        	}, 375); /* based on setTimeout duration */
		        }

		        // Right Arrow
		        if (e.keyCode == 39) {
		        	delay(function(){
		        		nextClickTeam();
		        	}, 375); /* based on setTimeout duration */
		        }
	    	}
	      
	    });

	}

	function calculateMinH(){
		var winH = ( window.innerHeight ? window.innerHeight:$(window).height() );
		var num = 0;

		if( Modernizr.mq('(min-width: 320px) and (max-width: 767px)') ) {
			num = 40;
	    } else {
	    	num = 60;
	    }

	    var result = winH - num;

		$('.modal-team-divs .team-modal-container').each(function(){
	        var elem = $(this);
	        elem.css({'min-height': result + 'px'});
	    });

		$( window ).resize(function() {
			winH = ( window.innerHeight ? window.innerHeight:$(window).height() );

			if( Modernizr.mq('(min-width: 320px) and (max-width: 767px)') ) {
				num = 40;
		    } else {
		    	num = 60;
		    }

		    result = winH - num;

			$('.modal-team-divs .team-modal-container').each(function(){
		        var elem = $(this);
		        elem.css({'min-height': result + 'px'});
		    });
		});

	}

	function closeClickTeam(){
		$('html').removeClass('block-scroll');

		$('.modal.tm.active').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo', complete: function(){
				$('.modal.tm').removeClass('active team-modal-entranceAnimation team-modal-entranceAnimationReverse').css({opacity:0});	
				$('.modal-team-divs, .mask-team').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });
			}
		});

		// Reset Scroll
        $('.modal.tm').delay(380).queue(function(closes){
		    $('.modal.tm').scrollTop(0);
		    closes();
		});
	}

	function nextClickTeam(){
		divs.eq(now).removeClass('active team-modal-entranceAnimation team-modal-entranceAnimationReverse').addClass('team-modal-nextAnimation');
	    setTimeout(function() {
	    	divs.eq(now).removeClass('team-modal-nextAnimation team-modal-entranceAnimationReverse').hide().css({opacity:0});

        	now = (now + 1 < divs.length) ? now + 1 : 0;
	    	divs.eq(now).show().css({opacity:1}).addClass('active team-modal-entranceAnimation');
        }, 375); /* based on css animation duration */

        // Reset Scroll
        $('.modal.tm').delay(380).queue(function(next){
		    $(this).scrollTop(0);
		    next();
		});
	}

	function prevClickTeam(){
		divs.eq(now).removeClass('active team-modal-entranceAnimation team-modal-entranceAnimationReverse').addClass('team-modal-prevAnimation');
	    setTimeout(function() {
	    	divs.eq(now).removeClass('team-modal-prevAnimation').hide().css({opacity:0});

        	now = (now > 0) ? now - 1 : divs.length - 1;
	    	divs.eq(now).show().css({opacity:1}).addClass('active team-modal-entranceAnimationReverse');
        }, 375); /* based on css animation duration */

        // Reset Scroll
        $('.modal.tm').delay(380).queue(function(next){
		    $(this).scrollTop(0);
		    next();
		});
	}

};


/* 18. Portfolio
-------------------------------------------------------------------------------------*/

/* 18.1 Filter
--------------------------------*/
ALICE.filterElements = function(){

	if( $('#filter-isotope').length > 0 || $('.masonry-ly-portfolio').length > 0 ){

		// Find it Filter has Elements
		$('#filter-isotope ul li').each( function() {
			var filter = $(this),
				filterName = $(this).find('a').attr('data-filter').replace('.', ''),
				portfolioItems = $('#portfolio-item-section');
			
			portfolioItems.find('.single-portfolio-item').each( function() {
				if ( $(this).hasClass(filterName) ) {
					filter.find('a').addClass('has-items');
				}
			});
		});

	   	var $folioItems = $('#portfolio-item-section'),
	   		$filter = $('#filter-isotope'),
	    	$activeFilter = $('#filter-isotope a.selected');

	    $(window).on('debouncedresize', function(){

		    $filter.find('a').on('click', function(e){
		    	$('#count-projects').find('.current-number').removeClass('present').addClass('no-present');

		        $activeFilter.removeClass('selected');
		        $activeFilter = $(this);
		        $activeFilter.addClass('selected');

		        var f = $(this).data('filter');

		        $folioItems.isotope({
		            filter: f
		        });

		        //$(this).parents('#filter-isotope').find('.current-cat-filter').html($(this).html());

		        e.preventDefault();

		    });

		    $folioItems.isotope({
				itemSelector: '.single-portfolio-item',
			    layoutMode: 'masonry',
			    masonry: {
	            	columnWidth: '.single-portfolio-item'
	            },
			    hiddenStyle: {
			      opacity: 0
			    },
			    visibleStyle: {
			      opacity: 1
			    },
			    isResizeBound: false
			});

		}).trigger('debouncedresize');

		$folioItems.imagesLoaded( function(){
            $(window).trigger('debouncedresize');
        });

		$folioItems.isotope( 'on', 'layoutComplete',
		  function( isoInstance, laidOutItems ) {

		  	var number = laidOutItems.length;

		  	$('#count-projects').find('.current-number').text(function () {
		        var result = number;
		        if ( result < 10 ) {
		            return "0" + result;
		        } else {
		            return result;
		        }
		    });

		    $('#count-projects').find('.current-number').addClass('present').removeClass('no-present');

		});

	}

};


/* 18.2 Infinite Scroll
--------------------------------*/
ALICE.infinitePortfolioScroll = function(){
	if ( $('.portfolio-infinite-activated.infinite-scroll').length > 0 ) {
		var $infinite = $('.infinite-scroll'),
	        $infiniteLink = $('#infinite-link'),
	        $infiniteContainer = $('#portfolio-item-section');

	    $(window).on('scroll.infinite', listenInfiniteScrollingPortfolio);
	}

	function listenInfiniteScrollingPortfolio(){
		
		var winH = ( window.innerHeight ? window.innerHeight:$(window).height() ) - 75;

        if($(window).scrollTop()+winH >= $infiniteContainer.offset().top+$infiniteContainer.height()){

            // Prepare loading
            $(window).off('scroll.infinite');
            $infinite.stop().slideDown(200);

            // Start AJAX call
            $.ajax({
                type: 'POST',
                url: $infinite.find('a').prop('href'),
                dataType: 'html',
                success: function(data){

                    var $data = $(data),
                        $posts = $data.find('.single-portfolio-item').not('.grid-sizer');

                    if($posts.length>0){

                        // If there are posts
                        $posts.imagesLoaded(function(){

                            // When the images are loaded, setup & insert elements
                            if( $('#filter-isotope').length > 0 || $('.masonry-ly-portfolio').length > 0 ){
                            	$infiniteContainer.isotope('insert', $posts);
                            } else {
                            	$infiniteContainer.append($posts);
                            }

                            ALICE.fancyBox();

                            $posts.stop().css({
                            	'display': 'none',
                            	'opacity': 0
                            });
                            var i = 0;

                            $posts.each(function(){

                            	$(this).delay(++i*100).slideDown(200)
                            		.animate({
                            			'opacity': 1
                            		}, 200);

                            });

                            // Prepare for next page
                            $infinite.stop().slideUp(200);
                            $infiniteLink.prop('href', $data.find('#infinite-link').prop('href'));
                            $(window).on('scroll.infinite', listenInfiniteScrollingPortfolio);

                            // Find it Filter has Elements
							$('#filter-isotope ul li').each( function() {
								var filter = $(this),
									filterName = $(this).find('a').attr('data-filter').replace('.', ''),
									portfolioItems = $('#portfolio-item-section');
								
								portfolioItems.find('.single-portfolio-item').each( function() {
									if ( $(this).hasClass(filterName) ) {
										filter.find('a').addClass('has-items');
									}
								});
							});

                        });

                    } else {

                        // If no more posts
                        $infinite.find('span').stop().fadeOut(100);
                        $infinite.find('p').stop().fadeIn(100);

                        setTimeout(function(){
                        	$infinite.stop().slideUp(200);
                        }, 2500);

                    }

                },
                error: function(){
                	
                    $infinite.find('span').stop().fadeOut(100);
                    $infinite.find('p').stop().fadeIn(100);

                    setTimeout(function(){
                    	$infinite.stop().slideUp(200);
                    }, 2500);

                }

            });

        }

	}

};


/* 18.3 Portfolio Creative Modal
--------------------------------*/
ALICE.portfolioCreativeModal = function(){

	if($('#portfolio-item-section.creative-module').length > 0 ){

		// Fix Modal Z-Index and Wrap all Team Modals divs
		$('.container, .container-fluid').find('.modal.prt').appendTo('body').wrapAll('<div class="modal-portfolio-divs"/>');
		$('.modal-portfolio-divs').append('<div class="mask-portfolio"></div>');

		// Calculate Min-Height based on Viewport Height
		calculateMinH();

		// currently shown div
		var now = 0;
		var divs = $('.modal-portfolio-divs > .modal.prt');

		$('.creative-portfolio-popup').on('click', function(e){
			e.preventDefault();

			var self = $(this);
			$('html').addClass('block-scroll');
			$('.modal-portfolio-divs, .mask-portfolio').velocity("fadeIn", { duration: 450, easing: 'easeOutExpo', complete: function(){
					$('.modal.prt[data-modal='+ self.data('target') +']').css({display:'block',opacity:1}).addClass('active portfolio-modal-entranceAnimation');
				} 
			});

			now = $('.creative-portfolio-popup').index(this);
		});

		$('.next-portfolio-modal').on('click', function() {
			nextClickPortfolio(); 
		});

		$('.prev-portfolio-modal').on('click', function() {
		    prevClickPortfolio();
		});

		// Close Events
		$('.modal.prt, .close-portfolio-modal').on('click', function() {
			closeClickPortfolio();
		});

		$('.modal-dialog').click(function(e){
		    e.stopPropagation();
		});

		/* KeyEvents */
		var delay = (function(){
			var timer = 0;
		 	return function(callback, ms){
		    	clearTimeout (timer);
		    	timer = setTimeout(callback, ms);
		  	};
		})();

		$(document).keydown(function(e) { 
			if ($('.modal-portfolio-divs').is(':visible')) {
				
				// Esc Key	
		        if (e.keyCode == 27) {
		        	delay(function(){
		           		closeClickPortfolio();
		           	}, 100);
		        }

		        // Left Arrow
		        if (e.keyCode == 37) {
		        	delay(function(){
		        		prevClickPortfolio();
		        	}, 375); /* based on setTimeout duration */
		        }

		        // Right Arrow
		        if (e.keyCode == 39) {
		        	delay(function(){
		        		nextClickPortfolio();
		        	}, 375); /* based on setTimeout duration */
		        }
	    	}
	      
	    });

		// Slider
		$('.portfolio-creative-slider').each(function(){

			var slider,
				$slider_g = $(this);

            var animation_type = $slider_g.data('slide-type'),
				slideshow = $slider_g.data('slideshow'),
				easing = $slider_g.data('slide-easing'),
				loop = $slider_g.data('slide-loop');

			$slider_g.flexslider({
				animation: animation_type,
				easing: easing,
				animationLoop: loop,
				slideshow: slideshow,
				animationSpeed: 600,
				initDelay: 0,
				pauseOnAction: true,
				pauseOnHover: false,
				useCSS: true,
				touch: true,
				controlNav: false,
				directionNav: true,
				prevText: "<i class='font-icon-arrow-left-simple-thin-round'></i>",
				nextText: "<i class='font-icon-arrow-right-simple-thin-round'></i>",  
				keyboard: false                
			});

		});

	}

	function calculateMinH(){
			var winH = ( window.innerHeight ? window.innerHeight:$(window).height() );
			var num = 0;

			if( Modernizr.mq('(min-width: 320px) and (max-width: 767px)') ) {
				num = 40;
		    } else {
		    	num = 60;
		    }

		    var result = winH - num;

			$('.modal-portfolio-divs .portfolio-modal-container').each(function(){
		        var elem = $(this);
		        elem.css({'min-height': result + 'px'});
		    });

			$( window ).resize(function() {
				winH = ( window.innerHeight ? window.innerHeight:$(window).height() );

				if( Modernizr.mq('(min-width: 320px) and (max-width: 767px)') ) {
					num = 40;
			    } else {
			    	num = 60;
			    }

			    result = winH - num;

				$('.modal-portfolio-divs .portfolio-modal-container').each(function(){
			        var elem = $(this);
			        elem.css({'min-height': result + 'px'});
			    });
			});

		}

	function closeClickPortfolio(){
		$('html').removeClass('block-scroll');

		$('.modal.prt.active').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo', complete: function(){
				$('.modal.prt').removeClass('active portfolio-modal-entranceAnimation portfolio-modal-entranceAnimationReverse').css({opacity:0});	
				$('.modal-portfolio-divs, .mask-portfolio').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });
			}
		});

		// Reset Scroll
        $('.modal.prt').delay(380).queue(function(closes){
		    $('.modal.prt').scrollTop(0);
		    closes();
		});
	}

	function nextClickPortfolio(){
		divs.eq(now).removeClass('active portfolio-modal-entranceAnimation portfolio-modal-entranceAnimationReverse').addClass('portfolio-modal-nextAnimation');
	    setTimeout(function() {
	    	divs.eq(now).removeClass('portfolio-modal-nextAnimation portfolio-modal-entranceAnimationReverse').hide().css({opacity:0});

        	now = (now + 1 < divs.length) ? now + 1 : 0;
	    	divs.eq(now).show().css({opacity:1}).addClass('active portfolio-modal-entranceAnimation');
        }, 375); /* based on css animation duration */

        // Reset Scroll
        $('.modal.prt').delay(380).queue(function(next){
		    $(this).scrollTop(0);
		    next();
		});
	}

	function prevClickPortfolio(){
		divs.eq(now).removeClass('active portfolio-modal-entranceAnimation portfolio-modal-entranceAnimationReverse').addClass('portfolio-modal-prevAnimation');
	    setTimeout(function() {
	    	divs.eq(now).removeClass('portfolio-modal-prevAnimation').hide().css({opacity:0});

        	now = (now > 0) ? now - 1 : divs.length - 1;
	    	divs.eq(now).show().css({opacity:1}).addClass('active portfolio-modal-entranceAnimationReverse');
        }, 375); /* based on css animation duration */

        // Reset Scroll
        $('.modal.prt').delay(380).queue(function(next){
		    $(this).scrollTop(0);
		    next();
		});
	}

};


/* 19. AZ Testimonial Slider
-------------------------------------------------------------------------------------*/
ALICE.testimonialSlider = function(){
	if($('.az-testimonial-output').length > 0 ){

		$('.az-testimonial-output').each(function(){

			var slider,
				$slider_g = $(this);

            var animation_type = $slider_g.data('slide-type'),
				easing = $slider_g.data('slide-easing');

			$slider_g.flexslider({
				animation: animation_type,
				easing: easing,
				animationLoop: false,
				slideshow: false,
				smoothHeight: true,
				animationSpeed: 600,
				initDelay: 0,
				pauseOnAction: true,
				pauseOnHover: false,
				useCSS: true,
				touch: true,
				controlNav: false,
				directionNav: true,
				prevText: "<i class='font-icon-arrow-left-simple-thin-round'></i>",
				nextText: "<i class='font-icon-arrow-right-simple-thin-round'></i>",  
				keyboard: false                    
			});

		});

	}
};


/* 20. AZ Twitter Feed Slider
-------------------------------------------------------------------------------------*/
ALICE.twitterFeedSlider = function(){

	if($('.az-twitter-feed').length > 0 ){

		$('.az-twitter-feed').each(function(){

			var slider,
				$slider_g = $(this);

            var animation_type = $slider_g.data('slide-type'),
				easing = $slider_g.data('slide-easing');

			$slider_g.flexslider({
				animation: animation_type,
				easing: easing,
				animationLoop: false,
				slideshow: false,
				smoothHeight: true,
				animationSpeed: 600,
				initDelay: 0,
				pauseOnAction: true,
				pauseOnHover: false,
				useCSS: true,
				touch: true,
				controlNav: false,
				directionNav: true,
				prevText: "<i class='font-icon-arrow-left-simple-thin-round'></i>",
				nextText: "<i class='font-icon-arrow-right-simple-thin-round'></i>",  
				keyboard: false                    
			});

		});

	}
};


/* 21. AZ Gallery Images
-------------------------------------------------------------------------------------*/
ALICE.GalleryImages = function(){

	if( $('.masonry-ly-gallery').length > 0 ){

	   	var $folioItems = $('#gallery-images-section');

	    $(window).on('debouncedresize', function(){

		    $folioItems.isotope({
				itemSelector: '.single-gallery-item',
			    layoutMode: 'masonry',
			    masonry: {
	            	columnWidth: '.grid-sizer'
	            },
			    hiddenStyle: {
			      opacity: 0
			    },
			    visibleStyle: {
			      opacity: 1
			    },
			    isResizeBound: false
			});

		}).trigger('debouncedresize');

		$folioItems.imagesLoaded( function(){
            $(window).trigger('debouncedresize');
        });

	}

};


/* 22. AZ Buttons
-------------------------------------------------------------------------------------*/
ALICE.azButtonHover = function(){

	// Normal
	$('.az-button.custom-btn-color').hover(function(){
		$(this).css({
			'background' : $(this).attr('data-hv-btn'),
			'color' : $(this).attr('data-hv-tx-btn')
		});
	}, function(){
		$(this).css({
			'background' : $(this).attr('data-bg-btn'),
			'color'	: $(this).attr('data-tx-btn')
		});
	});

	// Inverted
	$('.az-button.inverted-mode.custom-btn-color').hover(function(){
		$(this).css({
			'background' : $(this).attr('data-hv-btn'),
			'border-color' : $(this).attr('data-hv-btn'),
			'color' : $(this).attr('data-hv-tx-btn')
		});
	}, function(){
		$(this).css({
			'background' : 'transparent',
			'border-color' : $(this).attr('data-bg-btn'),
			'color'	: $(this).attr('data-tx-btn')
		});
	});

};


/* 23. AZ Box Icons
-------------------------------------------------------------------------------------*/
ALICE.azBoxIcon = function(){

	if( $('.az-box-icon').length > 0 ){
		$('.az-box-equals').closest('.row').addClass('az-box-icon-table').closest('.main-content').addClass('box-icon-section');

		$('.az-box-equals').closest('.main-content').first().addClass('the-first');
		$('.az-box-equals').closest('.main-content').last().addClass('the-last');
	}

};


/* 24. AZ Tooltips
-------------------------------------------------------------------------------------*/
ALICE.azToolTip = function(){ 

	if( $('a[data-toggle=tooltip]').length > 0 ){
		$('a[data-toggle=tooltip]').tooltip();
	}

};


/* 25. Page Loader
-------------------------------------------------------------------------------------*/
ALICE.loaderSite = function(){

	var $site_init = false,
     	$loadPercentageLine = $('.pre-progress-bar'),
     	speed = 1000;

    function animatePercentage(e) {
       	$loadPercentageLine.css( 'width', parseInt(e) + '%' );
    }

    function loadingLine() {
        var percentage = 100;

        $('#preloader-container').stop().animate({
            percentage:percentage
        }, {
            duration: ( speed / 2 ),
            step: animatePercentage,
            complete : function() {
            	$('.preloader-page').velocity({ opacity: 0 }, 550, 'easeOutExpo');
            } 
        }).delay(500);
    }

    if($('#preloader-container').length > 0 ){

	    setTimeout(function(){
			if(!$site_init){
				$site_init = true;

				// Reset scroll page
				$('html, body').animate({ scrollTop: 0 }, 50);

				// Loader Line Animtion
				loadingLine();

				// Loader Container FadeOut
				$('#preloader-container').velocity("fadeOut", { duration: 450, easing: 'easeOutExpo' });

			}
		}, 1150);
	
	}

};

ALICE.leavePage = function(){

	if($('#preloader-container').length > 0 ){

		// Fade In Preloader
		var elements = $('.mm-panel ul li a, .mm-classic-panel ul li a, .logo-setup, .slogan-logo, .classic-team-box, .classic-portfolio-box.normal-type-prt, #blog.grid .post-creative > .post-link, #blog.wide .post-creative > .post-link, .entry-meta-area .post-author-profile a, .entry-meta-area .entry-categories a, .entry-meta-area .entry-tags a, .normal-pagination.numbers-only a, .normal-pagination .back-post a, .normal-pagination .prev-post a, .normal-pagination .next-post a');
	    elements.not('.mm-panel ul li a[href$="#"], .mm-panel ul li a[target="_blank"], .mm-classic-panel ul li a[href$="#"], .mm-classic-panel ul li a[target="_blank"], .mm-classic-panel ul li a.menu-search, .mm-classic-panel ul li a.menu-share, .normal-pagination .back-post a[href$="#"]').click(function(event){

			event.preventDefault();
			
			var linkLocation = this.href;

			$('body').animate({
			    opacity: 0,
			}, 500, function() {
			    // Animation complete.
			    newpage(linkLocation);
			});
			
		});

	}

	function newpage(link) {
		window.location = link;
	}

};

ALICE.reloader = function(){
	window.onpageshow = function(event) {
		if (event.persisted) {
			window.location.reload(); 
		}
	};	
};


/* 26. Animation on Scroll
-------------------------------------------------------------------------------------*/
ALICE.animationsModule = function(){
	function elementViewed(element) {
		if (Modernizr.touch && $(document.documentElement).hasClass('no-scroll-animation-effects')) {
			return true;
		}
		var elem = element,
			window_top = $(window).scrollTop(),
			offset = $(elem).offset(),
			top = offset.top + 10;
		if ($(elem).length > 0) {
			if (top + $(elem).height() >= window_top && top <= window_top + $(window).height()) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	function onScrollInterval(){
		var didScroll = false;
		$(window).scroll(function(){
			didScroll = true;
		});
		
		setInterval(function(){
			if (didScroll) {
				didScroll = false;
			}
			
			if($('.start-animated-content').length > 0 ){
				$('.start-animated-content').each(function() {
					var currentObj = $(this);
					var delay = currentObj.data('delay');
					if (elementViewed(currentObj)) {
						currentObj.delay(delay).queue(function(){
							currentObj.addClass('animate-now');
						});
					}
				});
			}
		}, 250);
	}
	
	onScrollInterval();
};


/* 27. Columns Equal Height
-------------------------------------------------------------------------------------*/
ALICE.setEqualsColumnsHeight = function(){

	if( $('.equals-col-height').length > 0 ) {
		$('.main-content').each(function(){  

			if( Modernizr.mq('(min-width: 992px)') ) {
	        	var highestBox = 0;
	        	$('.equals-col-height', this).each(function(){
	        		$(this).height('auto');

	            	if($(this).outerHeight() > highestBox) 
	               		highestBox = $(this).outerHeight(); 
	        	});  

	        	$('.equals-col-height',this).outerHeight(highestBox);
	        	$('.equals-col-height').css('min-height', '');
	        } else {

	        	$('.equals-col-height').each(function(){
	        		var currentObj = $(this);
					var minH = currentObj.data('minheight');

					currentObj.css('min-height', minH+'px');

	        	});

	        }

		}); 
	}

};


/* 28. Windows Phone Fix
-------------------------------------------------------------------------------------*/
ALICE.windowsPhoneFix = function(){
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style');
        msViewportStyle.appendChild(
            document.createTextNode(
                '@-ms-viewport{width:auto!important}'
            )
        );
        document.querySelector('head').appendChild(msViewportStyle);
    }
};


/* 29. Disable Right Click
-------------------------------------------------------------------------------------*/
ALICE.disableRightClick = function(){
	if($('.right-click-block-enabled').length > 0 ){
		$('html').bind('contextmenu', function(){
		    return false;
		});
	}
};

/* 30. Responsive Typo
-------------------------------------------------------------------------------------*/
ALICE.responsiveTypo = function(){
	if( $('.custom-responsive-typo').length > 0 ) {
		
		$('.custom-responsive-typo').each(function(){
			var $custom_typo = $(this);

			var typo_default = $custom_typo.data('df'),
				typo_medium = $custom_typo.data('md'),
				typo_small = $custom_typo.data('sml'),
				typo_vsmall = $custom_typo.data('vsml'),
				typo_usmall = $custom_typo.data('usml');



			if( Modernizr.mq('(min-width: 320px) and (max-width: 480px)') ) {
				$custom_typo.css('font-size', typo_usmall+'rem');
			} 
			else if( Modernizr.mq('(min-width: 481px) and (max-width: 767px)') ) {
				$custom_typo.css('font-size', typo_vsmall+'rem');
			} 
			else if( Modernizr.mq('(min-width: 768px) and (max-width: 1023px)') ) {
				$custom_typo.css('font-size', typo_small+'rem');
			} 
			else if( Modernizr.mq('(min-width: 1024px) and (max-width: 1440px)') ) {
				$custom_typo.css('font-size', typo_medium+'rem');
			}
			else {
				$custom_typo.css('font-size', typo_default+'rem');
			}

		});

	}
};

/* 31. Init
-------------------------------------------------------------------------------------*/
$(window).load(function(){
	if($('#preloader-container').length > 0 ){
		ALICE.leavePage();
	}
	
	ALICE.setEqualsColumnsHeight();
});

$(document).ready(function(){

	if($('#preloader-container').length > 0 ){
		ALICE.reloader();
		ALICE.loaderSite();
	}

	ALICE.listenerDesktopMenu();
	ALICE.headerScroll();

	ALICE.modalSharePage();
	ALICE.modalSearchPage();

	ALICE.fullPageHeight();
	ALICE.fxToScroll();
	ALICE.scrollBtnFullArea();

	ALICE.filterElements();
	ALICE.infinitePortfolioScroll();
	ALICE.portfolioCreativeModal();
	ALICE.teamCreativeModal();

	ALICE.mediaElements();
	ALICE.VimeoPlayerInit();
	ALICE.YoutubeBackgroundVideo();
	ALICE.responsiveVideo();

	ALICE.googleMaps();

	ALICE.fancyBox();

	ALICE.scrollToTop();
	ALICE.scrollDotsNavigation();

	ALICE.toggleListComment();
	ALICE.infiniteBlogScroll();

	ALICE.azSlider();
	ALICE.azSliderShortcode();
	ALICE.testimonialSlider();
	ALICE.twitterFeedSlider();
	ALICE.GalleryImages();
	ALICE.azButtonHover();
	ALICE.azBoxIcon();
	ALICE.azToolTip();

	ALICE.windowsPhoneFix();
	ALICE.disableRightClick();

	ALICE.animationsModule();
	ALICE.responsiveTypo();

	//webkit video back button fix 
	$('iframe[src]').each(function(){
		$(this).attr('src',$(this).attr('src'));
		$(this).css({'opacity':'1', 'visibility':'visible'});
	});

});

$(window).resize(function(){
	ALICE.mobileMenuScroll();
	ALICE.fxToScroll();
	ALICE.fullPageHeight();
	ALICE.ResizeSelfHostedBackgroundVideo();
	ALICE.ResizeVimeoBackgroundVideo();
	ALICE.setEqualsColumnsHeight();
	ALICE.responsiveTypo();
});

});