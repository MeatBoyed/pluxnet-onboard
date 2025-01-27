        <!-- Scripts -->
        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('Password copied to clipboard!');
                }).catch(err => {
                    alert('Failed to copy: ' + err);
                });
            }
        </script>
<x-guest-layout>
    <h1 class="text-2xl font-semibold text-gray-800">🎉 Welcome to {{ config('app.name', 'Our Platform') }}!</h1>
    <p class="mt-4 text-gray-600">Your registration is complete, and we're excited to have you on board.</p>

    <div class="mt-6">
        <h2 class="text-lg font-medium text-gray-700">Your Login Details</h2>
        <div class="mt-4 text-left">
            <p class="text-gray-700"><strong>Username:</strong> {{ $username }}</p>
            <p class="text-gray-700 flex items-center">
                <strong>Password:</strong>
                <span id="password" class="ml-2">{{ $password }}</span>
                <button onclick="copyToClipboard('{{ $password }}')" 
                        class="ml-4 px-2 py-1 bg-blue-500 text-white rounded-lg shadow text-sm hover:bg-blue-600 focus:outline-none">
                    Copy
                </button>
            </p>
            <p class="text-gray-700"><strong>EasyPay Number:</strong> {{ $easypay_number }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 focus:outline-none">
            Go to Login Page
        </a>
    </div>

    <p class="mt-6 text-sm text-gray-500">If you have any questions, feel free to contact our support team.</p>
</x-guest-layout>