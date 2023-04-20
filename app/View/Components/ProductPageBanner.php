<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use DB;
use MainAccount;

class ProductPageBanner extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $product_page_banner=DB::table('product_page_banners')->where('status',1)->where('register_id',MainAccount::MyUser()->id)->orderBy('id','DESC')->limit(1)->get();
 
        return view('components.product-page-banner')->with('product_page_banner',$product_page_banner);
    }
}
