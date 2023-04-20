@if(count($product_page_banner) >=1)
@foreach($product_page_banner as $k=>$product_page_banner)
<div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                        <img src="{{url('storage/productPageBanner/'.$product_page_banner->images)}}" alt="" />
                        <div class="banner-text">
                           
                            <h4>
                            {{$product_page_banner->test}}
                            </h4>
                        </div>
</div>
@endforeach
@endif