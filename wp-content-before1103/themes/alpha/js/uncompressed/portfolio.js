/* ALL THE SCRIPTS IN THIS FILE ARE MADE BY KROWNTHEMES.COM AND ARE LICENSED UNDER ENVATO'S REGULAR/EXTENDED LICENSE --- REDISTRIBUTION IS NOT ALLOWED! */

(function($) {

    $(window).load(function(){

        "use strict";

/* ----------------------------------------------------
---------- !! PORTFOLIO !! -----------------
------------------------------------------------------- */

	// All variables

	var $win = $(window),
		$body = $('body'),
		$header = $('#header'),
		$logo = $('#logo'),
		$menuHolder = $('#menu-holder'),
        $content = $('#content'),
        $projectCloser = $('.post-close'),
        $footer = $('#footer'),
        $heroHelper = $('#hero-helper'),

		$pageMaskee = $('.maskee'),
		pageMaskee = null,
		firstLoad = true,

		$currentSlide = null,
		$currentPageHeader = null,
		$currentFigureObject = null,
		$currentImgObject = null,
		loadedProject = -1,
		firstProject = true,
		initDoc = [];

    /* -------------------------------
    -----   Slider   -----
    ---------------------------------*/

    if ( $body.hasClass( 'page-template-template-portfolio' ) || $body.hasClass('single-portfolio') ) {

    	if ( $body.hasClass( 'page-template-template-portfolio' ) ) {
			$body.css('overflowY', 'hidden');
			initDoc = [document.title, document.location.pathname];
 		}

		// Init maskee slider

		$pageMaskee.maskee({
			useCSSTransitions: false,
			transitionEasing: 'easeInQuad',
			pagination: 'numeric',
			navigationArrows: false,
			navigationArrowsLeftContent: '<svg x="0" y="0" width="24" height="42" viewBox="0 0 24 42" enable-background="new 0 0 24 42" xml:space="preserve"><polygon points="0 20.1 0 20.1 0 20.1 3.1 23.3 3.1 23.3 20.1 40.3 23.3 37.1 6.3 20.1 23.3 3.1 20.1 0 3.1 17 3.1 17 "/></svg>',
			navigationArrowsRightContent: '<svg x="0" y="0" width="24" height="42" viewBox="0 0 24 42" enable-background="new 0 0 24 42" xml:space="preserve"><polygon points="23.3 20.1 23.3 20.1 23.3 20.1 20.1 23.3 20.1 23.3 3.1 40.3 0 37.1 17 20.1 0 3.1 3.1 0 20.1 17 20.1 17 "/></svg>',
			mouseWheelNavigation: true,
			navigationCursor: true,
			loop: false,
			preSlide: $('.pre-slide').length > 0 ? true : false,
			fadeFirst: true,
			onFirstImageLoaded: function($slider) {

				if ( $body.hasClass('page-template-template-portfolio') ) {
					TweenLite.to(window, 0, {scrollTo:{y:0}, overwrite: 1, delay: .5});
				}

				// Add resizing event

				$win.on('resize.gallery', function(){
					if ( $.fixMobileResize() ) {
						fitGallery();
					}
				});
				window.addEventListener('orientationchange', function(){
					setTimeout(function(){
						fitGallery();
					}, 500);
				})
				fitGallery();
				
				changeBackground($slider.find('.slide:first-of-type'));

				// Move header inside first slide for single projects

				if ( $body.hasClass('single') ) {
					$('.page-header').prependTo($pageMaskee.find('.slide:first-of-type')).addClass('caption');
				}

			},
			onSliderInit: function($slider) {

				fitGallery();
				$pageMaskee.addClass('loaded');
				$('#preloader').addClass('hide');
				$body.removeClass('before-load');
				
				setTimeout(function(){
					$('.maskee-helper').removeClass('remove');
				}, 250);

			},
			onSlideChangeStart: function($slider, $slide) {
				setTimeout(function(){
					changeBackground($slide);
				}, 250);
			},
			onSlideChangeEnd: function($slider, $slide, index) {
				if ( firstLoad ) {
					firstLoad = false;
					$slider.addClass('show-nav');
				}
			}
		});

		pageMaskee = $pageMaskee.data('maskee');

		// Slider header adjustmets
		$('.slide:not(.pre-slide) .page-header').each(function(){
			$(this).find('h6').prependTo($(this).children('div'))
		});

		// Open project event binded to slider buttons

		$('.page-template-template-portfolio .page-header .krown-button').each(function(){

			$(this).on('click', function(e){

				if ( $.krownAjax == 'enabled') {

					if ( ! $(this).hasClass('clicked') ) {

						var $this = $(this);
						$this.addClass('clicked');
						preOpenNewProject($this);
			    		pageMaskee.revertWheelNavigation(false, $this.data('i'));

			    		setTimeout(function(){
			    			$this.removeClass('clicked');
			    		}, 500);

					}

					e.preventDefault();

				}

				e.stopPropagation();

			});

			var hammertime = new Hammer($(this)[0]);
			hammertime.on('tap', function(e){
				$(e.target).trigger('click');
			});

		});

		$projectCloser.on('click', function(e) {
			closeProject();
			e.preventDefault();
		});

	}

    // Slider helper functions

	function fitGallery() {
		//$content.css('paddingTop', $pageMaskee.height());
		$pageMaskee.height($win.height()).width($win.width());
	}

	function changeBackground($figure) {
		if ( $(window).width() < $(window).height() ) {
			$figure.attr('data-background', $figure.data('background-p'));
		} else {
			$figure.attr('data-background', $figure.data('background-l'));
		}
		$body.attr('data-background', $figure.data('background'));
	}

    /* -------------------------------
    -----   Portfolio   -----
    ---------------------------------*/

    function openProject(href, title) {

    	// Function that opens a project via AJAX, loads all proper info, then displays it nicely

    	pageMaskee.disableWheelNavigation();
		pageMaskee.disableNavigation();

   	 	$body.css('overflowY', 'scroll').addClass('opening');
		//$content.addClass('no-footer');

    	var openedWhen = new Date().getTime();
		
		$.ajax({
			url: href,
			dataType: 'html',
			success: function(data){

				// Delay project animation if less than .5s from loading

				var openedNow = new Date().getTime() - openedWhen;
				if ( openedNow > 500 ) {
					continueOpenProject($(data));
				} else {
					setTimeout(function(){
						continueOpenProject($(data));
					}, 500 - openedNow);
				}

				// Refresh social meta

				if ( firstProject ) {

					firstProject = false;

					$('head').append('<meta id="meta-ogtitle" property="og:title" content=""/><meta id="meta-ogtype" property="og:type" content=""/><meta id="meta-ogurl" property="og:url" content=""/><meta id="meta-ogsitename" property="og:site_name" content=""/><meta id="meta-description" property="og:description" content="" /><meta id="meta-twittercard" name="twitter:card" value="summary"><meta id="meta-itempropimage" itemprop="image" content=""><meta id="meta-twitterimg" name="twitter:image:src" content=""><meta id="meta-ogimage" property="og:image" content="" />');

					$.writeProjectPostMeta(data);

				} else {
					$.writeProjectPostMeta(data);
				}

			}
		});

        // Push new History state

      	History.pushState(null, title, href.replace(document.location.protocol + '//' + document.location.hostname, ''));

	}

	function continueOpenProject($data) {

		// Reinit header slider

		$pageMaskee.addClass('hide-nav');

		// Add content

		$content.append($data.find('#page-content, .post-nav, #footer'));

		$content.find('#page-content').initShortcodes();
   		$.lazyBg();

		setProjectVariables();
		setProjectButtons();

		finishOpenProject();

	}

	function setProjectVariables() {

		// Set current slide

		loadedProject = pageMaskee.currentSlide;
		$currentSlide = $pageMaskee.children('.slide').eq(loadedProject);
		$currentPageHeader = $currentSlide.find('.page-header');
		$currentFigureObject = $currentSlide.find('.media');
		$currentImgObject = $currentFigureObject.children('img');

	}

	function setProjectButtons() {

		// Add mouse over / mouse out events for these buttons

		$content.find('.post-nav > a').on('click', function(e){
			openNewProject($(e.currentTarget));
			e.preventDefault();
		});
		$content.find('.post-nav a').on('mouseover', function(e){

			var sibling = $(this).hasClass('btn-next') ? '.next' : '.prev';

			$(this).addClass('hover');
			$(this).siblings('span.after' + sibling).css('zIndex', 8);
			TweenLite.to($(this).siblings('span.after' + sibling), .5, {css:{opacity: 1, backgroundPosition: '50% 50%'}});
			TweenLite.to($(this).parent().find('a:not(.hover)'), .5, {opacity: .1});

		}).on('mouseout', function(e){

			var sibling = $(this).hasClass('btn-next') ? '.next' : '.prev';

			$(this).removeClass('hover');
			$(this).siblings('span.after' + sibling).css('zIndex', 8);
			TweenLite.to($(this).siblings('span.after' + sibling), .5, {css:{opacity: 0, backgroundPosition: '50% 40%'}});
			TweenLite.to($(this).parent().find('a:not(.hover)'), .5, {opacity: 1});

		});

	}

	function finishOpenProject() {

		// Project "IN" animations

		$.lastScrollTop = 0;
		$body.addClass('opened-portfolio');
		TweenLite.to($currentSlide.find('.krown-button'), .3, {opacity: 0});
		TweenLite.to(window, 1, {scrollTo:{y:$win.height()/2}, delay: .3});

		setTimeout(function(){
			$projectCloser.css('display', 'block');
    		pageMaskee.enableScroll();
			$header.removeClass('hide');
		}, 1000);

		// Add scroll event for background position alignment and page header

		$win.on('scroll.parallax', function(e) {

			if ( $(window).scrollTop() < $(window).height() + 100 ) {
				$currentPageHeader.css('transform', 'translate3d(0, ' + Math.round($(window).scrollTop()/2) + 'px, 0)');
				$currentFigureObject.css('transform', 'translate3d(0, ' + Math.round($(window).scrollTop()/4) + 'px, 0)');
			}

		});

	}

	// Function which opens a new project after an initial one is opened

	function preOpenNewProject($this) {

		$this.addClass('loading')
		$pageMaskee.removeClass('show-nav');

		if ( $heroHelper.css('display') != 'block' ) {
			$this.animate({'width': 55}, 250);
		}

		var href = $this.attr('href'),
			title = $this.data('title');

		setTimeout(function(){
			openProject(href, title);
		}, 1);

	}

	var blockThatCrazyMobileScrolling = false;

	function openNewProject($this) {

		$body.removeClass('opened-portfolio');
		blockThatCrazyMobileScrolling = true;

		// Check direction

		var goNext = true;
		if ( $this.hasClass('btn-prev') ) {
			goNext = false;
		}

		$header.addClass('hide');

		// Scroll window to top then start process

		TweenLite.to(window, .5, {scrollTo:{y:0}, onComplete: function(){

			//$body.addClass('opened-portfolio');

			pageMaskee.enableNavigation();
			$.lastScrollTop = 0;

			// Remove all previous content

			$('#page-content, #footer, .post-nav').remove();

			// Start process after small delay

			setTimeout(function(){

				var $oldProjectButton = $pageMaskee.children('.slide').eq(pageMaskee.currentSlide).find('.krown-button')

				if ( goNext ) {
					pageMaskee.nextSlide();
				} else {
					pageMaskee.previousSlide();
				}

				pageMaskee.disableNavigation();

				var $newProjectButton = $pageMaskee.children('.slide').eq(pageMaskee.currentSlide).find('.krown-button');

				setTimeout(function(){

					$newProjectButton.trigger('click');
					$oldProjectButton.removeClass('loading').css({
						'opacity': 1,
						'width': $heroHelper.css('display') == 'none' ? 'auto' : 41
					});

				}, 1000);

			}, 300);

		}});

	} 

	// Function which closes the opened project


	function closeProject() {

		pageMaskee.disableScroll();
		$body.removeClass('opened-portfolio');
		blockThatCrazyMobileScrolling = false;

		// Scroll windwo to top and remove old content

		TweenLite.to(window, .5, {scrollTo:{y:0}, onComplete: function(){

			$('#page-content, #footer, .post-nav').remove();
		$header.removeClass('nav-back');
			//$footer.css('display', 'none');

			$pageMaskee.addClass('show-nav').removeClass('hide-nav');
   	 		$body.css('overflowY', 'hidden').removeClass('opening');

			$win.off('scroll.parallax');
 
    		pageMaskee.enableWheelNavigation();
			pageMaskee.enableNavigation();
			pageMaskee.revertWheelNavigation(true);
			pageMaskee.enableScroll();
            //$header.removeClass('sticky active');
            //TweenLite.to($header, 0, {y: '0%'});

			//maskeeResponsive();

			// Disable project meta

			firstProject = true;
			$('#meta-ogtitle, #meta-ogtype, #meta-ogurl, #meta-ogsitename, #meta-description, #meta-itempropimage, #meta-twitterimg, #meta-ogimage').remove();

		}});

		// Do all "REVERSE" animations

		$currentSlide.find('.krown-button').removeClass('loading').css('width', $heroHelper.css('display') == 'none' ? 'auto' : 41);
		TweenLite.to($currentSlide.find('.krown-button'), .3, {opacity: 1, delay: .5});

		//TweenLite.to($logo, .5, {css:{y: 0, opacity: 1}, delay: .3});

		//TweenLite.to($menuHolder, .5, {css:{y: 0, opacity:1}, delay: .3, onComplete: function(){
		//	$menuHolder.css('transform', '');
		//}});

		TweenLite.to($currentPageHeader, .7, {css:{top:0}, delay: .3});

		TweenLite.to($projectCloser.children('svg'), .2, {rotation: 90, opacity: 0, onComplete: function(){
			TweenLite.to($projectCloser.children('svg'), 0, {rotation: 0, opacity: 1});
			$projectCloser.css('display', 'none');
		}});

		$pageMaskee.removeClass('invisible-pagination');

        // Push old History state

      	History.pushState(null, initDoc[0], initDoc[1]);

	}

	if ( $win.scrollTop() == 0 ) {
		$('body').on('scroll.icon', function(){
			$('.maskee-helper').addClass('remove');
			setTimeout(function(){
				$('.maskee-helper').remove();
			}, 500);
			$('body').off('scroll.icon');
		});
	} else {
		$('.maskee-helper').remove();
	}

	if ( $body.hasClass('page-template-template-portfolio') ) {

		var mrT = null;

		$('.maskee').on('touchstart', function(e){
			if ( ! $body.hasClass('opened-portfolio') ) {
				e.preventDefault();
			}
		});

	}

	if ( $body.hasClass('single-portfolio') ) {

		$currentPageHeader = $('.page-header');
		$currentFigureObject = $('.maskee .slide .media');
		$currentImgObject = $currentFigureObject.children('img');

		$win.on('scroll', function(e) {
			if ( $(window).scrollTop() < $(window).height() + 100 ) {
				$currentPageHeader.css('transform', 'translate3d(0, ' + Math.round($(window).scrollTop()/2) + 'px, 0)');
				$currentFigureObject.css('transform', 'translate3d(0, ' + Math.round($(window).scrollTop()/4) + 'px, 0)');
			}
		});

		$('.page-header').each(function(){
			$(this).find('h6').insertBefore($(this).find('h2'))
		});

	}

    /* -------------------------------
    -----   RESPONSIVE   -----
    ---------------------------------*/

    if ( $body.hasClass('page-template-template-portfolio' ) ) {
	    //$(window).on('resize', maskeeResponsive);
	}

	function maskeeResponsive(kill) {
		if ( kill ) {
			$body.addClass('kill-bill');
			//$body.addClass('kill-scroll');
    		//pageMaskee.disableWheelNavigation();
    		//pageMaskee.disableScroll();
    		//$pageMaskee.off('click');
    	//	$pageMaskee.addClass('hide-nav');
    	} else {
			$body.removeClass('kill-bill');//$body.removeClass('kill-scroll');
			/*
    		pageMaskee.enableWheelNavigation();
    		pageMaskee.enableScroll();
    		$pageMaskee.on('click', function(e){
    			if ( ! $body.hasClass('opened-portfolio' ) ) {
					if ( e.clientX < $(window).width() / 2 ) {
						pageMaskee.previousSlide();
					} else {
						pageMaskee.nextSlide();
					}
				}
			});
    		$pageMaskee.removeClass('hide-nav');*/
    	}
	}

    /* -------------------------------
    -----   Shortcode   -----
    ---------------------------------*/

    var folioShortcodeArr = Array();

    if ( $('.krown-portfolio').length > 0 ) {

    	$('.krown-portfolio a').each(function(){

    		folioShortcodeArr.push($(this));

		    $(this).on('click', function(e){
	            $.generalFauxAjax($(this).attr('href'));
	            e.preventDefault();
		    });

    	});

    	$win.on('resize', function(){
    		for ( var i = 0; i < folioShortcodeArr.length; i++ ) {
    			$.bgSet(folioShortcodeArr[i], folioShortcodeArr[i]);
    		}
    	});
    	
		for ( var i = 0; i < folioShortcodeArr.length; i++ ) {
			$.bgSet(folioShortcodeArr[i], folioShortcodeArr[i]);
		}

    }

///////////////

    });

})(jQuery);