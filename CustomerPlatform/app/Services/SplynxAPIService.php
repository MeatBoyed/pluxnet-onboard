<?php

namespace App\Services;

use App\Models\EasyPay;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;

class SplynxAPIService 
{


    /**
     * Used for General GET Requests
     * @param string $endpoint
     * @return array{data: mixed, success: bool|array{data: null, success: bool}}
     */
    public function get(string $endpoint)
    {
        $SplynxEndpoint = config('splynx.host');
        $response = Http::withHeaders([
            'Authorization' => $this->generateSignature(),
        ])->get("{$SplynxEndpoint}/{$endpoint}");

        $responseData = $response->json();

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $responseData,
            ];
        }

        return [
            'success' => false,
            'data'    => null,
        ];
    }

    /**
     * Used for General Post Requests
     * @param string $endpoint
     * @param array $payload
     * @return array{data: mixed, success: bool|array{data: null, success: bool}}
     */
    public function post(string $endpoint, array $payload)
    {
        $SplynxEndpoint = config('splynx.host');
        $response = Http::withHeaders([
            'Authorization' => $this->generateSignature(),
        ])->post($SplynxEndpoint . '/' . $endpoint, $payload);

        $responseData = $response->json();

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $responseData,
            ];
        }

        return [
            'success' => false,
            'data'    => null,
        ];
    }
    
    // public function checkStatus() : string {
    //    $response = Http::withHeaders([
    //         'Authorization' => $this->generateSignatureHeader(),
    //     ])->check($this->SplynxPluxnetEndpoint . '/api/check');
    // }
    
    /**
     * Generates Authentication Header for Requests
     * @return string
     */
    private function generateSignature(): string {
        $api_key = config('splynx.key');
        $api_secret = config('splynx.secret');

        $nonce = round(microtime(true) * 100);

        $signature = strtoupper(hash_hmac('sha256', $nonce . $api_key, $api_secret));

        $auth_data = array(
            'key' => $api_key,
            'signature' => $signature,
            'nonce' => $nonce++
        );

        $auth_string = http_build_query($auth_data);

        $signature= 'Splynx-EA (' . $auth_string . ')';
        return $signature;
    }

}
