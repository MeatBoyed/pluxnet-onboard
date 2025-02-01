<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->
    <livewire:dashboard.greeting-card />

    <div class="py-12 w-full grid grid-cols-1 md:grid-cols-2">
        <livewire:dashboard.customer-details-card /> 
        <livewire:dashboard.easypay-details-card /> 
    </div>
</x-app-layout>
