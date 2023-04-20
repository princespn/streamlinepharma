<?php
use Illuminate\Support\Facades\Session;
 function ProductRating($id){ 
     $count=0;
     
     if($count==0){
        return '';
     }else{
         $rating="0";
         $star="0";
        return  '<div class="product-rate-cover"><div class="product-rate d-inline-block"><div class="product-rating" style="width: '.$star.'%"></div></div><span class="font-small ml-5 text-muted"> ('.$rating.')</span></div>';
     }
   
}
function wishcount(){
   if(isset(Session::get('register')->id)){
      return $count=DB::table('wishlist')->select('sku')->where('sku','!=','')->where('ragister_id',Session::get('register')->id)->count();
   }else{
      return '0';
   }

}
