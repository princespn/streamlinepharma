@extends('theams/theam1/layouts.app')

@section('theme1Content')

<!-- Product Section2 -->

<div class="product-section product-section1 product-section2 container-fluid no-padding">

    <!-- Container -->

    <div class="container">
                <select style='float: right;margin: 10px;' form='form' name='sortby'>
				   <option value=''>Sort BY</option>
				   <option value='ASC'>Price low to high</option>
				   <option value='DESC'>Price high to low</option>
				</select>
        <div class="row">

            <!-- Widget Area -->
            
            <div class="col-md-3 col-sm-3 col-xs-12 widget-area no-right-padding contact-us">

                {!! Form::open(['route' => 'filterInventory','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                {{ csrf_field() }}

                <aside class="widget widget_price_filter">
                    <h3 class="widget-title">filter by price</h3>
                    <div class="price-filter">
                        
                        <div id="slider-range"></div>

                        <div class="price-input">
                            <span id="amount"></span>
                            <span id="amount2"></span>
                        </div>
                        <input type="hidden" value="{{ ($pricing->min_price?$pricing->min_price:0) }}" id="minPrice">
                        <input type="hidden" value="{{ ($pricing->max_price? $pricing->max_price : 0 ) }}" id="maxPrice">

                        <input type="hidden" value="{{ ($pricing->min_price?$pricing->min_price:0) }}" name="minmumAmt" id="minmumAmt">
                        <input type="hidden" value="{{ ($pricing->max_price? $pricing->max_price : 0 ) }}" name="maximumAmt" id="maximumAmt">
                        
                    </div>
                </aside>

                <aside class="widget widget_categories">
                    <h3 class="widget-title">Color</h3>
					<ul>
					@foreach($all_color as $color)
					  <li style='background-color:{{ $color }};width: 20px;height: 20px;border:1px solid red;float:left;margin-right:3px;'><input type='checkbox' value='{{ $color }}' name='color[]'></li>
					@endforeach
					<ul>
				</aside>
				
				<aside class="widget widget_categories">
                    <h3 class="widget-title">Brand</h3>
					<ul>
                            @foreach ($brand as $row)
                                <label>
                                <input type="checkbox" value="{{ $row->id }}" name="brand[]">
                                    {{ $row->name }}
                                </label>
                                <br>
                            @endforeach
                        </ul>
				</aside>
                @if(isset($setting)&&$setting->additional_attribute!=Null)
					@foreach( json_decode($setting->additional_attribute)[0] as $key=>$row)
				<aside class="widget widget_categories">
                    <h3 class="widget-title">{{ $row }}</h3>
					@if(json_decode($setting->additional_attribute)[1][$key]=='Checkboxes')
					     <ul>
                            @foreach(explode(',',json_decode($setting->additional_attribute)[2][$key]) as $okey=>$opt)
                                <label for='additional_attribute{{ $key.$okey }}' name="add_filter[sad asds $ {{ $key.$okey }}]" >
                                <input type="checkbox" id='additional_attribute{{ $key.$okey }}' name="multi_add_filter[{{ $row }}][]" value='{{ $opt }}'>
                                    {{ $opt }}
                                </label>
                                <br>
                            @endforeach
                        </ul>
					@else
						<select class='form-control' name="single_add_filter[{{ $row }}]">
										    <option value=''></option> @foreach(explode(',',json_decode($setting->additional_attribute)[2][$key]) as $opt)
											<option>{{ $opt }}</option>
										    @endforeach
										    </select>
											<br>
					@endif
				</aside>
				    @endforeach
				@endif
                <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
				@if(isset($_GET['search']))
                    <input type="hidden" value="{{ $_GET['search'] }}" name='search_key' >
				@endif
                    <input type="hidden" value="{{ $id }}" name="id" >
                    <input type="hidden" value="{{ $sub_id }}" name="sub_id" >
                    <input type="hidden" value="{{ $template_id }}" name="template_id" >
                    <button type="submit" class="read-more">Search</button>
                </div>
                
                {!! Form::close() !!} 

            </div>
            
            <!-- Content Area -->

            <div class="col-md-9 col-sm-9 col-xs-12  widget-area no-right-padding">
                
                <div class="row content-area product-section2" id='ecommerce-products'>

                    


<!------------------------------------------------------------------->

                </div>

                

            </div>

            <!-- Content Area /- -->

        </div>

        <!-- Row /- -->



    </div>

    <!-- Container /- -->

</div>

<!-- Product Section2 /- -->

@endsection
@section('footer-script')
    <script>
	$("form input,form,select[name=sortby]").change(function() {
			  filterProduct();
	});
	$('#slider-range','.price-filter').click(function(){
		filterProduct();
	});
       function filterProduct(){
			$("#ecommerce-products").html('<div class="spinner-border"></div>');
			jQuery.ajax({
				url: "{{ url('filterProduct') }}",
				type: "GET",
				data : $('form').serialize(),
				success: function(data)
					{
					  console.log(data);
					  if(data.length){ 
						  for(var i = 0;i<data.length;i++){
							  $('<div class="col-md-4 col-sm-6 col-xs-12"><div class="type-post"><div class="entry-cover" style="text-align: center;"><a href="{{ url('detail') }}/'+data[i].sku+'"><img src="'+data[i].thumbnail+'" style="object-fit: cover;height: 300px;"></a></div><div class="blog-content"><h3 class="entry-title" style="height: 50px;overflow: hidden;"><a title="" href="{{ url('detail') }}/'+data[i].sku+'"><span>'+data[i].title+'</span></a></h3><div class="entry-meta"><span class="post-like"><del><i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>'+data[i].product_price+'</del>&nbsp;<b>'+data[i].discount+'% Off</b></span><span class="post-admin" style="color: #ec0000;"><i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i><b>'+data[i].selling_price+'</b></span></div><div class="entry-content"><a href="{{ url('detail') }}/'+data[i].sku+'" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a></div> </div></div></div>').appendTo("#ecommerce-products");
						  }
					  }else{
						  $("#ecommerce-products").html('No Product Found');
					  }
					}
				});
		}
		filterProduct();
</script>
@stop
