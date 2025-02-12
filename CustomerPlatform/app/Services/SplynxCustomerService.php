<?php

namespace App\Services;

use App\DTO\CustomerDTO;
use App\Models\EasyPay;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;

class SplynxCustomerService
{

    # /Entity/Endpoint
    private string $Entity = '/customers'; 
    
    /**
     * Summary of get
     * @param string $customerId
     * @return array{customer: CustomerDTO|null, success: array{data: null, success: bool|bool}}
     */
    public function get(string $customerId) {
        $Splynx = new SplynxAPIService();
        # Endpoint
        $endpoint = $this->Entity . '/customer' . '/' . $customerId;

        $response = $Splynx->get($endpoint);
        $customer = CustomerDTO::fromArray($response['data']) ?? null;
        // return response()->json($customer->toArray());

        return [
            'success' => $response['success'],
            'customer' => $customer,
        ];
    }

    /**
     * Summary of create
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $phone
     * @param string $customer_type
     * @param string $address
     * @param string $zip_code
     * @param string $city
     * @return array{customer: CustomerDTO|null, message: string, success: array{data: null, success: bool}|array{customer: null, message: string, success: array{data: null, success: bool}|bool}|array{id: mixed, message: string, success: array{data: null, success: bool}}}
     */
    public function create(
        string $name, string $surname, string $email, 
        string $phone, string $customer_type, string $address, 
        string $zip_code, string $city)
    {
        $Splynx = new SplynxAPIService();
        
        # Endpoint
        $endpoint = $this->Entity . '/customer';

        # Create Customer Payload
        $payload = [
            'login' => $name . '_' . $surname,
            'status' => 'new',                  # Default as a New Customer
            'partner_id' => 1, 
            'location_id' => 1,
            'name' => $name . $surname,
            'email' => $email,
            'billing_email' => $email,
            'phone' => $phone,
            'category' => $customer_type,       # Individual or Business (Dependant on their Tariff Option)
            'street_1' => $address,
            'zip_code' => $zip_code,
            'city' => $city,
            'date_add' => now()->format('Y-m-d'),
            // 'customer_labels' => '',
        ];
        
        // Creating Customer in Splynx
        $response = $Splynx->post($endpoint, $payload);
        if (!$response['success']) {
            return [
                'success' => $response['success'],
                'message' => 'Failed to create customer',
                'customer'    => null,
            ];
        }

        // Getting Customer Profile from Splynx
        $getResponse = $this->get($response['data']['id']);
        if (!$getResponse['success']) {
            return [
                'success' => $getResponse['success'],
                'message' => 'Failed to fetch customer',
                'id'    => $response['data']['id'] ?? null,
            ];
        }

        return [
            'success' => $getResponse['success'],
            'message' => 'Customer created & fetched successfully!',
            'customer'    => $getResponse['customer'] ?? null,
        ];
    }

    
    // public function checkStatus() : string {
    //    $response = Http::withHeaders([
    //         'Authorization' => $this->generateSignatureHeader(),
    //     ])->check($this->SplynxPluxnetEndpoint . '/api/check');
    // }

}
