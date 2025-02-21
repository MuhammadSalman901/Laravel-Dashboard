<x-layout>
    <x-flash.flash-card />

    <x-headerfooter.section-heading>Orders</x-headerfooter.section-heading>

    <x-form.form-search name="order_list.search" placeholder="5" />

    <div class="mt-10">
        <x-table.table>
            <x-slot name="headers">
                <th class="p-3 bg-emerald-800 text-white text-left">Order Detail ID</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Unit Price</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Quantity</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Discount</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Actions</th>
            </x-slot>

            @foreach ($orders as $order)
            <x-table.table-row>
                <x-table.table-row-data>{{ $order['id'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $order['price'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $order['quantity'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $order['discount'] }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$order" type="order" name_1="order_list.show" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$orders" />
    </div>
</x-layout>