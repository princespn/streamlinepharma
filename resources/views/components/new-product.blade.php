<div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                        <h5 class="section-title style-1 mb-30">New products</h5>
                        @foreach($new_product as $new_product)
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset($new_product->thumbnail) }}" alt="#" />
                            </div>
                            <div class="content pt-10">
                                <h5><a href="{{url('product-single-shop/'.$new_product->sku)}}">{{substr($new_product->title, 0, 7) . '...'}}</a></h5>
                                <p class="price mb-0 mt-5">₹{{$new_product->selling_price}}</p>
                                {!! ProductRating($new_product->id) !!}
                            </div>
                        </div>
                        @endforeach
                      
                       
                    </div>