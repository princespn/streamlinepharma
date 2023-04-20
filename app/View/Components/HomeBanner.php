<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use DB;
use MainAccount;

class HomeBanner extends Component
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
        $offer_banners=DB::table('offer_banners')->where('status',1)->where('register_id',MainAccount::MyUser()->id)->get();
        $home_banners=DB::table('home_banners')->where('status',1)->where('register_id',MainAccount::MyUser()->id)->get();
        return view('components.home-banner')->with('offer_banners',$offer_banners)->with('home_banners',$home_banners);
    }
}
