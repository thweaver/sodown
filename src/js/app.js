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
	sectionOne = $('#home'),
	sectionTwo = $('#tour'),
	sectionThree = $('#music'),
	sectionFour = $('#shop'),
	sectionFive = $('#videos'),
	sectionSix = $('#photos'),
	bgOne = $('#bg-1'),
	bgTwo = $('#bg-2'),
	bgThree = $('#bg-3'),
	bgFive = $('#bg-5'),
	bgSix = $('#bg-6'),
	bgFour = $('#bg-4');

function updateSection() {
	if (win.scrollTop() >= sectionOne.offset().top - 300 && body.hasClass('home') ) { 
		navItem.removeClass('nav-item-current');
	}
}

function updateSectionTwo() {
	if (win.scrollTop() >= sectionTwo.offset().top  - 300 && body.hasClass('home')) { 
		navItem.removeClass('nav-item-current');
		$('#nav-tour').addClass('nav-item-current');
	}
}

function updateSectionThree() {
	if (win.scrollTop() >= sectionThree.offset().top  - 300 && body.hasClass('home')) { 
		navItem.removeClass('nav-item-current');
		$('#nav-music').addClass('nav-item-current');
	}
}

function updateSectionFour() {
	if (win.scrollTop() >= sectionFour.offset().top  - 300 && body.hasClass('home')) { 
		navItem.removeClass('nav-item-current');
		$('#nav-shop').addClass('nav-item-current');
	}
}

function updateSectionFive() {
	if (win.scrollTop() >= sectionFive.offset().top  - 300 && body.hasClass('home')) { 
		navItem.removeClass('nav-item-current');
		$('#nav-videos').addClass('nav-item-current');
	}
}

function updateSectionSix() {
	if (win.scrollTop() >= sectionSix.offset().top  - 300 && body.hasClass('home')) { 
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


$( window ).ready(function() {
  
    var wHeight = $(window).height();

    $('section')
      .scrollie({
        scrollOffset : -50,
        scrollingInView : function(elem) {
                   
          var bgImage = elem.data('class');
          $('#background').removeClass();
          $('#background').addClass(bgImage);
          
        }
      });

  });

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
					$("video").prop('muted', true);
				} else if( !isStopped && scrollTop >= stopPoint ) {
					isStopped = true;
					$('video').get(0).pause();
					$("video").prop('muted', true);
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
				} else if( !isextended && scrollTop >= swapPoint ) {
					isextended = true;
					html.delay(200).addClass( 'active-nav' );
				}
			}
			
			win.on( 'scroll resize', checkextendedNav );
			checkextendedNav();
		}
}
win.on( 'load', extendedNav );

/*==================================================
Scroll To
==================================================*/

$('a[href^="#"]').on('click', function(event) {
	if (win.innerWidth() >= 800 && body.hasClass('home')) {
	    var target = $(this.getAttribute('href'));
	    if( target.length ) {
	        event.preventDefault();
	        $('html, body').stop().animate({
	            scrollTop: target.offset().top
	        }, 1000);
	    }
	}
	if (win.innerWidth() < 800 && body.hasClass('home')) {
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
Replave SC href
==================================================*/

$(document).ready(function(){
 
        $.ajaxSetup({cache:false});
        $(".if-link").click(function(){
            var post_link = $(this).attr("href");
 
            $(".video-container").html("content loading");
            $(".video-container").load(post_link);
        return false;
        });
 
    });


/*===============================================
IE 10
===============================================*/

if (navigator.userAgent.match('MSIE 10.0;')) {
  $('html').addClass('ie10');
}

if (Object.hasOwnProperty.call(window, "ActiveXObject") && !window.ActiveXObject) {
    $('html').addClass('ie11');
}


}); // jQuery 