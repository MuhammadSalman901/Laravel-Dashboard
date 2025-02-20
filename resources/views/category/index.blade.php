<x-layout>
    <x-headerfooter.section-header name="category.create" heading="Categories" />

    <x-form.form-search name="category.search" placeholder="Food" />

    <div class="mt-10">
        <x-table.table>
            <x-slot name="headers">
                <th class="p-3 bg-emerald-800 text-white text-left">Category Name</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Description</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Product Amount</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Actions</th>
            </x-slot>

            @foreach ($categories as $category)
            <x-table.table-row>
                <x-table.table-row-data>{{ $category['category_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $category['description'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $category->product->count() }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$category" type="category" name_1="category.show" name_2="category.edit" name_3="category.delete" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$categories" />
    </div>
</x-layout>