<x-layout>
    <x-flash.flash-card />

    <x-headerfooter.section-header name="product.create" heading="Products" />

    <x-form.form-search name="product.search" reset="product.index" placeholder="Product B" />

    <div class="mt-10">
        <x-table.table>
            <x-slot name="headers">
                <th class="p-3 bg-emerald-800 text-white text-left">Product Name</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Quantity Per Unit</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Unit Price</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Units In Stock</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Units In Order</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Reorder Level</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Discontinued</th>
                <th class="p-3 bg-emerald-800 text-white text-left">Actions</th>
            </x-slot>

            @foreach ($products as $product)
            <x-table.table-row>
                <x-table.table-row-data>{{ $product['product_name'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $product['quantity'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $product['price'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $product['units_in_stock'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $product['units_on_order'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $product['reorder_level'] }}</x-table.table-row-data>
                <x-table.table-row-data>{{ $product['discontinued'] }}</x-table.table-row-data>
                <x-table.table-row-data>
                    <x-table.button :item="$product" type="product" name_1="product.show" name_2="product.edit" name_3="product.delete" />
                </x-table.table-row-data>
            </x-table.table-row>
            @endforeach

            @if ($noRecordsFound)
            <x-table.record message="Product Not Found!!!" />
            @endif
        </x-table.table>
    </div>

    <div class="mt-10">
        <x-navigation.paginator :module="$products" />
    </div>
</x-layout>