<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
     /**
     * Display the user's profile form.
     */
    public function view(Request $request): View
    {
        return view('customer.index');
    }

     /**
     * Display the user's profile form.
     */
    public function success(Request $request): View
    {
        //  dd($session->all());
        // dump(session()->all());

        // Retrieve values from session or query parameters
        $easyPayNumber = $request->query('easyPayNumber', session('easyPayNumber'));
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
            'easyPayNumber' => $easyPayNumber,
            'receiverId' => $receiverId,
            'customerId' => $customerId,
            'charLength' => $charLength,
            'checksum' => $checksum,
        ]);
    }

    /**
     * Handle the submission of the EasyPay form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request input
        $validated = $request->validate([
            'customerId' => 'required|numeric|min:1',
            'charLength' => 'required|numeric|min:1',
        ]);

        // Simulate EasyPay number generation (replace with actual logic)
        $customerId = $validated['customerId'];
        $charLength = $validated['charLength'];
        $receiverId = '4545'; // Example fixed Receiver ID
        $easyPayNumber = $this->generateEasyPayNumber($receiverId, $customerId, $charLength);

        // Redirect to the success page with the EasyPay number
        // return redirect()->route('customer.success')->with('easyPayNumber', $easyPayNumber);
        return redirect()->route('customer.success')->with([
            'easyPayNumber' => $easyPayNumber,
            'receiverId' => $receiverId,
            'customerId' => $customerId,
            'charLength' => $charLength,
            'checksum' => substr($easyPayNumber, -1),
        ]);
    }

    /**
     * Generate an EasyPay number.
     *
     * @param  string  $receiverId
     * @param  string  $customerId
     * @return string
     */
    private function generateEasyPayNumber(string $receiverId, string $customerId, int $length) : string
    {
        $paddedCustomerId = str_pad($customerId, $length, '0', STR_PAD_RIGHT);
        $baseNumber = $receiverId . $paddedCustomerId;
        $checkDigit = $this->calculateLuhnCheckDigit($baseNumber);

        return '9' . $baseNumber . $checkDigit;
    }

    /**
     * Calculate the Luhn checksum digit.
     *
     * @param  string  $number
     * @return int
     */
    private function calculateLuhnCheckDigit(string $number): int
    {
        $sum = 0;
        $reverseDigits = strrev($number);

        for ($i = 0; $i < strlen($reverseDigits); $i++) {
            $digit = (int) $reverseDigits[$i];

            if ($i % 2 === 1) { // Double every second digit
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return (10 - ($sum % 10)) % 10;
    }
}
