<section class="banners">
                        <div class="row">
                           @foreach($top_banner as $top_banner)
                            <div class="col-lg-4 col-md-6">
                                <div class="banner-img">
                                    <img src="{{url('storage/subscribebanner/'.$top_banner->images)}}" alt="" />
                                    <div class="banner-text">
                                        <h4>
                                            {{$top_banner->test}}
                                        </h4>
                                        <a href="{{$top_banner->description}}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           
                        </div>
                    </section>