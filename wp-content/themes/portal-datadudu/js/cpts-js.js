// JavaScript Document

/**$(function(){
	var spLength = $('.slide_point span').length,
		scimgWidth = $(window).width(),
		sNum = 0;
	var sTimer = setInterval(moveSlide,1000);
	function moveSlide(){
		if (sNum > spLength-1) {
			sNum = 0;
		};
		showPics(sNum);
		sNum++;
	};
	//鼠标移入下方的块进行滚动
	$('.slide_point span').mouseover(function(){
		clearInterval(sTimer);
		sNum = $(this).index();
		showPics(sNum);
	}).mouseleave(function(){
		sTimer = setInterval(moveSlide,1000);
	});
	//图片自动滚动
	function showPics(sNum){
		$(".slide_point span").eq(sNum).addClass("cur_point").siblings().removeClass("cur_point");
		$(".slide_cont ul li").css('margin-left','');
		$(".slide_cont ul li").each(function(i,v) {
			var index = $(this).index();
			if(index<sNum) {
				var mar = (sNum - index ) * scimgWidth;
				$(v).css('margin-left',- (sNum - index ) * scimgWidth );
			}
		});
		$(".slide_cont ul li").eq(sNum).css({
			"margin-left" : 0
		});

	}
});**/
$(function(){
	var spLength = $('.slide_point p').length,
		scimgWidth = $(window).width(),
		sulWidth = scimgWidth * spLength,
		sNum = 0;
		$(".slide_cont ul").width(sulWidth);
		$(".slide_cont ul li").width(scimgWidth);
	//var sTimer = setInterval(moveSlide,500000);
	function moveSlide(){
			sNum++;
			if (sNum >= spLength) {
				sNum = 0;
			};
			showPics(sNum);
		}
	//鼠标移入的滑块进行滚动
	$('.slide_point p').click(function(){
			//clearInterval(sTimer);
			sNum = $(this).index();
			showPics(sNum);
		});
		//	.mouseleave(function(){
		//	sTimer = setInterval(moveSlide,20000);
		//});
	//点击旋转的图片
	//$('.tt2 .tu1').click(function(){
	//	//clearInterval(sTimer);
	//	sNum = $(this).index();
	//	showPics(0);
	//});
	//$('.tt2 .tu2').click(function(){
	//	//clearInterval(sTimer);
	//	sNum = $(this).index();
	//	showPics(1);
	//});
	for(var i = 0; i < 6; i++){
		$('.tt2 .tu' + (i + 1)).click(function(){
			//clearInterval(sTimer);
			//alert(i);
			sNum = $(this).index();
			//alert(sNum);
			var tmpi = sNum;
			if(sNum == 1){
				//tmpi += 1;
				tmpi = tmpi + 2;
			}
			if(sNum == 2){
				tmpi += 2;
			}
			if(sNum == 3){
				tmpi += 2;
			}
			if(sNum == 4){
				tmpi += 3;
			}
			if(sNum == 5){
				tmpi += 3;
			}
			//alert(tmpi);
			showPics(tmpi);
		});
	}
	//图片自动滚动
	function showPics(sNum){
		$(".slide_point p").eq(sNum).addClass("cur_point").siblings().removeClass("cur_point");
		$(".slide_cont ul").animate({
			"margin-left" : -scimgWidth * sNum 
		});

	}
});
	
	
	
(function($){
	
$.fn.tabso=function( options ){

	var opts=$.extend({},$.fn.tabso.defaults,options );
	
	return this.each(function(i){
		var _this=$(this);
		var $menus=_this.children( opts.menuChildSel );
		var $container=$( opts.cntSelect ).eq(i);
		
		if( !$container) return;
		
		if( opts.tabStyle=="move"||opts.tabStyle=="move-fade"||opts.tabStyle=="move-animate" ){
			var step=0;
			if( opts.direction=="left"){
				step=$container.children().children( opts.cntChildSel ).outerWidth(true);
			}else{
				step=$container.children().children( opts.cntChildSel ).outerHeight(true);
			}
		}
		
		if( opts.tabStyle=="move-animate" ){ var animateArgu=new Object();	}
		
		$menus[ opts.tabEvent]( function(){
			var index=$menus.index( $(this) );
			$( this).addClass( opts.onStyle )
				.siblings().removeClass( opts.onStyle )
			$( this).children('em').addClass(opts.onStyle2);
			$( this).siblings().children('em').removeClass( opts.onStyle2 );
			switch( opts.tabStyle ){
				case "fade":
					if( !($container.children( opts.cntChildSel ).eq( index ).is(":animated")) ){
						$container.children( opts.cntChildSel ).eq( index ).siblings().css( "display", "none")
							.end().stop( true, true ).fadeIn( opts.aniSpeed );
					}
					break;
				case "move":
					$container.children( opts.cntChildSel ).css(opts.direction,-step*index+"px");
					break;
				case "move-fade":
					if( $container.children( opts.cntChildSel ).css(opts.direction)==-step*index+"px" ) break;
					$container.children( opts.cntChildSel ).stop(true).css("opacity",0).css(opts.direction,-step*index+"px").animate( {"opacity":1},opts.aniSpeed );
					break;
				case "move-animate":
					animateArgu[opts.direction]=-step*index+"px";
					$container.children( opts.cntChildSel ).stop(true).animate( animateArgu,opts.aniSpeed,opts.aniMethod );
					break;
				default:
					$container.children( opts.cntChildSel ).eq( index ).css( "display", "block")
						.siblings().css( "display","none" );
			}
	
		});
		
		$menus.eq(0)[ opts.tabEvent ]();
		
	});
};	

$.fn.tabso.defaults={
	cntSelect : ".content_wrap",
	tabEvent2 : "mouseleave",
	tabEvent : "mouseover",
	tabStyle : "normal",
	direction : "top",
	aniMethod : "swing",
	aniSpeed : "fast",
	onStyle : "current",
	onStyle2:"tab2",
	menuChildSel : "*",
	cntChildSel : "*"
};

})(jQuery);	