<?php

use App\Models\User;
use App\Models\Customer;
use App\Models\EasyPay;
use App\Services\EasyPayService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    // Dummy data
    public string $name = 'john';
    public string $surname = 'doe';
    public string $email = '';
    public string $phone_number = '1234556';
    public string $street = 'Shimbali';
    public string $city = 'Sands';
    public string $zip_code = '12345';
    public string $tarrif = '';
    public string $agreed_terms = 'yes';
    public string $password = 'password1234';
    public string $password_confirmation = 'password1234';

    public string $selectedTariff = '';

    public array $tariffs = [
        'Home Basic' => '399',
        'Home Starter' => '499',
        'Home Surfer' => '649',
        'Home Rocket' => '799',
        'Home Giga' => '1899',
        'Business Package' => '1399',
        'Enterprise Package' => '1399',
    ];

    // public string $name = '';
    // public string $surname = '';
    // public string $email = '';
    // public string $phone_number = '';
    // public string $street = '';
    // public string $city = '';
    // public string $zip_code = '';
    // public string $tarrif = '';
    // public string $agreed_terms = '';
    // public string $password = '';
    // public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'max:20'],
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:20'],
            'tarrif' => ['required', 'string', 'max:255'],
            'agreed_terms' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        
        dd($validated['tarrif']);

        // Encrypt the password for the User model
        $validated['password'] = Hash::make($validated['password']);

        DB::transaction(function () use ($validated) {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            // Create the corresponding customer record
            $customer = Customer::create([
                'id' => $user->id, // Assuming the `customers` table has a `user_id` foreign key
                'splynx_id' => '1234', // Default value
                'username' => $validated['email'], // Assuming username is the email
                'password' => '', // If not needed for customers, leave blank
                'name' => $validated['name'],
                'surname' => $validated['surname'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'street' => $validated['street'],
                'city' => $validated['city'],
                'zip_code' => $validated['zip_code'],
                'tarrif' => $validated['tarrif'],
                'agreed_terms' => $validated['agreed_terms'],
            ]);

            // Create the corresponding EasyPay record 
            $easyPayService = new EasyPayService();
            $easyPayService->save($customer);
            // dump($easyPayService);


            // Fire the Registered event
            event(new Registered($user));

            // Log in the newly created user
            Auth::login($user);
        });

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div class="flex flex-col justify-center items-center gap-5">
    <div class="flex flex-col justify-center items-center">
        <h1 class="text-3xl w-full  font-bold text-pluxnet-navy text-center ">Welcome to PluxNet</h1>
        <p class="text-gray-600 text-sm text-center">Register now to manage your fibre connection</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-md">
            <!-- First (old Name) -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Surname -->
            <div>
                <x-input-label for="surname" :value="__('Surname')" />
                <x-text-input wire:model="surname" id="surname" class="block mt-1 w-full" type="text" name="surname" required autofocus autocomplete="surname" />
                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" type='number' wire:model="phone" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" wire:model="street" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="street" :value="old('street')" required autocomplete="street" />
            <x-input-error :messages="$errors->get('street')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" wire:model="city" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="city" :value="old('city')" required autocomplete="city" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="zip_code" :value="__('Zip Code')" />
            <x-text-input id="zip_code" wire:model="zip_code" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="zip_code" :value="old('zip_code')" required autocomplete="zip_code" />
            <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
        </div>

        <!-- Service/Package/Tarrif -->
        <!-- <div>
            <x-input-label for="tarrif" :value="__('Tarrif')" />
            <x-text-input id="tarrif" wire:model="tarrif" class="w-full px-4 py-2 border rounded-md focus:ring-[#E0457B] focus:border-[#E0457B]" name="tarrif" :value="old('tarrif')" required autocomplete="tarrif" />
            <x-input-error :messages="$errors->get('tarrif')" class="mt-2" />
        </div> -->
         <div class="">
            <x-input-label for="tarrif" :value="__('Tarrif')" />
            <select required wire:model="tarrif" id="tarrif" name="tarrif"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  w-full ">
                <option value="">Choose a plan...</option>
                @foreach ($tariffs as $tariff => $price)
                    <option value="{{ $tariff }}">{{ $tariff }} - R{{ $price }} per month</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('tarrif')" class="mt-2" />
        </div>

        <div class="flex items-start space-x-3">
            <input type="checkbox" wire:model="agreed_terms" id="agreed_terms" name="agreed_terms" required class="h-4 w-4 rounded border-gray-300 text-[#E0457B] focus:ring-[#E0457B] cursor-pointer">
            <div class="flex flex-col">
                <label for="terms" class="text-sm text-gray-700 cursor-pointer">I accept the Terms and Conditions and Privacy Policy</label>
                <span class="text-xs text-gray-500 mt-1">
                    By checking this box, you agree to PluxNet's 
                    <a href="#" class="text-[#E0457B] hover:underline">Terms of Service</a> and 
                    <a href="#" class="text-[#E0457B] hover:underline">Privacy Policy</a>
                </span>
            </div>
        </div>


        <div class="flex items-center justify-end ">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
