<?php

namespace App\Services;
use App\Models\Customer;
// use App\Services\TModel; // Commented out as TModel is not defined

class CustomerService
{
    
    /**
     * Register Customer to Splynx & Update Registry (DB).
     *
     * @param  string  $splynxId
     * @param  string  $payload
     * @return Customer
     */
    public function register(string $splynxId, array $payload) : Customer
    {

        // Move to SplynxApiService
        // Step 1 - Call API Request (method) to Register Customer on Splynx - Handle ERRORS
        // $response = $this->RegisterSplynxCustomer($customerId);

        // Save Return Data to DB (Customer Model) - Handle ERRORS (Generate EasyPay Number if not ind db layer)
        return Customer::create([
            'name' => $payload['name'],
            'surname' => $payload['surname'],
            'email' => $payload['email'], // Ensure email is unique in the users table
            'phone_number' => $payload['phone'], // Basic validation for phone number format
            'street' => $payload['street'],
            'city' => $payload['city'],
            'zip_code' => $payload['zip_code'], // ZIP code with 4-10 digits
            'agreed-terms' => 'agreed_terms', // Splynx Customer ID
            'tarrif' => 'as', // Splynx Customer ID
            'splynx_id' => $splynxId, // Splynx Customer ID
        ]);
    }
}
