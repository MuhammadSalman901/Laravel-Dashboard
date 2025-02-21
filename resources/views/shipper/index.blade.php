<x-layout>
    <x-flash.flash-card />

    <x-headerfooter.section-header name="shipper.create" heading="Shippers" />

    <x-form.form-search name="shipper.search" reset="shipper.index" placeholder="Company A" />

    <div class="mt-10">
        <x-table.table>
            <x-slot name="headers">
                <th class="p-3 bg-emerald-800 text-white text-left">Company Name</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Phone</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Actions</th>
            </x-slot>

            @foreach ($shippers as $shipper)
            <x-table.table-row>
                <x-table.table-row-data>{{ $shipper['company_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $shipper['phone'] }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$shipper" type="shipper" name_1="shipper.show" name_2="shipper.edit" name_3="shipper.delete" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach

            @if ($noRecordsFound)
            <x-table.record message="Shipper Not Found!!!" />
            @endif
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$shippers" />
    </div>
</x-layout>