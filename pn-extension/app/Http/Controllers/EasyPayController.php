<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\EasyPayService;

class EasyPayController extends Controller
{
    
    protected $easyPayService;

    public function __construct(EasyPayService $easyPayService)
    {
        $this->easyPayService = $easyPayService;
    }
    
    /**
     * Display the user's profile form.
     */
    public function view(Request $request): View
    {
        return view('easypay.view');
    }


    /**
     * Display the user's success.
     */
    public function success(Request $request): View
    {
        return view('easypay.success');
    }
    /**
     * Display the user's success.
     */
    public function generate(Request $request): View
    {
        // Step 1 - Validate the request inputs
        $validated = $request->validate([
            // 'email' => 'required|email|max:255|unique:users,email', // Ensure email is unique in the users table
            'customerId' => 'required|numeric|min:1',
        ]);

        // Step 2 - Generate EasyPay Number
        $easypay_number = $this->easyPayService->generate($validated['customerId']);

        return view('easypay.success', [
            'constant' => '9',
            'customerId' => $validated['customerId'],
            'paddedCustomerId' => str_pad($validated['customerId'], config('easypay.character_limit'), '0', STR_PAD_RIGHT),
            'checksum' => $easypay_number[strlen($easypay_number) - 1],
            'character_limit' => config('easypay.character_limit'),
            'receiverId' => config('easypay.recieverId'),
            'easypay_number' => $easypay_number,
        ]);
    }
}
