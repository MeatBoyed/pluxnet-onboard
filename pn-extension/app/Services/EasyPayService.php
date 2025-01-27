<?php

namespace App\Services;

class EasyPayService
{
    
    /**
     * Generate an EasyPay number.
     *
     * @param  string  $customerId
     * @return string
     */
    public function generate(string $customerId) : string
    {
        // Get Configs
        $receiverId = config('easypay.recieverId');
        $length = config('easypay.character_limit');
        
        // Append extra zeros to the customer ID
        $paddedCustomerId = str_pad($customerId, $length, '0', STR_PAD_RIGHT);
        $baseNumber = $receiverId . $paddedCustomerId;
        
        // Calculate the Luhn checksum digit
        $checkDigit = $this->calculateLuhnCheckDigit($baseNumber);
        
        // Create the EasyPay number
        return '9' . $receiverId . $paddedCustomerId . $checkDigit;
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
