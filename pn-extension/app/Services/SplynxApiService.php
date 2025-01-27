<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class SplynxApiService
{
    
    /**
     * Generate an EasyPay number.
     *
     * @param  string  $receiverId
     * @param  string  $customerId
     * @return string
     */
    public function RegisterSplynxCustomer(string $customerId) : string
    {

        // API Configs
        $api_key = config('api.key');
        $api_url = config('api.url');
        $api_secret = config('api.secret');
        $nonce = round(microtime(true) * 100);
        $signature = strtoupper(hash_hmac('sha256', $nonce . $api_key, $api_secret));
        $auth_data = array(
            'key' => $api_key,
            'signature' => $signature,
            'nonce' => $nonce++
        );
        $auth_string = http_build_query($auth_data);

        // $header = 'Authorization: Splynx-EA (' . $auth_string . ')';    
        // $authHeaderValue = 'Splynx-EA (' . $auth_string . ')';
        
        // $response = Http::withHeaders([
        //     'Authorization' => 'Splynx-EA (' . $auth_string . ')',
        //     'Content-Type' => 'application/json',
        //     'Accept' => 'application/json',
        // ])->post($api_url, [
        //     'name' => 'John Doe',
        //     'email' => 'asda'
        // ]);
        dump($auth_string);

        $response = Http::withHeaders([
            'Authorization' => 'Splynx-EA (' . $auth_string . ')',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get('https://portal.pluxnet.co.za/api/2.0/admin/customers/customer/13147');
        dd($response);

        return '';
    }

    
}
