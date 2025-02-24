<x-layout>
    <x-headerfooter.section-heading>Supplier Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card>
            <x-slot name="header1">Contact Name: {{ $suppliers['contact_name'] }}</x-slot>
            <x-slot name="header2">Company Name: {{ $suppliers['company_name'] }}</x-slot>
            <x-slot name="body1">Contact Title: {{ $suppliers['contact_title'] }}</x-slot>
            <x-slot name="body2">Email: {{ $suppliers['email'] }}</x-slot>
            <x-slot name="body3">Phone: {{ $suppliers['phone'] }}</x-slot>
            <x-slot name="body4">Address: {{ $suppliers['address'] }}</x-slot>
            <x-slot name="body5"></x-slot>
            <x-slot name="body6"></x-slot>
            <x-slot name="body7"></x-slot>
        </x-card.card>
    </div>
</x-layout>