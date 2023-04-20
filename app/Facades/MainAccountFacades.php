<?php
 namespace App\Facades;
 use Illuminate\Support\Facades\Facade;
 use App\Models\Account;
 use App\Models\Category;
 

 class MainAccountFacades extends Facade{
     protected static function getFacadeAccessor(){
         return "MainAccount";
     }
     public static function  MyUser(){
        $domainName = $_SERVER['HTTP_HOST'];
        $account = Account::where('domain', $domainName)->with(['currency'])->first();
        return $account;
     }
     public  static function categoryList(){
        return $categoryList = Category::where('account_id' , MainAccount::MyUser()->id)->whereNull('ref_id')->whereNull('deleted_at')->get();
     }
 }