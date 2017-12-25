/* ALL THE SCRIPTS IN THIS FILE ARE MADE BY KROWNTHEMES.COM AND ARE LICENSED UNDER ENVATO'S REGULAR/EXTENDED LICENSE --- REDISTRIBUTION IS NOT ALLOWED! */

(function($) {

    $(window).load(function(){

        "use strict";

/* ----------------------------------------------------
---------- !! GENERAL STUFF !! -----------------
------------------------------------------------------- */
    
    var $body = $('body'),
        $header = $('#header'),
        $menu = $('#main-menu'),
        $menuOpener = $('#menu-opener'),
        $menuContent = $('#main-menu .top-menu'),
        $menuWidget = $('#menu-widget'),
        $menuHolder = $('#menu-holder'),
        $pageHeader = $('#page-header'),
        $pageHeaderText = $('#page-header > div > div'),
        $content = $('#content'),
        $footer = $('#footer');

    $.touchM = "ontouchstart" in window

    if ( $.touchM ) {
        $body.removeClass('no-touch')
            .addClass('touch');
    }

    $body.removeClass('no-js');

    $('body').append('<span id="hero-helper"></span>');

    $.krownAjax = $('#preloader').data('ajax');

    // Mobile resizing fix (triggered while scrolling)

    var $win = $(window),
        cww = $win.width(),
        cwh = $win.height();

    $.fixMobileResize = function(){
        if ( $win.width() != cww || $win.height() != cwh ) {
            return true;
        } else {
            return false;
        }
        cww = $win.width();
        cwh = $win.height();
    }

/* ----------------------------------------------------
---------- !! MENU !! -----------------
------------------------------------------------------- */

	var oldBodyBackground = '';

    $(window).on('resize.menueffect', function(e){
        if ( ! $menuOpener.hasClass('opened') && $.fixMobileResize() ) {
            TweenLite.to($menu, 0, {y: -$(window).height(), force3D: true, overwrite: 1});
        }
    });
    TweenLite.to($menu, 0, {y: -$(window).height(), force3D: true, overwrite: 1});

    // Drawer

	$menuOpener.click(function(e){

		if ( $menuOpener.hasClass('opened') ) {

			$menuOpener.removeClass('opened');
			$body.attr('data-background', oldBodyBackground);

            TweenLite.to($menu, .3, {y: -$(window).height(), force3D: true, overwrite: 1, onComplete: function(){
                $menu.css('visibility', 'hidden');
            }});

			$menuContent.stop().animate({'opacity': '0'}, 200, function(){
				$(this).css('visibility', 'visible');
			});
			$menuWidget.stop().animate({'opacity': '0'}, 200);
            $body.removeClass('noflow');

            $header.removeClass('noback');
            $('.post-close').css('visibility', 'visible');

		} else {

			$menuOpener.addClass('opened');
			oldBodyBackground = $body.attr('data-background');
			$body.attr('data-background', 'dark');

            $menu.css('visibility', 'visible');
            TweenLite.to($menu, .3, {y: 0, force3D: true, overwrite: 1});

			$menuContent.css('visibility', 'visible')
				.stop().delay(150)
				.animate({'opacity': '1'}, 300);
			$menuWidget.stop().delay(250).animate({'opacity': '1'}, 150);
			$body.addClass('noflow');
            $header.addClass('noback');
            $('.post-close').css('visibility', 'hidden');

		}

        e.preventDefault();

	});

    // Submenu

	var $oldSubmenu = null;

	$menu.find('li.parent.menu-item').children('a').each(function(){

		$(this).on('click', function(e){

			if ( $oldSubmenu != null ) {

				$oldSubmenu.stop().slideUp(150);

				if ( $oldSubmenu.is($(this).siblings('.sub-menu')) ) {
					$oldSubmenu.siblings('a').removeClass('open');
					$oldSubmenu = null;
					return;
				}

			}

			$oldSubmenu = $(this).siblings('.sub-menu');
			$oldSubmenu.stop().slideDown(250);
			$(this).addClass('open');

			e.preventDefault();

		});

	});

    // Faux loading

    $menu.find('a').on('click', function(e){
        var href = $(this).attr('href');
        if ( href.indexOf('#') < 0 ) {
            $.generalFauxAjax(href);
            e.preventDefault();
        }
    });

    // Sticky header

    var didScroll;
    $.lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $header.outerHeight();

    $(window).scroll(function(event){
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            $.hasScrolled();
            didScroll = false;
        }
    }, 250);

    $.hasScrolled = function() {

        var st = $(window).scrollTop();
        
        if ( st < 0 || Math.abs($.lastScrollTop - st) <= delta ||  ( $body.hasClass('page-template-template-portfolio') && ! $body.hasClass('opened-portfolio') ) ) 
            return;
        
        if (st > $.lastScrollTop && ( $body.hasClass('page-template-template-portfolio') || st > navbarHeight ) ) {
            $header.removeClass('nav-down nav-back').addClass('nav-up');
        } else {
            if(st + $(window).height() < $(document).height()) {
                $header.removeClass('nav-up').addClass('nav-down nav-back');
            }
            if( st <= navbarHeight && ! $body.hasClass('page-template-template-portfolio') && ! $body.hasClass('opened-portfolio') ) {
                $header.removeClass('nav-back');
            }
        }
        
        $.lastScrollTop = st;
    }

    $('body.overtop').css('paddingTop', $header.outerHeight(true));

/* ----------------------------------------------------
---------- !! PAGE HEADER !! -----------------
------------------------------------------------------- */

	function changeBackground($figure) {
		$body.attr('data-background', $figure.data('background'));
	}

	if ( $pageHeader.length > 0 ) {

		$(window).on('resize.page-header', function(e){ 
            if ( $.fixMobileResize() ) {   
                $pageHeader.height($(window).height()/$pageHeader.data('height'));
            }
		});

        $pageHeader.height($(window).height()/$pageHeader.data('height'));

		changeBackground($pageHeader);

        $(window).on('scroll', function(e) {
            $pageHeader.css('transform', 'translate3d(0, ' + $(window).scrollTop()/4 + 'px, 0)');
        });

	} 

/* ----------------------------------------------------
---------- !! CONTACT !! -----------------
------------------------------------------------------- */

	// Page header

	if ( $('#map-contact').length > 0 ) {

        var $mapInsert = $('#map-contact');

        var map;

        var stylez = [
            {
              featureType: "all",
              elementType: "all",
              stylers: [
                { saturation: -100 }
              ]
            }
        ];
        
        var mapOptions = {
            zoom: $mapInsert.data('zoom'),
            center: new google.maps.LatLng($mapInsert.data('map-lat'), $mapInsert.data('map-long')),
            streetViewControl: false,
            scrollwheel: false,
            panControl: true,
            mapTypeControl: false,
            overviewMapControl: false,
            zoomControl: false,
            draggable: $.touchM ? false : true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE
            },
            mapTypeControlOptions: {
                 mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'krownMap']
            }
        };

        map = new google.maps.Map(document.getElementById($mapInsert.attr('id')), mapOptions);

        if($mapInsert.data('greyscale') == 'd-true') {

            var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });    
            map.mapTypes.set('krownMap', mapType);
            map.setMapTypeId('krownMap');

        }

        if($mapInsert.data('marker') == 'd-true') {

            var myLatLng = new google.maps.LatLng($mapInsert.data('map-lat'), $mapInsert.data('map-long'));
            var myImg = {
                url: $mapInsert.data('marker-img'),
                scaledSize: new google.maps.Size(120, 120)
            };
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: myImg
            });

        }

        setTimeout(function(){
        	$mapInsert.animate({'opacity': 1}, 400)
        		.parent().addClass('remove-preloader');
        }, 2000);

        $(window).on('scroll', function(e) {
            $mapInsert.css('transform', 'translate3d(0, ' + $(window).scrollTop()/6 + 'px, 0)');
        });

    }

