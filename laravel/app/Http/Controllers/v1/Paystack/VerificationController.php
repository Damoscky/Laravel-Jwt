<?php

namespace App\Http\Controllers\v1\Paystack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Paystack\Verification;
use Validator;

class VerificationController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->only('firstname', 'lastname', 'account_no', 'bvn', 'bank_code');
        $rules = [
            ['bvn' => 'required']
        ];

        $validateBVN = Validator::make($credentials, $rules[0]);
        if ($validateBVN->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'BVN is required',
                'data' => null
            ]);
        }

        try {
            $data = Verification::verifyBVN($request);
            if (!$data) {
                return response()->json([
                    'error' => true,
                    'message' => 'Error occured',
                    'data' => null
                ]);
            }
            return response()->json([
                'error' => false,
                'message' => null,
                'data' => $data
            ]);
        } catch (\Exception $er) {
            return response()->json([
                'error' => true,
                'message' => $er->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Verify BVN
     */
    public function verify(Request $request)
    {
        $url = "https://api.paystack.co/bvn/match";
        $fields = [
            "bvn" => "12345678912",
            "account_number" => "0000000000",
            "bank_code" => "087",
            "first_name" => "bojack",
            "last_name" => "horseman"
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_test_7dfee06335a1641c85370085e0b8c5f3e828ca00",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        return $result;
    }
}
