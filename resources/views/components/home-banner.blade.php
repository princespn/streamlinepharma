<section class="newsletter mb-15">
            <div class="container">
                <div class="row">
                  @foreach($home_banners as $home_banners)
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner">
                            <div class="newsletter-content">
                                <h2 class="mb-20">
                                   {{$home_banners->title}}
                                   
                                </h2>
                                <p class="mb-45">{{$home_banners->button_test}}<span class="text-brand">{{$_SERVER['HTTP_HOST']}}</span></p>
                                <form class="form-subcriber d-flex">
                                    <input type="email" placeholder="Your emaill address" />
                                    <button class="btn" type="submit">Subscribe</button>
                                </form>
                            </div>
                            <img src="{{url('storage/banner/'.$home_banners->lmage_banner)}}" alt="newsletter" />
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>

        <section class="featured section-padding">
            <div class="container">
                <div class="row">
                  @foreach($offer_banners as $offer_banners)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                            <div class="banner-icon">
                                <img src="{{url('storage/offerbanner/'.$offer_banners->icon)}}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">{{$offer_banners->test}}</h3>
                                <p>{{$offer_banners->sub_test}}</p>
                            </div>
                        </div>
                    </div>
                  @endforeach 
                </div>
            </div>
        </section>