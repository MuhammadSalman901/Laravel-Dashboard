<x-layout>
    <x-headerfooter.section-heading>User Information</x-headerfooter.section-heading>

    <div class="mt-10 flex justify-center">
        <x-card.card>
            <x-slot name="header1">Name: {{ $user['name'] }}</x-slot>
            <x-slot name="header2"></x-slot>
            <x-slot name="body1">Title: {{ $user['title'] }}</x-slot>
            <x-slot name="body2">Email: {{ $user['email'] }}</x-slot>
            <x-slot name="body3">Phone: {{ $user['phone'] }}</x-slot>
            <x-slot name="body4">Address: {{ $user['address'] }}</x-slot>
            <x-slot name="body5"></x-slot>
            <x-slot name="body6"></x-slot>
            <x-slot name="body7"></x-slot>
        </x-card.card>
    </div>
</x-layout>