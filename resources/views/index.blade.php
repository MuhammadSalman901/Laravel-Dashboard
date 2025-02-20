<x-layout>
    @guest
    <x-headerfooter.section-heading>Welcome to Gnome</x-headerfooter.section-heading>
    @endguest
    @auth
    <x-headerfooter.section-heading>Welcome {{ Auth::user()->name }}</x-headerfooter.section-heading>
    @endauth
</x-layout>