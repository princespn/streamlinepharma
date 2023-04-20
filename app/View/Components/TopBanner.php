<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use DB;
use MainAccount;

class TopBanner extends Component
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
        $top_banner=DB::table('subscribe_banners')->where('register_id',MainAccount::MyUser()->id)->where('status',1)->get();
        
        return view('components.top-banner')->with('top_banner',$top_banner);
    }
}
