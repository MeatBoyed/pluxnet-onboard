<?php

namespace App\Console\Commands;

use App\Services\SplynxCustomerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SplynxCustomers extends Command
{
    // Define the command signature
    protected $signature = 'app:splynx-customers   
        {name : Customer name}
        {email : Customer email}
        {phone : Customer phone}
        {street : Customer street}
        {zip : Customer zip code}
        {city : Customer city}';

    protected $description = 'Creates a new customer using the CustomerService';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $service = new SplynxCustomerService();

        // Retrieve arguments
        $name = $this->argument('name');
        $email = $this->argument('email');
        $phone = $this->argument('phone');
        $street = $this->argument('street');
        $zip = $this->argument('zip');
        $city = $this->argument('city');

        // Call the service
        $response = $service->create($name, 'charles', $email, $phone, 'person', $street, $zip, $city);

        // Output result
        $this->info('Customer created successfully!');
        $this->info(json_encode($response, JSON_PRETTY_PRINT));
    }
}
