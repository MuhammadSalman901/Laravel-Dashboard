<x-layout>
    <x-headerfooter.section-heading>Order Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card>
            <x-slot name="header1">Product Name: {{ $orders->product->product_name ?? 'N/A' }}</x-slot>
            <x-slot name="header2">Quantity: {{ $orders->quantity }}</x-slot>
            <x-slot name="body1">Unit Price: {{ $orders->price }}</x-slot>
            <x-slot name="body2">User: {{ $orders->salesOrder->user->name ?? 'N/A' }}</x-slot>
            <x-slot name="body3">Customer: {{ $orders->salesOrder->customer->contact_name ?? 'N/A' }}</x-slot>
            <x-slot name="body4">Shipper: {{ $orders->salesOrder->shipper->company_name ?? 'N/A' }}</x-slot>
            <x-slot name="body5"></x-slot>
            <x-slot name="body6"></x-slot>
            <x-slot name="body7"></x-slot>
        </x-card.card>
    </div>
</x-layout>