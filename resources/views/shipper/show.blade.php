<x-layout>
    <x-headerfooter.section-heading>Shipper Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card>
            <x-slot name="header1"></x-slot>
            <x-slot name="header2"></x-slot>
            <x-slot name="body1">Company Name: {{ $shippers['company_name'] }}</x-slot>
            <x-slot name="body2"></x-slot>
            <x-slot name="body3">Phone: {{ $shippers['phone'] }}</x-slot>
            <x-slot name="body4"></x-slot>
            <x-slot name="body5"></x-slot>
            <x-slot name="body6"></x-slot>
            <x-slot name="body7"></x-slot>
        </x-card.card>
    </div>
</x-layout>