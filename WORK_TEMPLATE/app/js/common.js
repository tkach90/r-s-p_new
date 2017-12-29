$(function() {
	// STICK-IT 
	$('#stickNav').stickit({
		scope: StickScope.Document,
		top: 0,
		zIndex: 100,
	});

	// HAMBURGER MENU 
	var $hamburger = $(".hamburger");

  		$hamburger.on("click", function(e) {
    		$hamburger.toggleClass("is-active");
    	// Do something else, like open/close menu
  		});
  		
	// Анимация элементов HEADER
	$('.callBack, .callBackFoot').mouseenter(function() {
		$(this).addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
			function() {
				$(this).removeClass('animated bounceIn');
			});
	});

	$('.telNumber, .telNumberFoot, .mail, .mailFoot').mouseenter(function() {
		$(this).addClass('animated tada').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
			function() {
				$(this).removeClass('animated tada');
			});
	});

	$('.paral1>ol>li').mouseenter(function() {
		$(this).addClass('animated pulse').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
			function() {
				$(this).removeClass('animated pulse');
			});
	});

	// Анимация текста
	$(window).scroll(function() {
		$('#head1').css({'left':'0%'});
		$('#head1').isInViewport({ tolerance: -1000 }).addClass('animated fadeInRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend').removeClass('animated fadeInRight').addClass('animated pulse');
		$('#par1:in-viewport').addClass('animated lightSpeedIn');
		$('#par2:in-viewport').addClass('animated bounceInDown');
		$('#par3:in-viewport').addClass('animated slideInUp');
		$('#head2').css({'left':'30%'});
		$('#head2').isInViewport({ tolerance: -100 }).addClass('animated fadeInRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend').removeClass('animated fadeInRight').addClass('animated pulse');
		$('#par4:in-viewport').addClass('animated slideInLeft');
		$('#par5:in-viewport').addClass('animated zoomInUp');
		$('#par6:in-viewport').addClass('animated slideInRight');
		$('.paral1:in-viewport').addClass('animated bounceInLeft')
		$('#head3').css({'left':'0%'});
		$('#head3').isInViewport({ tolerance: -1000 }).addClass('animated fadeInRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend').removeClass('animated fadeInRight').addClass('animated pulse');
		$('#par7:in-viewport').addClass('animated bounceInDown');
		$('#par8:in-viewport').addClass('animated fadeInUpBig');

    });
	// OWL CAROUSEL 
  	$(".owl-carousel").owlCarousel({
  		animate:'zoomInRight',
  		items: 3,
  		margin: 30,
  		nav:true,
  		dots: false,
  		smartSpeed: 700,
  		navText: ["<img src='img/arrow-left.png'>","<img src='img/arrow-right.png'>"],
  		loop:true,
    	margin:10,
    	autoplay: true,
    	autoplayTimeout: 2000,
		responsiveClass:true,
    	responsive:{
        	0:{
            	items:1,
            	loop:true
        	},
        	768:{
            	items:3,
            	loop:true
        	},
        	992:{
            	items:3,
            	loop:true
        	},
        	1200:{
        		items: 4
        	}
		}  		
  	});


//MODAL
$("#submit").click(function() { 
	var name = $('input[name=name]').val(); 
	var tel = $('input[name=phone]').val();
	var send = true;
	
	if(name==""){ 
		send = false;
	}
	if(tel==""){ 
		send = false;
	}
	if(send) {
		dannie = {'user_name':name, 'user_tel':tel};
		$.post('mail.php', dannie, function(answer){ 
			result = '<div style="color:#D80018;">'+answer.text+'</div>';
			$("#form_result").hide().html(result).slideDown();
		}, 'json'); 
	}
});
	// Custom JS
});



// $(window).scroll(function() {
//     	if (isInViewportSmall('#geology')) {
//     		$('#geology .headShow').css({'left':'0%'});
//     		setTimeout(function(){
// 				$('#geology .headShow').addClass('animated fadeInRight');
// 				$('#geology .headShow').removeClass('animated fadeInRight');
// 				$('#geology .headShow').addClass('animated pulse');			
// 			},700);
// 		}

// 		if (isInViewportSmall('#par1, #par2, #par3')) {
//     		setTimeout(function(){
// 				$('#par1, #par2, #par3').removeClass('hidden');
// 				$('#par1, #par2, #par3').addClass('animated zoomInDown');
// 				$('#par1, #par2, #par3').removeClass('animated zoomInDown');
// 				$('#par1, #par2, #par3').addClass('animated pulse');				
// 			},1400);
// 		}

// 		if (isInViewportSmall('#par4')) {
//     		setTimeout(function(){
// 				$('#par4').removeClass('hidden');
// 				$('#par4').addClass('animated bounceInDown');
// 				// $('#par4').removeClass('animated bounceInDown');
// 				// $('#par4').addClass('animated pulse');				
// 			},1400);
// 		}

// 		if (isInViewportSmall('#par5')) {
//     		setTimeout(function(){
// 				$('#par5').removeClass('hidden');
// 				$('#par5').addClass('animated fadeInDownBig');
// 				// $('#par5').removeClass('animated fadeInDownBig');
// 				// $('#par5').addClass('animated pulse');				
// 			},1400);
// 		}

// 		if (isInViewportSmall('#par6')) {
//     		setTimeout(function(){
// 				$('#par6').removeClass('hidden');
// 				$('#par6').addClass('animated bounceInRight');
// 				$('#par6').removeClass('animated bounceInRight');
// 				$('#par6').addClass('animated pulse');				
// 			},1400);
// 		}
// });


