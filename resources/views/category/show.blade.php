<x-layout>
    <x-headerfooter.section-heading>Supplier Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card-wide>
            <x-slot name="image"><img src="{{ asset('storage/' . $categories['image_path']) }}" class="w-24 h-24 object-cover object-center"></x-slot>
            <x-slot name="header1">Category Name: {{ $categories['category_name'] }}</x-slot>
            <x-slot name="body1">Description: {{ $categories['description'] }}</x-slot>
            <x-slot name="body2">Product Amount: {{ $categories->product->count() }}</x-slot>
        </x-card.card-wide>
    </div>
</x-layout>