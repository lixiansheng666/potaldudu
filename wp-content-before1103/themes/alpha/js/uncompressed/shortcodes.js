/* ALL THE SCRIPTS IN THIS FILE ARE MADE BY KROWNTHEMES.COM AND ARE LICENSED UNDER ENVATO'S REGULAR/EXTENDED LICENSE --- REDISTRIBUTION IS NOT ALLOWED! */

(function($) {

    $(window).load(function(){

        "use strict";

/* ----------------------------------------------------
---------- !! SHORTCODES !! -----------------
------------------------------------------------------- */

	$.fn.initShortcodes = function() {

		// Accordions

		if ( $(this).find('.krown-accordion').length > 0 ) {

			$(this).find('.krown-accordion').each(function(){

		        var toggle = $(this).hasClass('toggle') ? true : false,
		            $sections = $(this).children('section'),
		            $opened = $(this).data('opened') == '-1' ? null : $sections.eq(parseInt($(this).data('opened')));

		        if($opened != null){
		            $opened.addClass('opened');
		            $opened.children('div').slideDown(0);
		        }

		        $(this).children('section').children('h5').click(function(){

		            var $this = $(this).parent();

		            if(!toggle){
		                if($opened != null){
		                    $opened.removeClass('opened');
		                    $opened.children('div').stop().slideUp(300);
		                }
		            }

		            if($this.hasClass('opened') && toggle){
		                $this.removeClass('opened');
		                $this.children('div').stop().slideUp(300);
		            } else if(!$this.hasClass('opened')){
		                $opened = $this;
		                $this.addClass('opened');
		                $this.children('div').stop().slideDown(300);
		            }

		        });

		    });

		}

		// Lightboxes

		$(this).find('img.alignleft, img.alignright, img.aligncenter').parent('a').each(function(){
			$(this).attr('class', 'fancybox fancybox-thumb ' + $(this).children('img').attr('class'));
		});
		
		if ( $(this).find('.fancybox, div[id*="attachment"]').length > 0 ){

			$(this).find('.fancybox, div[id*="attachment"] > a').fancybox({
				padding: 0,
				margin: 50,
				aspectRatio: true,
				scrolling: 'no',
				mouseWheel: false,
				openMethod: 'zoomIn',
				closeMethod: 'zoomOut',
				nextEasing: 'easeInQuad',
				prevEasing: 'easeInQuad'
			}).append('<span></span>');

		}

		// Sliders

		if ( $(this).find('.flexslider').length > 0 ) {

			$(this).find('.flexslider').each(function(){	
				var $this = $(this);
		        $(this).flexslider({
		            animation: $this.hasClass('s-fade') ? 'fade' : 'slide',
		            easing: 'easeInQuad',
		            animationSpeed: 450,
		            slideshow: $this.hasClass('s-slideshow') ? true : false,
		            slideshowSpeed: 6000,
		            directionNav: true,
		            controlNav: true,
		            keyboard: false,
		            prevText: '<i class="fa fa-chevron-left"></i>',
		            nextText: '<i class="fa fa-chevron-right"></i>',
		            start: function(e){
		            //    $(window).trigger('resize');
		            }
		        });
			});

		}

		// Tabs

		if ( $(this).find('.krown-tabs').length > 0 ) {

			$(this).find('.krown-tabs').each(function(){

		 		var $titles = $(this).children('.titles').children('li'),
			        $contents = $(this).children('.contents').children('section'),
			        $openedT = $titles.eq(0),
			        $openedC = $contents.eq(0);

		        $openedT.addClass('opened');
		        $openedC.stop().slideDown(0);

		        $titles.find('a').prop('href', '#').off('click');;

		        $titles.click(function(e){

		            $openedT.removeClass('opened');
		            $openedT = $(this);
		            $openedT.addClass('opened');

		            $openedC.stop().slideUp(200);
		            $openedC = $contents.eq($(this).index());
		            $openedC.stop().delay(200).slideDown(200);

		            e.preventDefault();

		        });
			});

		}

		// Twitter feeds

		if ( $(this).find('.krown-twitter.rotenabled').length > 0 ) {

		  	$(this).find('.krown-twitter.rotenabled').each(function(){

		        var $tW = $(this).children('ul').children('li'),
		            tI = 0,

		        tV = setInterval(function(){

		            $tW.eq(tI).fadeOut(250);

		            if(++tI == $tW.length)
		                tI = 0;

		            $tW.eq(tI).delay(260).fadeIn(300);

		        }, 6000);

		    });

	  	}

	  	// Videos

		if ( $(this).find('audio, video').length > 0 ) {

			$(this).find('audio, video').each(function(){
				$(this).mediaelementplayer({
				    alwaysShowControls: false,
				    iPadUseNativeControls: false,
				    iPhoneUseNativeControls: false,
				    AndroidUseNativeControls: false,
				    enableKeyboard: false,
				    success: function() {
				        $(window).trigger('resize');
				    }
				});
			});

		}

		// Other stuff

		$(this).fitVids();
    	$('p:empty').remove();

    	/*$('select:not(.styled)').styledSelect({
		    coverClass: 'simple-select-cover',
		    innerClass: 'simple-select-inner'
		}).addClass('styled');*/

	}

	$('#content').initShortcodes();
   
///////////////

    });

})(jQuery);