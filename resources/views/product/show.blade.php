<x-layout>
    <x-headerfooter.section-heading>Product Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card class="h-[25vh]">
            <x-slot name="header1">Product Name: {{ $products['product_name'] }}</x-slot>
            <x-slot name="header2">Quantity: {{ $products['quantity'] }}</x-slot>
            <x-slot name="body1">Price: {{ $products['price'] }}</x-slot>
            <x-slot name="body2">Units In Stock:{{ $products['units_in_stock'] }}</x-slot>
            <x-slot name="body3">Units On Order:{{ $products['units_on_order'] }}</x-slot>
            <x-slot name="body4">Reorder Level: {{ $products['reorder_level'] }}</x-slot>
            <x-slot name="body5">Discontinued: {{ $products['discontinued'] }}</x-slot>
            <x-slot name="body6">Category: {{ $products->category->category_name }}</x-slot>
            <x-slot name="body7">Supplier: {{ $products->supplier->contact_name }}</x-slot>
        </x-card.card>
    </div>
</x-layout>