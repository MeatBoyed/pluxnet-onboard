

        <x-guest-layout>

            <h1 class="text-2xl font-semibold text-gray-800">🎉 Welcome to {{ config('app.name', 'Our Platform') }}!</h1>
            <p class="mt-4 text-gray-600">Your registration is complete, and we're excited to have you on board.</p>

            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-700">Your Login Details</h2>
                <div class="mt-4 text-left">
                    <p class=""><strong>Username:</strong> {{ $username }}</p>
                    <p class="">
                        <strong>Password:</strong>
                        <span id="password" class="ml-2">{{ $password }}</span>
                        <button onclick="copyToClipboard('{{ $password }}')" 
                                style="background-color: #3b82f6; color: white; padding: 0.5rem 0.5rem; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);"
                                class="ml-4 text-xs hover:bg-blue-600 focus:outline-none">
                            Copy
                        </button>
                    </p>
                    <p class="text-gray-700"><strong>EasyPay Number:</strong> {{ $easypay_number }}
                        <button onclick="copyToClipboard('{{ $easypay_number}}')" 
                                style="background-color: #3b82f6; color: white; padding: 0.5rem 0.5rem; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);"
                                class="ml-4 text-xs hover:bg-blue-600 focus:outline-none">
                            Copy
                        </button>
                    </p>
                </div>
            </div>

            <div class="mt-6">
               
            </div>

            <p class="mt-6 text-sm text-gray-500">If you have any questions, feel free to contact our support team.</p>
        </x-guest-layout>