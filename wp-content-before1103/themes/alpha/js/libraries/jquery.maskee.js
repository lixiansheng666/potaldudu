/*
 * Maskee v1.0
 * Created by Ruben Bristian - http://rubenbristian.com 
 * Licensed under GPL - http://www.gnu.org/licenses/gpl.html
 * http://maskee.krownthemes.com
*/

(function($) {

    "use strict";

	var $body = $('body'),
		$maskee = null,
		$maskeeSlides = null;

	$.maskee = function(element, options){

		var defaults = {

			mediaSelector: '.media',
			captionSelector: '.caption',
			transitionSpeed: 750,
			transitionEasing: 'easeIn',
			autoPlay: 0,
			loop: false,
			preSlide: false,
			aftSlide : false,
			fadeFirst: false,
			pagination: 'none',
			navigationArrows: true,
			navigationArrowsLeftContent: '&larr;',
			navigationArrowsRightContent: '&rarr;',
			navigationCursor: false,
			keyboardNavigation: true,
			mouseWheelNavigation: false,
			backwardsNavigation: true,
			enableSwipe: true,
			hideControlsWhenSingle: true,

			onFirstImageLoaded: function( $slider ) {},
			onAllImagesLoaded: function( $slider ) {},
			onSliderInit: function( $slider ) {},
			onSlideChangeStart: function( $slider, $currentSlide, currentSlide ) {},
			onSlideChangeEnd: function( $slider, $currentSlide, currentSlide ) {}

		}

		/* --- PRIVATE VARIABLES --- */

		var plugin = this;
		plugin.settings = {}

		var maskee = element,
			$maskee = $(element),
			$maskeeSlides = $maskee.children('.slide'),
			$maskeeNavigation = null,
			$maskeePagination = null,


			cssAnimSupport = null,
			autoPlayI = 0,
			slidesZ = 99,
			navEnabled = false,
			clipT = null,

			imgsLoaded = 0,
			imgsTotal = $maskeeSlides.find('.media img').length,

			videosArr = Array(),
			imgsArr = Array(),

			scrollPointZero = true,
			scrollDirRight = true,
			scrollValue = 0,
			scrollToNo = 0,
			scrollToOld = 0,
			scrollToCheck = 0,
			scrollEnabled = false;

		/* --- PUBLIC VARIABLES --- */

		plugin.currentSlide = 0;
		plugin.totalSlides = $maskeeSlides.length;

		/* --- INIT FUNCTION --- */

		plugin.init = function() {

			plugin.settings = $.extend({}, defaults, options);

			// Remove controls and autoplay if there's a single slide

			if ( plugin.settings.hideControlsWhenSingle && plugin.totalSlides == 1 ) {
				plugin.settings.navigationArrows = false;
				plugin.settings.navigationCursor = false;
				plugin.settings.keyboardNavigation = false;
				plugin.settings.mouseWheelNavigation = false;
				plugin.settings.autoPlay = 0;
				plugin.settings.pagination = 'none';
			}

			// Build pagination
			
			if ( plugin.settings.pagination != 'none' ) {

				$maskee.append('<div class="maskee-pagination numeric"></div><div class="maskee-pagination bullet"></div>');

				buildNumericPagination();
				buildBulletPagination();

			}

			// Build navigation

			if ( plugin.settings.navigationArrows ) {

				$maskee.append('<span class="maskee-nav prev">' + plugin.settings.navigationArrowsLeftContent + '</span><span class="maskee-nav next">' + plugin.settings.navigationArrowsRightContent + '</span>');

				$maskee.find('.maskee-nav.prev').on('click', function(){
					plugin.previousSlide();
				});

				$maskee.find('.maskee-nav.next').on('click', function(){
					plugin.nextSlide();
				});

			}

			if ( plugin.settings.navigationCursor ) {
				$maskee.on('mousemove', function(e){
					if ( e.clientX < $(window).width() / 2 ) {
						$maskee.addClass('arrow-left').removeClass('arrow-right');
					} else {
						$maskee.addClass('arrow-right').removeClass('arrow-left');
					}
				}).on('click', function(e){
					if ( e.clientX < $(window).width() / 2 ) {
						plugin.previousSlide();
					} else {
						plugin.nextSlide();
					}
				});

			}

			// Enable swipe

			if ( plugin.settings.enableSwipe && $body.hasClass('page-template-template-portfolio') ) {

				var hammertime = new Hammer(window),
					pandir = 'none';

				/*hammertime.on('swipe', function(e){
					if ( ! $body.hasClass('opened-portfolio') ) {
						if ( e.deltaX < 0 ) {
							plugin.nextSlide();
						} else {
							plugin.previousSlide();
						}
					}
				});*/

				hammertime.get('pan').set({threshold: 1, direction: Hammer.DIRECTION_HORIZONTAL})
				hammertime.on('panleft', function(e){
					if ( ! $body.hasClass('opened-portfolio') && navEnabled ) {
						window.scrollTo(0, $(window).scrollTop() + e.distance/3);
						pandir = 'left';
					}
				}).on('panright', function(e){
					if ( ! $body.hasClass('opened-portfolio') && navEnabled ) {
						window.scrollTo(0, $(window).scrollTop() - e.distance/3);
						pandir = 'right';
					}
				}).on('panend', function(e) {
					if ( pandir == 'left' ) {
						plugin.nextSlide();
					} else if ( pandir == 'right' ) {
						plugin.previousSlide();
					}
					pandir = 'none';
				});

			}

			// Interate all images and make sure they are loaded or they load

			$maskeeSlides.eq(0).addClass('js-first-slide');

			// If there are no images, init the slider

			$maskee.find(plugin.settings.mediaSelector).each(function(){
				imgsArr.push($(this));
			});

			var $initFigure = $maskeeSlides.eq(0).find(plugin.settings.mediaSelector);

			if ( $maskeeSlides.eq(0).find(plugin.settings.mediaSelector).data('bg-small') != 'noback' ) {

				var initImg = new Image;
				initImg.onload = function(){
					resizeImages();
					$maskeeSlides.eq(0).addClass('silent-loaded');
					initSlider();
				}
				initImg.src = bgSetComplex($initFigure, $(window));

			} else {
				initSlider();
			}

		}

		/* --- PUBLIC METHODS --- */

		plugin.scrollSlide = function(e) {
			if ( navEnabled ) {

				if ( scrollPointZero ) {
					
					scrollPointZero = false;
					scrollToOld = plugin.currentSlide;

					// Prepare based on scroll direction

					if ( scrollToCheck < $(window).scrollTop() ) {

						// Next slide

						if ( plugin.currentSlide + 1 == plugin.totalSlides ) {
							if ( plugin.settings.loop ) {
								scrollToNo = 0;
							} else {
								scrollPointZero = true;
							//	bounceSlider(true);
								return;
							}
						} else {
							scrollToNo = plugin.currentSlide+1;
						}

						scrollDirRight = true;
						TweenLite.to($maskeeSlides.eq(scrollToNo), 0, {clip: 'rect(0px, ' + $maskee.width() + 'px, ' + $maskee.height() + 'px, ' + $maskee.width() + 'px)', overwrite: 1});

					} else {

						// Previous slide

						if ( plugin.currentSlide - 1 == -1 ) {
							if ( plugin.settings.loop ) {
								scrollToNo = plugin.totalSlides-1;
							} else {
								scrollPointZero = true;
								bounceSlider(false);
								return;
							}
						} else {
							scrollToNo = plugin.currentSlide-1;
						}

						scrollDirRight = false;
						TweenLite.to($maskeeSlides.eq(scrollToNo), 0, {clip: 'rect(0px, 0px, ' + $maskee.height() + 'px, 0px)', overwrite: 1});

					}

					scrollValue = $(window).width() - ( $(window).scrollTop() - ( $(window).width() * plugin.currentSlide ) );

					// Reset new current slide

					$maskeeSlides.eq(scrollToNo).removeClass('animate').addClass('display by-scroll');
					$maskeeSlides.eq(scrollToNo).css('zIndex', slidesZ++);

				}

				// Do actual "scrolling"

				if ( scrollDirRight ) {

					scrollValue = $(window).width() - ( $(window).scrollTop() - ( $(window).width() * scrollToOld ) );

					TweenLite.to($maskeeSlides.eq(scrollToNo), .5, {clip: 'rect(0px, ' + $maskee.width() + 'px, ' + $maskee.height() + 'px, ' + scrollValue + 'px)', overwrite: 1});

					if ( scrollValue <= $(window).width()/2 ) {
						plugin.currentSlide = scrollToNo;
						plugin.changeSlide(scrollToNo);
					} else if ( scrollValue >= $(window).width() ) {
						scrollPointZero = true;
						scrollToNo = plugin.currentSlide;
						plugin.disableScroll();
						navEnabled = false;
						$maskeeSlides.eq(scrollToNo).css('zIndex', slidesZ++);
						setTimeout(function(){
							plugin.enableScroll();
							navEnabled = true;
						}, 500);
					}

				} else {

					scrollValue = ( $(window).scrollTop() - ( $(window).width() * plugin.currentSlide ) ) * (-1);

					TweenLite.to($maskeeSlides.eq(scrollToNo), .5, {clip: 'rect(0px, ' + scrollValue + 'px, ' + $maskee.height() + 'px, ' + '0px)', overwrite: 1});

					if ( scrollValue >= $(window).width()/2 ) {
						plugin.currentSlide = scrollToNo;
						plugin.changeSlide(scrollToNo, true);
					} else if ( scrollValue <= 0 ) {
						scrollPointZero = true;
						scrollToNo = plugin.currentSlide;
						plugin.disableScroll();
						navEnabled = false;
						$maskeeSlides.eq(scrollToNo).css('zIndex', slidesZ++);
						setTimeout(function(){
							plugin.enableScroll();
							navEnabled = true;
						}, 500);
					}

				}


			}

			scrollToCheck = $(window).scrollTop();

		}

		plugin.changeSlide = function(no, backwards){
			
			if ( plugin.settings.mouseWheelNavigation && $('.maskee-helper').length > 0 && no != 0 ) {
				setTimeout(function(){
					$('.maskee-helper').addClass('remove');
					setTimeout(function(){
						$('.maskee-helper').remove();
					}, 500);
				}, 2000);
				$('body').off('scroll.icon');
			}	

			var backwards = (typeof backwards === 'undefined') ? false : backwards;

			if ( navEnabled ) {

				navEnabled = false;
				plugin.disableScroll();

				clearTimeout(clipT);

				var $oldSlide = scrollPointZero ? $maskee.find('.slide.display') : null;

				if ( $oldSlide != null ) {

					// Reset slide properties

					$maskeeSlides.eq(no).removeClass('animate').addClass('display');
					$maskeeSlides.eq(no).css('zIndex', slidesZ++);

					if ( backwards ) {

						$maskeeSlides.eq(no).css('clip', 'rect(0px, 0px, ' + $maskee.height() + 'px, 0px)');

					} else {

						$maskeeSlides.eq(no).css('clip', 'rect(0px, ' + $maskee.width() + 'px, ' + $maskee.height() + 'px, ' + $maskee.width() + 'px)');

					}

				}

				if ( plugin.settings.fadeFirst && no == 0 ) {

					// If first slide (ever) is set to fade

					plugin.settings.fadeFirst = false;	

					$maskeeSlides.eq(no).css('clip', 'auto');
					$maskeeSlides.eq(no).css('opacity', 0);
					$maskeeSlides.eq(no).animate({'opacity': 1}, 500);

				} else {

					// Do actual animation after a really short timeout

					setTimeout(function(){	

						if ( backwards ) {
							TweenLite.to($maskeeSlides.eq(no), .75, {clip: 'rect(0px, ' + $maskee.width() + 'px, ' + $maskee.height() + 'px, 0px)', overwrite: 1});
						} else {
							TweenLite.to($maskeeSlides.eq(no), .75, {clip: 'rect(0px, ' + $maskee.width() + 'px, ' + $maskee.height() + 'px, 0px)', overwrite: 1});
						}

						if ( scrollEnabled ) {
							TweenLite.to(window, .75, {scrollTo:{y:no*$(window).width()}, overwrite: 1});
						}

					}, scrollPointZero ? 100 : 1);

				}

				var pagNo = plugin.settings.preSlide ? no-1 : no;

				if ( plugin.settings.pagination != 'none' ) {
					$maskeeNavigation.text(paginationNumberFormat(pagNo+1));
					$maskeePagination.find('.active').removeClass('active');
					$maskeePagination.children('span').eq(pagNo).addClass('active');
				}

				// Hide navigation buttons in certain conditions

				if ( ! plugin.settings.loop ) {
					if ( plugin.currentSlide == 0 ) {
						$maskee.addClass('invisible-prevbtn');
					} else if ( plugin.currentSlide == plugin.totalSlides - 1 ) {
						$maskee.addClass('invisible-nextbtn');
					} else {
						$maskee.removeClass('invisible-prevbtn').removeClass('invisible-nextbtn');
					}
				}

				if ( plugin.settings.preSlide && plugin.currentSlide == 0 ) {
					$maskee.addClass('invisible-pagination');
				} else {
					$maskee.removeClass('invisible-pagination');
				}

				// Reenable navigation after animation is over

				setTimeout(function(){

					$maskeeSlides.each(function(index){
						if ( index != plugin.currentSlide ) {
							$(this).removeClass('display');
						}
					}) 

					if ( ! scrollPointZero ) {
						scrollToOld = -1;
						scrollPointZero = true;
					}
					
					navEnabled = true;
					plugin.enableScroll();

					clipT = setTimeout(function(){
						$maskeeSlides.eq(plugin.currentSlide).css('clip', 'auto');
					}, 500);

					plugin.settings.onSlideChangeEnd($maskee, $maskeeSlides.eq(plugin.currentSlide), plugin.currentSlide);

				}, plugin.settings.transitionSpeed)

				// Last slide mouse wheel bounce

				if ( plugin.currentSlide + 1 == plugin.totalSlides ) {
					$(window).on('mousewheel.bounce', function(e){
						if ( e.deltaX >= 1 ) {
							bounceSlider(true);
						}
					});
				}

				// Run "onSlideChangeStart" function

				plugin.settings.onSlideChangeStart($maskee, $maskeeSlides.eq(plugin.currentSlide), plugin.currentSlide);

			}

		}

		plugin.nextSlide = function(){

			if ( ! scrollPointZero && plugin.currentSlide > scrollToNo ) {
    			plugin.revertWheelNavigation(false, plugin.currentSlide);
			} else if ( navEnabled ) {

				var ok = true; 

				if ( plugin.currentSlide + 1 == plugin.totalSlides ) {

					if ( plugin.settings.loop ) {
						plugin.currentSlide = 0;
					} else {

						if ( plugin.settings.autoPlay > 0 ) {
							clearInterval(autoPlayI);
							plugin.settings.autoPlay = 0;
						}

						ok = false;

					}

				} else {
					plugin.currentSlide += 1;
				}

				if ( ok ) {
					plugin.changeSlide(plugin.currentSlide);
				} else {
					bounceSlider(true);
				}

			}

		}

		plugin.previousSlide = function() {

			if ( ! scrollPointZero && plugin.currentSlide < scrollToNo ) {
    			plugin.revertWheelNavigation(false, plugin.currentSlide);
			} else if ( navEnabled ) {

				var ok = true;

				if ( plugin.currentSlide - 1 == -1 ) {

					if ( plugin.settings.loop ) {
						plugin.currentSlide = plugin.totalSlides-1;
					} else {

						if ( plugin.settings.autoPlay > 0 ) {
							clearInterval(autoPlayI);
							plugin.settings.autoPlay = 0;
						}

						ok = false;

					}

				} else {
					plugin.currentSlide -= 1;
				}

				if ( ok ) {
					plugin.changeSlide(plugin.currentSlide, plugin.settings.backwardsNavigation);
				} else {
					bounceSlider(false);
				}

			}

		}

		plugin.destroySlides = function($slides) {

			$slides.each(function(){
				$(this).remove();
			});

			resetSlider();

		}

		plugin.appendSlides = function($slides) {

			$($slides.get()).each(function(){
				if ( plugin.totalSlides > 0 ) {
					$maskee.find('.slide:last-of-type').after($(this)[0]);
				} else {
					$maskee.prepend($(this)[0]);
				}
			});

			fixSlideAfterAppend();

		}

		plugin.prependSlides = function($slides) {
			$($slides.get()).each(function(){
				$maskee.prepend($(this)[0]);
			});
			fixSlideAfterAppend();
		}

		plugin.disableNavigation = function() {
			navEnabled = false;
		}
		plugin.enableNavigation = function() {
			navEnabled = true;
		}

		plugin.enableWheelNavigation = function() {

			scrollEnabled = true;
		  	$(window).on('scroll.mwn', function(e) {
		  		if ( scrollEnabled ) {
					plugin.scrollSlide(e);
		  		}
			});
		  	$(window).on('resize.mwn', function(e) {
		  		if ( $.fixMobileResize() && ! scrollPointZero ) {
					plugin.revertWheelNavigation(true, plugin.currentSlide);
				}
			});
		}
		plugin.disableWheelNavigation = function() {
			scrollEnabled = false;
		  	$(window).off('scroll.mwn');
		}
		plugin.revertWheelNavigation = function(force, no) {

			if ( ! scrollPointZero ) {

				if ( no == plugin.currentSlide ) {
					if ( scrollToNo > plugin.currentSlide ) {
						TweenLite.to($maskeeSlides.eq(scrollToNo), .1, {clip: 'rect(0px, ' + $maskee.width() + 'px, ' + $maskee.height() + 'px, '+ $maskee.width() + 'px)', overwrite: 1});
					} else {
						TweenLite.to($maskeeSlides.eq(scrollToNo), .1, {clip: 'rect(0px, 0px, ' + $maskee.height() + 'px, 0px)', overwrite: 1});
					}
				} else if ( no < plugin.currentSlide ) {
					TweenLite.to($maskeeSlides.eq(scrollToNo), .1, {clip: 'rect(0px, ' + $maskee.width() + 'px, ' + $maskee.height() + 'px, 0px)', overwrite: 1});
					plugin.currentSlide = scrollToNo;
				}	

				scrollPointZero = true;
				
			} else if ( force ) {
				TweenLite.to(window, 0, {scrollTo:{y:plugin.currentSlide*$(window).width()}, overwrite: 1});
			}

		}

		plugin.disableScroll = function() {
		  if (window.addEventListener) 
		      window.addEventListener('DOMMouseScroll', preventDefault, false);
		  window.onwheel = preventDefault; 
		  window.onmousewheel = document.onmousewheel = preventDefault; 
		  window.ontouchmove  = preventDefault; 
		  document.onkeydown  = preventDefaultForScrollKeys;
		}
		plugin.enableScroll = function() {
		    if (window.removeEventListener)
		        window.removeEventListener('DOMMouseScroll', preventDefault, false);
		    window.onmousewheel = document.onmousewheel = null; 
		    window.onwheel = null; 
		    window.ontouchmove = null;  
		    document.onkeydown = null;  
		}

		/* --- PRIVATE METHODS --- */

		var initImage = function($img) {

			// This function applies the background image to a slide and when the first image is loaded it starts the slider

			$img.parent().addClass('init');
			imgsArr.push($img.parent());
			resizeImages();

			if ( $img.parent().parent().hasClass('js-first-slide') ) {
				initSlider();
			}

			if ( ++imgsLoaded == imgsTotal ) {
				plugin.settings.onAllImagesLoaded($maskee);
			}

		}

		var initSlider = function() {

			plugin.settings.onFirstImageLoaded($maskee);

			// Change first slide

			navEnabled = true;
			plugin.changeSlide(0);
			resizeImages();

			// Start autoplay if set

			if ( plugin.settings.autoPlay > 0 ) {
				startAutoplay();
			}

			// Bind keyboard events if set

			if ( plugin.settings.keyboardNavigation ) {
				$(window).on('keydown', function(e) {
					if ( e.keyCode == '39' ) {
						plugin.nextSlide();
						e.preventDefault();
						return false;
					} else if ( e.keyCode == '37' ) {
						plugin.previousSlide();
						e.preventDefault();
						return false;
					}
				});
			}

			// Bind mouse wheel events if set

			if ( plugin.settings.mouseWheelNavigation ) {

				plugin.enableWheelNavigation();

				$('head').append('<style id="mwnhelper"></style>');
				var $mwnHelper = $('#mwnhelper');

				$(window).on('resize.mwnhelper', function(e){
					if ( $.fixMobileResize() ) {
						$mwnHelper.html('body.page-template-template-portfolio:after { height: ' + ( $(window).width() * (plugin.totalSlides - 1) + $(window).height() ) + 'px; }');
					}
				});
				$mwnHelper.html('body.page-template-template-portfolio:after { height: ' + ( $(window).width() * (plugin.totalSlides - 1) + $(window).height() ) + 'px; }');

			}

			$(window).on('scroll.icon', function(){
				setTimeout(function(){
					$('.maskee-helper').addClass('remove');
					setTimeout(function(){
						$('.maskee-helper').remove();
					}, 500);
				}, 2000);
				$('body').off('scroll.icon');
			});

			// Init slider

			plugin.settings.onSliderInit($maskee);

			// After all this is done, silently load other images

			$maskeeSlides.each(function(){

				var $slideFigure = $(this).find(plugin.settings.mediaSelector);

				if ( ! $(this).hasClass('silent-loaded') && $slideFigure.data('bg-small') != 'noback' ) {

					var initImg = new Image;
					initImg.src = bgSetComplex($slideFigure, $(window));

				}

			});

		}

		var startAutoplay = function() {

			// This function init the autoplay interval as many times as needed

			if ( autoPlayI != null ) {
				clearInterval(autoPlayI);
			}

			autoPlayI = setInterval(function(){
				plugin.nextSlide();
			}, plugin.settings.autoPlay + plugin.settings.transitionSpeed);

		}

		var paginationNumberFormat = function(no) {
			if ( no < 10 ) {
				return '0' + no;
			} else {
				return no;
			}
		}

		var resetSlider = function() {

			$maskeeSlides = $maskee.children('.slide');

			videosArr = Array();

			plugin.currentSlide = $maskee.children('.display').index();
			plugin.totalSlides = $maskeeSlides.length;

			if ( plugin.settings.pagination != 'none' ) {

				$maskee.find('.maskee-pagination').html('');

				if ( plugin.settings.pagination == 'numeric' ) {
					buildNumericPagination();
				} else {
					buildBulletPagination();
				}

			}

		}

		var buildNumericPagination = function() {
	
			$maskee.find('.maskee-pagination.numeric').append('<span class="current">' + paginationNumberFormat(1) + '</span><span class="total">' + ( plugin.settings.preSlide ? paginationNumberFormat(plugin.totalSlides-1) : paginationNumberFormat(plugin.totalSlides) ) + '</span>' );
			$maskeeNavigation = $maskee.find('.maskee-pagination .current');

		}

		var buildBulletPagination = function() {

			$maskeePagination = $maskee.find('.maskee-pagination.bullet');
			var j = plugin.settings.preSlide ? plugin.totalSlides-1 : plugin.totalSlides,
				k = 100 / j;

			for ( var i = 0; i < j; i++ ) {
				$maskeePagination.append('<span style="width:' + k + '%">' + (i+1) + '</span>');
			}

			/*$maskeePagination.children('span').on('click', function(){
				if ( ! $(this).hasClass('active') ) {

					if ( $(this).index() < $maskeePagination.children('span.active').index() && plugin.settings.backwardsNavigation ) {
						plugin.changeSlide($(this).index(), true);
					} else {
						plugin.changeSlide($(this).index());
					}

				}
			});*/

		}

		var fixSlideAfterAppend = function(){

			$maskee.find(plugin.settings.mediaSelector).each(function(){

				if ( ! $(this).hasClass('init') ) {

					var $img = $(this).find('img');

					if ( $img.length > 0 ) {
					
						if ( $img[0].complete || $img[0].naturalWidth > 0 ) {
							initImage($img);
						} else {
							$img.on('load', function(){
								initImage($img);
							});
						}

					}

				}

			});

			resetSlider();

		}

		var bounceSlider = function(dirRight) {
			// WIP (do it with false clip)
		}

		var resizeImages = function() {

			for ( var i = 0; i < imgsArr.length; i++ ) {
			
				var $img = imgsArr[i];
				if ( $img.data('bg-small') != 'noback' ) {
					var newBgStyle = 'url("' + bgSetComplex($img, $(window)) + '")';
					if ( newBgStyle != $img.css('backgroundImage') ) {
        				$img.css('backgroundImage', newBgStyle);
					}
        		}

			}

		}

		var bgSetComplex = function($obj, $viewport) {

	        // sometimes i wonder why i try so hard :))

	        var desiredDensity = window.devicePixelRatio <= 2 ? window.devicePixelRatio : 2,
	            desiredRatio = $viewport.width() < $viewport.height() ? 'portrait' : 'lanscape',
	            desiredSize = desiredRatio == 'portrait' ? $viewport.height()*desiredDensity : $viewport.width()*desiredDensity,
	            desiredBg = '';

	        if ( desiredRatio == 'portrait' ) {
	            if ( desiredSize <= 960 ) {
	                desiredBg = $obj.data('bg-small-p');
	            } else if ( desiredSize <= 1140 ) {
	                desiredBg = $obj.data('bg-medium-p');
	            } else if ( desiredSize <= 1480 ) {
	                desiredBg = $obj.data('bg-large-p');
	            } else {
	                desiredBg = $obj.data('bg-full-p');
	            }
	        } else {
	            if ( desiredSize <= 960 ) {
	                desiredBg = $obj.data('bg-small');
	            } else if ( desiredSize <= 1380 ) {
	                desiredBg = $obj.data('bg-medium');
	            } else if ( desiredSize <= 1920 ) {
	                desiredBg = $obj.data('bg-large');
	            } else {
	                desiredBg = $obj.data('bg-full');
	            }
	        }

	        return desiredBg;

	    }

		$(window).on('resize.imgs', function(){
			resizeImages();
		}).trigger('resize.imgs');

		// Scroll helpers

		var keys = {37: 1, 38: 1, 39: 1, 40: 1};

		var preventDefault = function(e) {
		  e = e || window.event;
		  if (e.preventDefault)
		      e.preventDefault();
		  e.returnValue = false;  
		}

		var preventDefaultForScrollKeys = function(e) {
		    if (keys[e.keyCode]) {
		        preventDefault(e);
		        return false;
		    }
		}

		/* --- START --- */

		plugin.init();

	}

	$.fn.maskee = function(options){

		return this.each(function(){

			if ( undefined === $(this).data('maskee') ) {
				var plugin = new $.maskee(this, options);
				$(this).data('maskee', plugin);
			}

		});

	}

})(jQuery);