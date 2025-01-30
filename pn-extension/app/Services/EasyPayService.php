<?php

namespace App\Services;

use App\Models\EasyPay;
use App\Models\Customer;

class EasyPayService
{


    /**
     * Generate an EasyPay number.
     *
     * @param  Customer $customer
     * @return EasyPay
     */
    public function save(Customer $customer ) : EasyPay
    {
        // Get Configs
        $recieverId = config('easypay.recieverId');
        $character_limit = config('easypay.character_limit');

        // 1 - Generate EasyPay Number
        $easyPayNumber = $this->generate($customer->splynxId);

        // 2 - Create EasyPay Record
        return EasyPay::create([
            'customerId' => $customer->splynx_id,
            'splynx_id' => $customer->splynx_id,
            'easypay_number' => $easyPayNumber,
            'reciever_id' => $recieverId,
            'charachter_length' => $character_limit,
            'check_digit' => substr($easyPayNumber, -1),
        ]);
    }

    /**
     * Generate an EasyPay number.
     *
     * @param  string  $customerId
     * @return string
     */
    public function generate(string $customerId) : string
    {
        // Get Configs
        $recieverId = config('easypay.recieverId');
        $character_limit = config('easypay.character_limit');

        // Append extra zeros to the customer ID
        $paddedCustomerId = str_pad($customerId, $character_limit, '0', STR_PAD_RIGHT);
        $baseNumber = $recieverId . $paddedCustomerId;
        
        // Calculate the Luhn checksum digit
        $checkDigit = $this->calculateLuhnCheckDigit($baseNumber);
        
        // Create the EasyPay number
        return '9' . $recieverId . $paddedCustomerId . $checkDigit;
        //      Const, RecieverId,  CustomerId + Padding (0),  CheckDigit
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
