<x-layout>
    <x-headerfooter.section-heading>Update Product</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="POST" action="{{ route('product.update', $products->id) }}">
            @csrf
            @method('PATCH')
            <div class="space-y-12 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Edit Product</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Edit the product information below.</p>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                        <!-- Supplier Dropdown -->
                        <x-form.form-feild>
                            <x-form.form-label for="suppliers_id">Supplier</x-form.form-label>
                            <div class="mt-2">
                                <select name="suppliers_id" id="suppliers_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('suppliers_id', $products->suppliers_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->contact_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-form.form-error name="suppliers_id" />
                            </div>
                        </x-form.form-feild>

                        <!-- Category Dropdown -->
                        <x-form.form-feild>
                            <x-form.form-label for="category_id">Category</x-form.form-label>
                            <div class="mt-2">
                                <select name="category_id" id="category_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-form.form-error name="category_id" />
                            </div>
                        </x-form.form-feild>

                        <!-- Product Name -->
                        <x-form.form-feild>
                            <x-form.form-label for="product_name">Product name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="product_name" id="product_name"
                                    value="{{ old('product_name', $products->product_name) }}"
                                    placeholder="PRODUCT A" />
                                <x-form.form-error name="product_name" />
                            </div>
                        </x-form.form-feild>

                        <!-- Quantity Per Unit -->
                        <x-form.form-feild>
                            <x-form.form-label for="quantity">Quantity Per Unit</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="quantity" type="number" id="quantity"
                                    value="{{ old('quantity', $products->quantity) }}"
                                    placeholder="50" />
                                <x-form.form-error name="quantity" />
                            </div>
                        </x-form.form-feild>

                        <!-- Price -->
                        <x-form.form-feild>
                            <x-form.form-label for="price">Price</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="price" id="price"
                                    value="{{ old('price', $products->price) }}"
                                    placeholder="$17.92" />
                                <x-form.form-error name="price" />
                            </div>
                        </x-form.form-feild>

                        <!-- Units in Stock -->
                        <x-form.form-feild>
                            <x-form.form-label for="units_in_stock">Units In Stock</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="units_in_stock" type="number" id="units_in_stock"
                                    value="{{ old('units_in_stock', $products->units_in_stock) }}"
                                    placeholder="20" />
                                <x-form.form-error name="units_in_stock" />
                            </div>
                        </x-form.form-feild>

                        <!-- Units on Order -->
                        <x-form.form-feild>
                            <x-form.form-label for="units_on_order">Units On Order</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="units_on_order" type="number" id="units_on_order"
                                    value="{{ old('units_on_order', $products->units_on_order) }}"
                                    placeholder="20" />
                                <x-form.form-error name="units_on_order" />
                            </div>
                        </x-form.form-feild>

                        <!-- Reorder Level -->
                        <x-form.form-feild>
                            <x-form.form-label for="reorder_level">Reorder Level</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="reorder_level" type="number" id="reorder_level"
                                    value="{{ old('reorder_level', $products->reorder_level) }}"
                                    placeholder="20" />
                                <x-form.form-error name="reorder_level" />
                            </div>
                        </x-form.form-feild>

                        <!-- Discontinued -->
                        <x-form.form-feild>
                            <x-form.form-label for="discontinued">Discontinued</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="discontinued" type="number" id="discontinued"
                                    value="{{ old('discontinued', $products->discontinued) }}"
                                    placeholder="0 or 1"
                                    min="0"
                                    max="1" />
                                <x-form.form-error name="discontinued" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>

            <!-- Form Buttons -->
            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/product'">Cancel</button>
                <x-form.form-button>Save</x-form.form-button>
            </div>
        </form>
    </x-form.form-panel>
</x-layout>