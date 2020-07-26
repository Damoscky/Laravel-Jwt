<?php

namespace App\Services\Paystack;

use Illuminate\Http\Request;
use App\Services\CurlService;
use Illuminate\Support\Facades\Route;

class Verification
{
    /**
     * Verify BVN
     */
    public static function verifyBVN(Request $request){
        $url = "https://api.paystack.co/bvn/match";
        $secretKey = 'sk_test_7dfee06335a1641c85370085e0b8c5f3e828ca00';

        $headerParams = [
            'Authorization Bearer '.$secretKey,
        ];

        $postData = [
            'bvn' => $request->bvn,
            'account_number' => $request->account_no,
            'bank_code' => $request->bank_code,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname
        ];

        return $result = CurlService::postRequest($url, $postData, $headerParams);
        if ($result['ErrorResponse'] != null) {
            return false;
        }
        return $result;
    }

}