/* ----------------------------------------------------
---------- !! FOOTER !! -----------------
------------------------------------------------------- */

   /* $.resizePageFooter = function() {
        var footerHeight = 0;
        $footer.children('div').each(function(){
            footerHeight += $(this).outerHeight();
        });
        $footer.css('height', footerHeight);
        $content.css('marginBottom', footerHeight);
    }

	if ( $footer.length > 0 ) {
		$(window).on('resize.page-footer', function(e){
            $.resizePageFooter();
		});
        $.resizePageFooter();
	}*/

/* ----------------------------------------------------
---------- !! PRELOADER !! -----------------
------------------------------------------------------- */

    $.generalFauxAjax = function(href) {
        TweenLite.to($('#wrapper'), .1, {opacity: 0, onComplete:function(){
            window.top.location = href;
        }});
    }

    if ( ( $body.hasClass('single') && ! $body.hasClass('single-portfolio') ) || ( $body.hasClass('page') && ! $body.hasClass('page-template-template-portfolio') ) || $body.hasClass('blog') || $body.hasClass('error404') || $body.hasClass('search') || $body.hasClass('archive') ) {
        TweenLite.to($('#wrapper'), .4, {opacity: 1});
        $('#preloader').addClass('hide');
    }

    // Lazy load backgrounds

    $.lazyBg = function(){
        setTimeout(function(){
            $('.lazybg').each(function(){
                if ( $(this).data('bg') != '' ) {
                    $(this).css('backgroundImage', 'url(' + $(this).data('bg') + ')');
                    $(this).removeClass('lazybg');
                }
            });
        }, 1000);
    }
    $.lazyBg();

    // Function that calculates proper background image based on screen size (similar to srcset)

    $.bgSet = function($obj, $viewport) {

        var desiredDensity = window.devicePixelRatio <= 2 ? window.devicePixelRatio : 2,
            desiredSize = $viewport.width()*desiredDensity,
            desiredBg = '';

        if ( desiredSize <= 840 ) {
            desiredBg = $obj.data('bg-small');
        } else if ( desiredSize <= 1280 ) {
            desiredBg = $obj.data('bg-medium');
        } else {
            desiredBg = $obj.data('bg-large');
        }

        $obj.css('backgroundImage', 'url(' + desiredBg + ')');

    }

    // A different lazy

    $('img[data-lazyload="please"]').each(function(){
        $(this).attr('src', $(this).data('src'));
    });

/* ----------------------------------------------------
---------- !! META !! -----------------
------------------------------------------------------- */

    $.writeProjectPostMeta = function(data) {

        var newMeta = data.match(/\<\!\-\- social meta start \-\-\>([\s\S]+)\<\!\-\- social meta end/);
        
        if ( newMeta[1] != 'null' ) {

            var meta = $(newMeta[1]);

            $('#meta-ogtitle').attr('content', meta[0].content);
            $('#meta-ogtype').attr('content', meta[1].content);
            $('#meta-ogurl').attr('content', meta[2].content);
            $('#meta-ogsitename').attr('content', meta[3].content);
            $('#meta-description').attr('content', meta[4].content);
            $('#meta-itempropimage').attr('content', meta[6].content);
            $('#meta-twitterimg').attr('content', meta[8].content);
            $('#meta-ogimage').attr('content', meta[9].content);

        }

    }

///////////////

    });

})(jQuery);