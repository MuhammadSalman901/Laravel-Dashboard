<x-layout>
    <x-flash.flash-card />

    <x-headerfooter.section-header name="user.create" heading="Users" />

    <x-form.form-search name="user.search" reset="user.index" placeholder="Jane Doe" />

    <div class="mt-10">
        <x-table.table>
            <x-slot name="headers">
                <th class="p-3 bg-emerald-800 text-white text-left">Name</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Title</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Email</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Phone</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Address</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Actions</th>
            </x-slot>

            @foreach ($users as $user)
            <x-table.table-row>
                <x-table.table-row-data>{{ $user['name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $user['title'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $user['email'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $user['phone'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $user['address'] }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$user" type="user" name_1="user.show" name_2="user.edit" name_3="user.delete" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$users" />
    </div>
</x-layout>