<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use DB;
use MainAccount;
use App\Models\Purchaseoffer; 

class DealsOfTheDay extends Component
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

        $deals = Purchaseoffer::
        where('account_id',MainAccount::MyUser()->id)
        ->where('startDate','<=',date('Y-m-d H:i:s'))
        ->where('endDate','>=',date('Y-m-d H:i:s'))->limit(8)->get();
        return view('components.deals-of-the-day')->with('deals',$deals);
    }
}
