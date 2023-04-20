<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;
use App\Models\Account;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $currency = array('title'=>'Rs','code'=>'inr','symbol'=>'₹','value'=>'1.00');
        Currency::create($currency);

        $account = array('color'=>'#fff','domain'=>'uniqueandcommon.com', 'charge'=>'15', 'defaultCurrency'=>1,'logo'=>'assets/images/logo_dark.png','title'=>'UandC','phone'=>'9872577500','email'=>'poriyaharesh@gmail.com','address'=>'surat','password'=>bcrypt('123456'));
        Account::create($account);
    }
}
