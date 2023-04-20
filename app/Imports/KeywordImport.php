<?php

namespace App\Imports;

use App\Models\AccountAffiliateKeywords;
use App\Models\AffiliateKeyword;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;

class KeywordImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
		if (!isset($row[0])) {
            return null;
        }
        $found=AffiliateKeyword::where('keyword' , $row[0])->count();
        $dKey=Session::get('duplicateKey');
        if($found){
            $dKey =$dKey.'<br/>'.$row[0];
            Session::put('duplicateKey',$dKey);
            return null;
        }
        $account_id = Session::get('user')->id;
        $affKey = AffiliateKeyword::create([
            'account_id' => $account_id,
            'keyword'     => $row[0],
            'status' => 2
        ]);
        return new AccountAffiliateKeywords([
            'account_id' => $account_id,
            'keyword_id'     => $affKey->id,
            'status' => 2
        ]);
    }
}
