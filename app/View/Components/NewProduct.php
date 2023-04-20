<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use DB;
use MainAccount;
use App\Models\AdvanceProduct;


class NewProduct extends Component
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
        $new_product = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status','Active')->where('account_id',MainAccount::MyUser()->id)->where('qc',1)->limit(4)->orderBy('id','desc')->get();
        return view('components.new-product')->with('new_product',$new_product);
    }
}
