<x-app-layout>
    <div class="flex justify-center items-center w-full flex-col max-w-5xl gap-8 py-6 px-3">
        <livewire:dashboard.greeting-card />

        <!-- <div class="w-full gap-5 grid grid-cols-1 md:grid-cols-2"> -->
        <div class=" gap-5 flex flex-wrap justify-center items-start">
            <livewire:dashboard.customer-details-card /> 

            <livewire:dashboard.easypay-details-card /> 
        </div>
    </div>
</x-app-layout>
