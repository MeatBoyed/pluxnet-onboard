<x-guest-layout>
    <div class="flex justify-center items-center flex-col w-full h-full gap-10">
        <h1 class="text-4xl text-center font-bold">Welcome to PluxNet</h2>
        <form action="{{ route('customer.register') }}" class="flex flex-col items-start justify-center w-full gap-4" method="POST">
            @csrf
            <div class="w-full flex-col sm:flex-row flex gap-4">
                <!-- Name -->
                <div class="w-full">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full"  name="name" :value="old('name')" required autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Surname -->
                <div class="w-full">
                    <x-input-label for="surname" :value="__('Surname')" />
                    <x-text-input id="surname" class="block mt-1 w-full"  name="surname" :value="old('surname')" required autocomplete="surname" />
                    <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                </div>
            </div>

            <!-- Email -->
            <div class="w-full">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Phone Number -->
            <div class="w-full">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full"  name="phone" :value="old('phone')" required autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <!-- Street -->
            <div class="w-full">
                <x-input-label for="street" :value="__('Street')" />
                <x-text-input id="street" class="block mt-1 w-full"  name="street" :value="old('street')" required autocomplete="street" />
                <x-input-error :messages="$errors->get('street')" class="mt-2" />
            </div>
            <!-- City -->
            <div class="w-full">
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" class="block mt-1 w-full"  name="city" :value="old('city')" required autocomplete="city" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
            <!-- ZIP Code -->
            <div class="w-full">
                <x-input-label for="zipCode" :value="__('ZIP Code')" />
                <x-text-input id="zipCode" class="block mt-1 w-full"  name="zipCode" :value="old('zipCode')" required autocomplete="zipCode" />
                <x-input-error :messages="$errors->get('zipCode')" class="mt-2" />
            </div>


            <!-- CustomerId -->
            <div class="w-full">
                <x-input-label for="customerId" :value="__('Customer Id')" />
                <x-text-input id="customerId" class="block mt-1 w-full"  name="customerId" :value="old('customerId')" required autocomplete="customerId" />
                <x-input-error :messages="$errors->get('customerId')" class="mt-2" />
            </div>

            <!-- Character Length -->
            <div class="w-full">
                <x-input-label for="charLength" :value="__('charLegnth')" />
                <x-text-input id="charLength" class="block mt-1 w-full"  name="charLength" :value="old('charLength')" required autocomplete="charLength" />
                <x-input-error :messages="$errors->get('charLength')" class="mt-2" />
            </div>

            <div class="w-full">
                <button type="submit" class="bg-[#007BFF] text-white border-none px-3 py-4 hover:cursor-pointer hover:bg-[#0056b3] w-full rounded-md text-lg w-full">Generate EasyPay Number</button>
            </div>
        </form>
    </div>
</x-guest-layout>
