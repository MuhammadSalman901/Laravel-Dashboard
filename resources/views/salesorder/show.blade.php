<x-layout>
    <x-headerfooter.section-heading>Sales Order Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card>
            <x-slot name="header1">Ship Name: {{ $salesorders->ship_name ?? 'N/A' }}</x-slot>
            <x-slot name="header2">Ship Address: {{ $salesorders->ship_address ?? 'N/A' }}</x-slot>
            <x-slot name="body1">Ship Country: {{ $salesorders->ship_country ?? 'N/A' }}</x-slot>
            <x-slot name="body2">Ship City: {{ $salesorders->ship_city ?? 'N/A' }}</x-slot>
            <x-slot name="body3"></x-slot>
            <x-slot name="body4"></x-slot>
            <x-slot name="body5"></x-slot>
            <x-slot name="body6"></x-slot>
            <x-slot name="body7"></x-slot>
        </x-card.card>
    </div>
</x-layout>