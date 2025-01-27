<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPay Number Generated</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">EasyPay Number Successfully Generated</h2>
        
        <!-- EasyPay Number Breakdown -->
        <div class="text-sm text-gray-600 mb-4">
            <div class="flex justify-between border-b py-2">
                <span class="font-medium">Constant:</span>
                <span>9</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-medium">Receiver ID:</span>
                <span>{{ $receiverId }}</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-medium">Customer ID:</span>
                <span>{{ $customerId }}</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-medium">Padded Customer ID:</span>
                <span>{{ $paddedCustomerId }}</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-medium">Checksum:</span>
                <span>{{ $checksum }}</span>
            </div>
            <div class="flex justify-between border-b py-2">
                <span class="font-medium">Character Length:</span>
                <span>{{ $character_limit }}</span>
            </div>
        </div>

        <!-- Full EasyPay Number -->
        <div class="output p-4 border border-dashed border-blue-500 rounded-md text-lg text-gray-700 ">
            <p class="text-xl font-bold text-blue-500 mb-2">Your EasyPay Number:</p>
            <p class="text-xl font-bold text-blue-500">
                {{ implode(' ', str_split($easypay_number, 4)) }} (Group of 4)
            </p>
            <p class="text-xl font-bold text-blue-500">
                {{ implode(' ', str_split($easypay_number, 3)) }} (Group of 3)
            </p>
        </div>

        <!-- Action Button -->
        <a href="{{ route('customer.view') }}" class="mt-5 inline-block bg-blue-500 text-white px-5 py-2 rounded-md text-base hover:bg-blue-600">
            Generate Another
        </a>
    </div>
</body>
</html>
