$(function() {

FastClick.attach(document.body);

/*===============================================
Variables
================================================*/

var 
	html = $('html'),
	win = $( window ),
	body = $('body'),
	nav = $('nav'),
	heroLogo = $('.hero-logo'),
	hamburger = $('.hamburger'),
	fries = $('.fries'),
	logo = $('.main-site-logo'),
	iFlink = $('.if-link'),
	fbLink = $('.fb-link'),
	navItem = $('.main-nav-item');

/*===============================================
Win Width
================================================*/

var winWidth;
function updateWinWidth() {
	winWidth = window.innerWidth;
}

win.on( 'resize load', updateWinWidth );

/*===============================================
Retina Class
================================================*/

if (window.matchMedia) { 
	var mq = window.matchMedia("only screen and (-moz-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen  and (min-device-pixel-ratio: 1.3), only screen and (min-resolution: 1.3dppx)");
	if(mq && mq.matches) {
		document.documentElement.className += ' retina';
	}
}

/*===============================================
Loaded Class
================================================*/

win.on( 'load', function() {
	html.addClass( 'loaded' );
});

/*===============================================
Nav Toggle
================================================*/

hamburger.click(function(e){
	e.preventDefault();
	html.toggleClass('js-nav-enabled');
});

/*===============================================
Current Class
================================================*/

navItem.click(function(e){
	e.preventDefault();
	navItem.removeClass('nav-item-current');
	$(this).addClass('nav-item-current');
	if (win.innerWidth() < 800) {
		html.removeClass('js-nav-enabled');
	}
});

logo.click(function(e){
	e.preventDefault();
	navItem.removeClass('nav-item-current');
});


/*================================================
Venobox
=================================================*/

$('.venobox').venobox(); 

/*=================================================
Background Photos
=================================================*/

var
	sectionOne = $('#section-1'),
	sectionTwo = $('#section-2'),
	sectionThree = $('#section-3'),
	sectionFour = $('#section-4'),
	sectionFive = $('#section-5'),
	sectionSix = $('#section-6'),
	bgOne = $('#bg-1'),
	bgTwo = $('#bg-2'),
	bgThree = $('#bg-3'),
	bgFive = $('#bg-5'),
	bgSix = $('#bg-6'),
	bgFour = $('#bg-4');

function updateSection() {
	if (win.scrollTop() >= sectionOne.offset().top - 300 && body.hasClass('home') ) { 
		$('.prev-bg').removeClass('prev-bg');
		$('.current-bg').addClass('prev-bg').removeClass('current-bg');
		bgOne.addClass('current-bg');
		navItem.removeClass('nav-item-current');
	}
}

function updateSectionTwo() {
	if (win.scrollTop() >= sectionTwo.offset().top  - 300 && body.hasClass('home')) { 
		$('.prev-bg').removeClass('prev-bg');
		$('.current-bg').addClass('prev-bg').removeClass('current-bg');
		bgTwo.addClass('current-bg');
		navItem.removeClass('nav-item-current');
		$('#nav-tour').addClass('nav-item-current');
	}
}

function updateSectionThree() {
	if (win.scrollTop() >= sectionThree.offset().top  - 300 && body.hasClass('home')) { 
		$('.prev-bg').removeClass('prev-bg');
		$('.current-bg').addClass('prev-bg').removeClass('current-bg');
		bgThree.addClass('current-bg');
		navItem.removeClass('nav-item-current');
		$('#nav-music').addClass('nav-item-current');
	}
}

function updateSectionFour() {
	if (win.scrollTop() >= sectionFour.offset().top  - 300 && body.hasClass('home')) { 
		$('.prev-bg').removeClass('prev-bg');
		$('.current-bg').addClass('prev-bg').removeClass('current-bg');
		bgFour.addClass('current-bg');
		navItem.removeClass('nav-item-current');
		$('#nav-shop').addClass('nav-item-current');
	}
}

function updateSectionFive() {
	if (win.scrollTop() >= sectionFive.offset().top  - 300 && body.hasClass('home')) { 
		$('.prev-bg').removeClass('prev-bg');
		$('.current-bg').addClass('prev-bg').removeClass('current-bg');
		bgFive.addClass('current-bg');
		navItem.removeClass('nav-item-current');
		$('#nav-videos').addClass('nav-item-current');
	}
}

function updateSectionSix() {
	if (win.scrollTop() >= sectionSix.offset().top  - 300 && body.hasClass('home')) { 
		$('.prev-bg').removeClass('prev-bg');
		$('.current-bg').addClass('prev-bg').removeClass('current-bg');
		bgSix.addClass('current-bg');
		navItem.removeClass('nav-item-current');
		$('#nav-photos').addClass('nav-item-current');
	}
}


win.on( 'scroll load', updateSection);
win.on( 'scroll load', updateSectionTwo);
win.on( 'scroll load', updateSectionThree);
win.on( 'scroll load', updateSectionFour);
win.on( 'scroll load', updateSectionFive);
win.on( 'scroll load', updateSectionSix);

/*==================================================
Expanded Nav
==================================================*/

var scrollTop,
	navHeight = nav.height();

jQuery.fn.exists = function(){return this.length>0;};

function updateScrollTop() {
	scrollTop = win.scrollTop();
}
win.on( 'scroll load', updateScrollTop );

function videoStop() {
		if(body.hasClass('home')) {
			var isStopped = false;
			
			function checkVideo() {
				stopPoint = sectionOne.offset().top + sectionOne.height() - navHeight;
				if( isStopped && scrollTop < stopPoint ) {
					isStopped = false;
					$('video').get(0).play();
				} else if( !isStopped && scrollTop >= stopPoint ) {
					isStopped = true;
					$('video').get(0).pause();
				}
			}
			
			win.on( 'scroll resize', checkVideo );
			checkVideo();
		}
}
win.on( 'load', videoStop );


function extendedNav() {
		if(body.hasClass('home')) {
			var isextended = false;
			
			function checkextendedNav() {
				swapPoint = heroLogo.offset().top + heroLogo.height() + 100 - navHeight;
				if( isextended && scrollTop < swapPoint ) {
					isextended = false;
					html.delay(200).removeClass( 'active-nav' );
					console.log('active');
				} else if( !isextended && scrollTop >= swapPoint ) {
					isextended = true;
					html.delay(200).addClass( 'active-nav' );
					console.log('inactive');
				}
			}
			
			win.on( 'scroll resize', checkextendedNav );
			checkextendedNav();
		}
}
win.on( 'load', extendedNav );

/*==================================================
Parralax
===================================================*/

// win.scroll(function(i){
// 	if (win.innerWidth() > 800 && !html.hasClass('ie9') ) {
// 		var scrollVar = win.scrollTop(),
// 			scale = 1+.0009*scrollVar,
// 			scaleAlt = 0.5+.0004*scrollVar,
// 			opacity = 1-scrollVar;
// 	   	$('.scroll-prompt').css({'opacity': 1 - win.scrollTop() / (window.innerHeight - 400) });

// 	}
// })

/*==================================================
Scroll To
==================================================*/

$('a[href^="#"]').on('click', function(event) {
	if (win.innerWidth() >= 800) {
	    var target = $(this.getAttribute('href'));
	    if( target.length ) {
	        event.preventDefault();
	        $('html, body').stop().animate({
	            scrollTop: target.offset().top
	        }, 1000);
	    }
	}
	if (win.innerWidth() < 800) {
	    var target = $(this.getAttribute('href'));
	    if( target.length ) {
	        event.preventDefault();
	        $('html, body').stop().animate({
	            scrollTop: target.offset().top
	        }, 0);
	    }
	}
});

/*==================================================
Logo Toggle
==================================================*/

// var scrollTop;

// function updateScrollTop() {
// 	scrollTop = win.scrollTop();
// }
// win.on( 'scroll load', updateScrollTop );

// function extendedNav() {
// 	if ($('.logo-toggle-point').exists()) {
// 		var isextended = false,
// 			headerLogo = $( '.logo-toggle-point' ),
// 			navHeight = nav.height();
		
// 		function checkextendedNav() {
// 			swapPoint = headerLogo.offset().top + headerLogo.height() - navHeight;
// 			if( isextended && scrollTop < swapPoint ) {
// 				isextended = false;
// 				html.removeClass( 'logo-swap' );
// 			} else if( !isextended && scrollTop >= swapPoint ) {
// 				isextended = true;
// 				html.addClass( 'logo-swap' );
// 			}
// 		}

// 		function returnExpanded() {
// 			if(html.hasClass('tablet-size')) {
// 				html.removeClass('logo-swap');
// 			}
// 		}
		
// 		win.on( 'scroll resize', checkextendedNav );
// 		checkextendedNav();
// 		win.on( 'scroll resize', returnExpanded );
// 		returnExpanded();
// 	}
// }
// win.on( 'load', extendedNav );


/*==================================================
Replave SC href
==================================================*/

iFlink.click(function(){
    $(this).siblings(".iframe-content").find("iframe").prop("src", function(){
        // Set their src attribute to the value of data-src
      return $(this).data("src");
    });
});


}); // jQuery 