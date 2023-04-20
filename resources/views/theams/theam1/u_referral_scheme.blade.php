@extends('theams/theam1/layouts.app')
@section('theme1Content')
<style>
* {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 350px;
  padding: 8px;
}

.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
  background-color: #111;
  color: white;
  font-size: 25px;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>
    <!-- Page Banner -->
    <!--div class="page-banner container-fluid no-padding">
        <div class="container">
            <div class="banner-content">
                <h3>Subscription Plan</h3>
            </div>
            <ol class="breadcrumb">
                <li><a href="/" title="Home">Home</a></li>
                <li class="active">Subscription Plan</li>
            </ol>
        </div>
    </div-->

    <!-- About Section -->
	<div class="container-fluid no-padding">
	  @foreach($data as $key=>$row)
	    <div style='position:relative'>
		    <img src="{{ $row->image }}"  style="width:100%;">
		    <div style='width: 100%;position: absolute;top:0px;'>
			  <div style=''>
				<h2>{!! $row->title !!}</h2>
				<h4>{!! $row->sub_title !!}</h4>
			  </div>
			</div>
		</div>
	  @endforeach 
	</div>
	
    

    @endsection
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function subscription(id){
	jQuery.ajax({
        url: "subscription/"+id,
        type: "GET",
        success: function(data)
        {
           console.log(data); 
		   var options = {
							"key": data.key,
							"subscription_id": data.subscription_id,
							"name": data.name,
							"description": data.description,
							"image": data.image,
							"callback_url": data.callback_url,
							"prefill": {
							  "name": data.prefill.name,
							  "email": '',
							  "contact": ''
							},
							"theme": {
							  "color": data.theme.color
							}
						  };
		   var rzp1 = new Razorpay(options);
           rzp1.open();
           //e.preventDefault();
           
        }
    });
}
</script>