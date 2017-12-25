/* ALL THE SCRIPTS IN THIS FILE ARE MADE BY KROWNTHEMES.COM AND ARE LICENSED UNDER ENVATO'S REGULAR/EXTENDED LICENSE --- REDISTRIBUTION IS NOT ALLOWED! */

(function($) {

    $(window).load(function(){

        "use strict";

/* ----------------------------------------------------
---------- !! BLOG !! -----------------
------------------------------------------------------- */

	// All variables
    
    var $html = $('html'),
        $body = $('body'),
        $header = $('#header'),
        $menu = $('#main-menu'),
        $menuOpener = $('#menu-opener'),
        $menuContent = $('#main-menu .top-menu'),
        $menuWidget = $('#menu-widget'),
        $menuHolder = $('#menu-holder'),
        $heroHelper = $('#hero-helper'),
        $content = $('#content');

	$('body.blog #content').css('paddingTop', $header.outerHeight())

	// Functions that inits a certain page header parallax

	var pageHeaders = [];

	function initArticleHeaders($this) {

		pageHeaders.push($this);

		$this.closest('article').on('mouseover', function(){
			$(this).find('.featured-img').addClass('active');
			$(window).trigger('scroll');
		}).on('mouseout', function(){
			$(this).find('.featured-img').removeClass('active');
		});

		$(window).trigger('resize');

	}

	if ( $body.hasClass('blog') || $body.hasClass('single') ) {

		$('.featured-img').each(function(){
			initArticleHeaders($(this));
		});

		$(window).on('scroll', function(e) {

			for (var i = 0; i < pageHeaders.length; i++ ) {

				if ( pageHeaders[i].hasClass('active') || pageHeaders[i].hasClass('reactive') ) {
					pageHeaders[i].css('transform', 'translate3d(0, ' + ($(window).scrollTop() - pageHeaders[i].offset().top) / 6 + 'px, 0)');
				}
			}

		});

		$(window).on('resize', function(e) {
			for (var i = 0; i < pageHeaders.length; i++ ) {
				if ( pageHeaders[i].data('bg') != 'noback' ) {
					$.bgSet(pageHeaders[i], $(window));
				}
			}
		}).trigger('resize');

	}

	function initHeaderResize($header) {
		$(window).on('resize.postheader', function(){
			if ( $heroHelper.css('display') != 'block' ) {
				$header.height($(window).height()/$header.data('height'));
			} else {
				$header.height($(window).height()/2);
			}
		}).trigger('resize.postheader');
	}

    /* -------------------------------
    -----   AJAX Loading   -----
    ---------------------------------*/

	var postLoaded = false,
		postsData = {};

	if ( $body.hasClass('blog') && $.krownAjax == 'enabled' ) {

		$('#posts-container').find('a').on('click', function(e){
			if ( $.touchM && $heroHelper.css('display') == 'block' ) {
				$.generalFauxAjax($(e.currentTarget).attr('href'));
			} else {
				preOpenPost($(this));
			}
			e.preventDefault();
		});

		$('#posts-container').find('article.post').each(function(){
			$(this).on('mouseenter', function(e){
				lazyLoad($(this));
			});
		});

	}

    // Function that checks the loading of a post

	function lazyLoad($this) {

		if ( $this.attr('data-lazyload') == 'empty' ) {
			$this.attr('data-lazyload', 'loading');
			getPostContent($this);
		} else if ( $this.attr('data-lazyload') == 'open' ) {
			getPostContent($this);
		} 

	}

	// Function that gets the post content and stores it

	function getPostContent($this) {

		$.ajax({

			url: $this.find('a.post-link').attr('href'),
			data: { 'justcontent': 'yes' },
			dataType: 'text',
			success: function(data){

				var $data = $(data).find('.post-content');

				if ( $this.attr('id') != undefined ) {
					postsData[$this.attr('id')] = $data;
				} else {
					postsData['post-'+$this.data('id')] = $data;
				}

				if ( $this.attr('data-lazyload') == 'open' ) {
					openPost($this);
				}

				$this.attr('data-lazyload', 'loaded');
			}

		});

	}

	// Function that prepares the opening of a post item

	function preOpenPost($this) {

		var $post = $this.closest('article');

		$post.addClass('loading');
		$body.removeClass('overtop').addClass('overlap');

		$header.addClass('noback');

		TweenLite.to($post.siblings('article'), .1, {opacity: 0});
		TweenLite.to($post, .6, {top: -$post.offset().top});
		TweenLite.to($post.find('h2'), .6, {css: {'fontSize': '36px', 'lineHeight': '40px'}});
		TweenLite.to(window, .6, {scrollTo:{y:0}});
		TweenLite.to($post.find('.header-container'), .6, {height: $(window).height()/$post.find('.header-container').data('height')});
		$body.attr('data-background', $post.attr('data-background'));

        $(window).off('scroll.infinite');

		setTimeout(function(){
			if ( $post.attr('data-lazyload') == 'loading' ) {
				$post.attr('data-lazyload', 'open');
			} else if ( $post.attr('data-lazyload') == 'loaded' ) {
				openPost( $post );
			} else {
				$post.attr('data-lazyload', 'open');
				lazyLoad( $post );
			}
		}, 400);

		setTimeout(function(){
			$header.removeClass('noback');
		}, 700);

	}

	// Function that actually opens the new post

	function openPost($post) {

		var href = $post.find('a').attr('href'),
			title = $post.data('title');

		$post.attr('data-lazyload', 'opened');
		$post.append(postsData[$post.attr('id')]);
		$post.find('.post-content').css({opacity: 0, top: 50});
		TweenLite.to($post.find('.post-content'), .7, {opacity: 1, top: 0});

		setPostButtons();
    	$.lazyBg();

		initComments();
		initHeaderResize($post.find('.header-container'));
		$post.find('.featured-img').addClass('reactive');

		$post.find('.post-content').initShortcodes();
		History.pushState(null, title, href.replace(document.location.protocol + '//' + document.location.hostname, ''));

		setTimeout(function(){
			$post.siblings('article').css('display', 'none');
			$post.css('top', 0);
			$('body.blog #content').css('paddingTop', 0)
        	$body.css('paddingTop', 0);
		}, 400);

	}

	setTimeout(function(){
		lazyLoad($('.btn-next'));
	}, 1000);

    /* -------------------------------
    -----   Other Functions   -----
    ---------------------------------*/

    // Ajax comments

	function initComments() {

		$('#comment-form').find('input#submit').before('<p id="ajax-response"></p>');

		var $commentForm = $('#comment-form'),
			$commentsList = $('#comments-list'),
			$nameInput = $commentForm.find('#name'),
			$emailInput = $commentForm.find('#email'),
			$commentInput = $commentForm.find('#comment'),
			$submitButton = $commentForm.find('input#submit'),
			$ajaxResponse = $('#ajax-response');

		$nameInput.focus(function(){$ajaxResponse.text('')});
		$emailInput.focus(function(){$ajaxResponse.text('')});
		$commentInput.focus(function(){$ajaxResponse.text('')});

		$commentForm.submit(function(e){

			var ok = true,
	        emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

			if ( $nameInput.length > 0 && $nameInput.val().length < 3 ) {
				ok = false;
			}

			if ( $emailInput.length > 0 && ! emailReg.test($emailInput.val()) ) {
				ok = false;
			}

			if ( $commentInput.length > 0 && $commentInput.val().length < 3 ) {
				ok = false;
			}

			if ( ok ) {

				$.ajax({
					type: $commentForm.prop('method'),
					url: $commentForm.prop('action'),
					data: $commentForm.serialize(),
					success: function(data, status, request) {
						$commentsList.html($(data).find('#comments-list')[0]);
						$ajaxResponse.text(langObj.posted_comment);
						$submitButton.removeClass('disabled').val(langObj.post_comment);
					},
					error: function(request, status, error) {
						if ( request.status == 409 ) {
							$ajaxResponse.text(langObj.duplicate_comment);
							$submitButton.removeClass('disabled').val(langObj.post_comment);
						}
					}
				});

				$submitButton.addClass('disabled').val(langObj.posting_comment);

			} else {
				$ajaxResponse.text(langObj.required_comment);
			}

			e.preventDefault();

		});

	}

	// Post navigation

	function setPostButtons() {

		// Add mouse over / mouse out events for these buttons

		$content.find('.post-nav > a').on('click', function(e){
			$.generalFauxAjax($(e.currentTarget).attr('href'));
			e.preventDefault();
		}).on('mouseover', function(e){

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

    /* -------------------------------
    -----   Infinite loading   -----
    ---------------------------------*/

    var $infinite = $('#infinite-barrier'),
        $infiniteLink = $('.infinite-link'),
        $infiniteContainer = $('#posts-container');

    if ( $body.hasClass('blog') ) {
		$(window).on('scroll.infinite', listenInfiniteScrollingBlog);
	}

    function listenInfiniteScrollingBlog(){

        if($(window).scrollTop() + $(window).height() - 200 >= $infiniteContainer.offset().top + $infiniteContainer.height()){

            // Prepare loading

            $(window).off('scroll.infinite');
            $infinite.stop().slideDown(300);

            // Start AJAX call

            $.ajax({
                type: 'POST',
                url: $infiniteLink.attr('href'),
                dataType: 'html',
                success: function(data){

                    var $data = $(data),
                        $posts = $data.find('.post:not(#infinite-barrier)');

                    if ( $posts.length > 0 ) {

                        // If there are posts

                        $infinite.before($posts);

                        var i = -1;
                        $posts.each(function(){

                        	var $this = $(this);
                        	$this.css('height', 0);
                        	TweenLite.to($this, .2, {height: 275, onComplete:function(){
                        		$(this).css('height', 'auto');
                        	}, onCompleteScope: $this, delay: ++i*.1});

                        	$this.on('mouseenter', function(e){
								lazyLoad($(this));
							});

							$this.find('a').on('click', function(e){
								preOpenPost($(this));
								e.preventDefault();
							});

							initArticleHeaders($this.find('.featured-img'));

                        });

                        $(window).trigger('resize');

                        // Prepare for next page

                        $infinite.stop().slideUp(300);
                        $infiniteLink.attr('href', $data.find('.infinite-link').attr('href'));
                        $(window).on('scroll.infinite', listenInfiniteScrollingBlog);

                    } else {

                        // If no more posts

                        $infinite.find('p.start').stop().fadeOut(100);
                        $infinite.find('p.end').stop().fadeIn(100);

                        setTimeout(function(){
                        	$infinite.stop().slideUp(200);
                        }, 2500);

                    }

                },
                error: function(){
                	
                    $infinite.find('p.start').stop().fadeOut(100);
                    $infinite.find('p.end').stop().fadeIn(100);

                    setTimeout(function(){
                    	$infinite.stop().slideUp(200);
                    }, 2500);

                }

            });

        }

	}

    /* -------------------------------
    -----   Single posts   -----
    ---------------------------------*/

	if ( $body.hasClass('single') ) {
		initComments();
		setPostButtons();
		initHeaderResize($('.post').find('.header-container'));
		$body.attr('data-background', $('.post').attr('data-background'));
	}

///////////////

    });

})(jQuery);