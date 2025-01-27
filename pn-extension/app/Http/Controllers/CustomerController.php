<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\EasyPay;
use App\Services\EasyPayService;

class CustomerController extends Controller
{
      protected $easyPayService;

    public function __construct(EasyPayService $easyPayService)
    {
        $this->easyPayService = $easyPayService;
    }

     /**
     * Display the Registration form
     */
    public function view(Request $request): View
    {
        return view('customer.view');
    }

     /**
      * Display the success page (Login Details & EP Number)
     */
    public function success(Request $request): View
    {
        //  dd($session->all());
        // dump(session()->all());

        // Retrieve values from session or query parameters
        $easypay_number= $request->query('easpy_number', session('easypay_number'));
        $receiverId = $request->query('receiverId', session('receiverId'));
        $customerId = $request->query('customerId', session('customerId'));
        $charLength= $request->query('charLength', session('charLength'));
        $checksum = $request->query('checksum', session('checksum'));

        // Ensure all values exist
        // if (!$easyPayNumber || !$receiverId || !$customerId || !$checksum) {
        //     abort(400, 'Invalid or missing EasyPay data.');
        // }

        // Pass values to the view
        return view('customer.success', [
            'easypay_number' => $easypay_number,
            'receiverId' => $receiverId,
            'customerId' => $customerId,
            'charLength' => $charLength,
            'checksum' => $checksum,
            'username' => $checksum,
            'password' => $checksum,

        ]);
    }

    /**
     * Register a new customer & Save Customer (modl) to db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Step 1 - Validate the request inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Ensure email is unique in the users table
            'phone' => 'required|string|max:20|regex:/^\+?[0-9\s\-]+$/', // Basic validation for phone number format
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipCode' => 'required|numeric|digits_between:4,10', // ZIP code with 4-10 digits
            'customerId' => 'required|numeric|min:1',
            'charLength' => 'required|numeric|min:1',
        ]);


        // Extract key values -> make a model?
        $customerId = $validated['customerId'];

        // Step 2 - Call API Request (method) to Register Customer on Splynx - Handle ERRORS
        // $response = $this->RegisterSplynxCustomer($customerId);

        // Move to SplynxApiService
        // Save Return Data to DB (Customer Model) - Handle ERRORS (Generate EasyPay Number if not ind db layer)
        $customer = Customer::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'], // Ensure email is unique in the users table
            'phone_number' => $validated['phone'], // Basic validation for phone number format
            'street' => $validated['phone'],
            'city' => $validated['phone'],
            'zip_code' => $validated['zipCode'], // ZIP code with 4-10 digits
            'agreed-terms' => 'as', // Splynx Customer ID
            'tarrif' => 'as', // Splynx Customer ID
            'splynx_id' => $customerId, // Splynx Customer ID
        ]);

        // dd($customer->splynx_id);
        // 3 - Generate & Save EasyPay Number
        $receiverId = config('easypay.recieverId');
        $character_limit = config('easypay.character_limit');
        // $easyPayNumber = $this->easypayService->($receiverId, $customerId, $character_limit);
        $easyPayNumber = $this->easyPayService->generate($customerId);

        // Move to EasyPayService
        // Create EasyPay Record
        $easypay = EasyPay::create([
            'customerId' => $customer->splynx_id,
            'splynx_id' => $customer->splynx_id,
            'easypay_number' => $easyPayNumber,
            'reciever_id' => $receiverId,
            'charachter_length' => $character_limit,
            'check_digit' => substr($easyPayNumber, -1),
        ]);

        // Step 3 - Redirect to Success page with Data
        return redirect()->route('customer.success')->with([
            'easypay_number' => $easypay->easypay_number,
            'receiverId' => $easypay->reciever_id,
            'customerId' => $customer->splynx_id,
            'charLength' => $easypay->character_limit,
            'checksum' => $easypay->check_digit,
            'username' => $customer->username,
            'password' => $customer->password,
        ]);
    }

   

   
}
