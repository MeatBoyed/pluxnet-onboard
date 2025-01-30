<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\EasyPay;
use App\Services\EasyPayService;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    protected $easyPayService;
    protected $customerService;

    public function __construct(EasyPayService $easyPayService, CustomerService $customerService)
    {
        $this->easyPayService = $easyPayService;
        $this->customerService = $customerService;
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
     * @return \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View
     */
    public function register(Request $request): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View
    {
        // Step 1 - Validate the request inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Ensure email is unique in the users table
            'phone' => 'required|string|max:20|regex:/^\+?[0-9\s\-]+$/', // Basic validation for phone number format
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|numeric|digits_between:4,10', // ZIP code with 4-10 digits
            'agreed_terms' => 'required|numeric|min:1',
            'customerId' => 'required|string|max:255',
        ]);


        // Extract key values -> make a model?
        $customerId = $validated['customerId'];

        $customer = $this->customerService->register($customerId, $validated);
        $easypay = $this->easyPayService->save($customer);
        // Customer::where('splynx_id', $customer->splynx_id)->update(['easypay_id' => $easypay->id]);

        dd($customer);
        dd($easypay);

        // Step 3 - Redirect to Success page with Data
        // return redirect()->route('customer.success')->with([
        //     'easypay_number' => $easypay->easypay_number,
        //     'receiverId' => $easypay->reciever_id,
        //     'customerId' => $customer->splynx_id,
        //     'charLength' => $easypay->character_limit,
        //     'checksum' => $easypay->check_digit,
        //     'username' => $customer->username,
        //     'password' => $customer->password,
        // ]);
        return view('customer.success', [
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
