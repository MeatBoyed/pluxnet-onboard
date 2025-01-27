<!-- <!DOCTYPE html>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
-->
<x-guest-layout>
    <!-- <div class="container"> -->
        <!-- <h2>EasyPay Number Generator</h2> -->
        <form action="{{ route('easypay.generate') }}" class="flex flex-col items-start justify-center w-full gap-4" method="POST">
            @csrf
            <!-- Email -->
            <!-- <div class="w-full">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div> -->
            <!-- CustomerId -->
            <div class="w-full">
                <x-input-label for="customerId" :value="__('Customer Id')" />
                <x-text-input id="customerId" class="block mt-1 w-full"  name="customerId" :value="old('customerId')" required autocomplete="customerId" />
                <x-input-error :messages="$errors->get('customerId')" class="mt-2" />
            </div>

            <div class="w-full">
                <button type="submit" class="bg-[#007BFF] text-white border-none px-3 py-4 hover:cursor-pointer hover:bg-[#0056b3] w-full rounded-md text-lg w-full">Generate EasyPay Number</button>
            </div>
        </form>
    <!-- </div> -->
</x-guest-layout>
<!-- </body>
</html> -->
