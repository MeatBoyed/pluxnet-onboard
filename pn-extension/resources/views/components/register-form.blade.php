<?php // resources/views/components/register-form.blade.php ?>

<form action="{{ route('customer.register') }}" method="POST" class="space-y-6">
    @csrf
        <div>
            <x-input-label for="customerId" :value="__('Customer Id')" />
            <x-text-input id="customerId" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="customerId" :value="old('customerId')" required autocomplete="customerId" />
            <x-input-error :messages="$errors->get('customerId')" class="mt-2" />
        </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-md">
        <div>
            <x-input-label for="name" :value="__('First Name')" />
            <x-text-input id="name" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="surname" :value="__('Last Name')" />
            <x-text-input id="surname" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="surname" :value="old('surname')" required autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-input-label for="email" :value="__('Email Address')" />
        <x-text-input id="email" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="phone" :value="__('Phone Number')" />
        <x-text-input id="phone" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="phone" :value="old('phone')" required autocomplete="phone" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="street" :value="__('Street')" />
        <x-text-input id="street" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="street" :value="old('street')" required autocomplete="street" />
        <x-input-error :messages="$errors->get('street')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="city" :value="__('City')" />
        <x-text-input id="city" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="city" :value="old('city')" required autocomplete="city" />
        <x-input-error :messages="$errors->get('city')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="zip_code" :value="__('Zip Code')" />
        <x-text-input id="zip_code" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="zip_code" :value="old('zip_code')" required autocomplete="zip_code" />
        <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
    </div>


    <div class="flex items-start space-x-3">
        <input type="checkbox" id="agreed_terms" name="agreed_terms" required class="h-4 w-4 rounded border-gray-300 text-[#E0457B] focus:ring-[#E0457B] cursor-pointer">
        <div class="flex flex-col">
            <label for="terms" class="text-sm text-gray-700 cursor-pointer">I accept the Terms and Conditions and Privacy Policy</label>
            <span class="text-xs text-gray-500 mt-1">
                By checking this box, you agree to PluxNet's 
                <a href="#" class="text-[#E0457B] hover:underline">Terms of Service</a> and 
                <a href="#" class="text-[#E0457B] hover:underline">Privacy Policy</a>
            </span>
        </div>
    </div>

    <x-primary-button class="w-full text-center justify-center bg-pluxnet-navy items-center h-10">{{ __('Register Now') }}</x-primary-button>
</form>
