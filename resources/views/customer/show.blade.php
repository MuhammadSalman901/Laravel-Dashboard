<x-layout>
    <x-headerfooter.section-heading>Customer Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card>
            <x-slot name="header1">Contact Name: {{ $customers['contact_name'] }}</x-slot>
            <x-slot name="header2">Company Name: {{ $customers['company_name'] }}</x-slot>
            <x-slot name="body1">Contact Title: {{ $customers['contact_title'] }}</x-slot>
            <x-slot name="body2">Email: {{ $customers['email'] }}</x-slot>
            <x-slot name="body3">Phone: {{ $customers['phone'] }}</x-slot>
            <x-slot name="body4">Address: {{ $customers['address'] }}</x-slot>
            <x-slot name="body5"></x-slot>
            <x-slot name="body6"></x-slot>
            <x-slot name="body7"></x-slot>
        </x-card.card>
    </div>
</x-layout>