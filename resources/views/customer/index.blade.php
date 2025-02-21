<x-layout>
    <x-flash.flash-card />

    <x-headerfooter.section-header name="customer.create" heading="Customers" />

    <x-form.form-search name="customer.search" reset="customer.index" placeholder="Sonny Ferry" />

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

            @foreach ($customers as $customer)
            <x-table.table-row>
                <x-table.table-row-data>{{ $customer['contact_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $customer['company_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $customer['contact_title'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $customer['email'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $customer['phone'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $customer['address'] }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$customer" type="customer" name_1="customer.show" name_2="customer.edit" name_3="customer.delete" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach

            @if ($noRecordsFound)
            <x-table.record message="Customer Not Found!!!" />
            @endif
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$customers" />
    </div>
</x-layout>