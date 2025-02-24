<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gnome</title>
    <link rel="icon" type="image/png" href="{{ asset('WarehouseDashboard/public/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-hanken-grotesk overflow-hidden">
    <x-headerfooter.header />

    <div class="flex h-screen pb-8">
        <!-- Sidebar -->
        @auth
        <x-sidebar.sidebar>
            <x-sidebar.sidebar-link href="/">Dashboard</x-sidebar.sidebar-link>
            <x-sidebar.sidebar-link href="/user">User</x-sidebar.sidebar-link>
            <x-sidebar.sidebar-link href="/customer">Customer</x-sidebar.sidebar-link>
            <x-sidebar.sidebar-link href="/shipper">Shipper</x-sidebar.sidebar-link>
            <x-sidebar.sidebar-link href="/supplier">Supplier</x-sidebar.sidebar-link>
            <x-sidebar.sidebar-link href="/category">Category</x-sidebar.sidebar-link>
            <x-sidebar.sidebar-link href="/product">Product</x-sidebar.sidebar-link>
            <x-sidebar.sidebar-link href="/sales_order">Sales Order</x-sidebar.sidebar-link>
        </x-sidebar.sidebar>
        @endauth

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-[url(/resources/images/bg_6.jpg)] bg-cover bg-center pb-10">
            <div class="max-w-[986px] mx-auto px-4 py-10">
                {{ $slot }}
            </div>
        </main>
    </div>

    <x-headerfooter.footer />
</body>

</html>