<?php

namespace App\Services;

class CurlService
{
    /**
     * Get Request
     */
    public static function getRequest()
    {
        # code...
    }

    /**
     * Post Request
     */
    public static function postRequest($url, $postData, $headerParams = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);

        // Header parameter
        $baseHeader = [
            'Content-Type: application/json',
        ];

        if (is_null($headerParams)) {
            $headers = $baseHeader;
        } else {
            $headers = array_merge($baseHeader, $headerParams);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $request = curl_exec($ch);

        if ($request) {
            $result = json_decode($request, true);
            return $result;
        }else{
            if(curl_error($ch)){
                return 'error:' . curl_error($ch);
            }
        }

        curl_close($ch);
    }

}
