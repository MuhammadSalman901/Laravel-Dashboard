<x-layout>
    <x-flash.flash-card />
    
    <x-headerfooter.section-header name="supplier.create" heading="Suppliers" />

    <x-form.form-search name="supplier.search" placeholder="Supplier A" />

    <div class="mt-10">
        <x-table.table>
            <x-slot name="headers">
                <th class="p-3 bg-emerald-800 text-white text-left">Contact Name</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Company Name</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Contact Title</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Email</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Phone</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Address</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Actions</th>
            </x-slot>

            @foreach ($suppliers as $supplier)
            <x-table.table-row>
                <x-table.table-row-data>{{ $supplier['contact_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $supplier['company_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $supplier['contact_title'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $supplier['email'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $supplier['phone'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $supplier['address'] }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$supplier" type="supplier" name_1="supplier.show" name_2="supplier.edit" name_3="supplier.delete" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$suppliers" />
    </div>
</x-layout>