<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Session;
use App\Models\AdvanceProduct;
use App\Models\Account;
class QrCodeController extends Controller
{
    public function download_qr_aff($id,$code){
        $product = AdvanceProduct::where('sku',$id)
		->first();
        $domainName = $this->activeDomain();
        $account = Account::where('id', $product->account_id)->with(['currency'])
            ->first();
            //var_dump($account);exit;
        $product = AdvanceProduct::where('sku',$id)
		->where('account_id',$account->id)
		->first();
        
        //dd($orderList);
		$data = [
            'product' => $product,
            'account' => $account,
            'code'=>$code
        ];
        return view('affiliate/myLink/print_qr', $data);  exit;
        $pdf = PDF::loadView('affiliate/myLink/print_qr', $data);
    
        return $pdf->download('qr-'.$product->sku.'.pdf');
    }
}
