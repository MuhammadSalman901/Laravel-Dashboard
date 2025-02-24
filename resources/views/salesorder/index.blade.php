<x-layout>

    <div class="px-5">
        <x-headerfooter.section-heading>Sales Orders</x-headerfooter.section-heading>
    </div>

    <x-form.form-search name="sales_order.search" reset="sales_order.index" placeholder="Ship A" />

    @isset($resultInfo)
    <x-headerfooter.results-info :resultInfo="$resultInfo" />
    @endisset

    <div class="mt-10">
        <x-table.table>
            <x-slot name="headers">
                <th class="p-3 bg-emerald-800 text-white text-left">Ship Name</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Ship Address</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Ship City</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Ship Country</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Actions</th>
            </x-slot>

            @foreach ($salesorders as $salesorder)
            <x-table.table-row>
                <x-table.table-row-data>{{ $salesorder['ship_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $salesorder['ship_address'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $salesorder['ship_city'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $salesorder['ship_country'] }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$salesorder" type="salesorder" name_1="sales_order.show" name_3="sales_order.delete" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach

            @if ($noRecordsFound)
            <x-table.record message="Sales Order Not Found!!!" />
            @endif
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$salesorders" />
    </div>
</x-layout>