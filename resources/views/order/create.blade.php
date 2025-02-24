<x-layout>
    <x-headerfooter.section-heading>Order Creation</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="post" action="{{ route('order_list.store') }}" id="orderForm">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="sales_order_id" value="{{ $sales_order_id }}">

            <div class="space-y-12 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Create New Order</h2>

                    <!-- Product Selection -->
                    <div class="mt-5" x-data="{ products: [] }">
                        <template x-for="(product, index) in products" :key="index">
                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6 mb-4">
                                <!-- Product ID -->
                                <div class="sm:col-span-2">
                                    <x-form.form-label>Product</x-form.form-label>
                                    <select x-bind:name="`products[${index}][product_id]`" x-model="product.id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Quantity -->
                                <x-form.form-feild>
                                    <x-form.form-label>Quantity</x-form.form-label>
                                    <x-form.form-input type="number" x-bind:name="`products[${index}][quantity]`"
                                        x-model="product.quantity" value="{{ old('quantity') }}" placeholder="Quantity" />
                                </x-form.form-feild>

                                <!-- Price -->
                                <x-form.form-feild>
                                    <x-form.form-label>Price</x-form.form-label>
                                    <x-form.form-input type="text" x-bind:name="`products[${index}][price]`"
                                        x-model="product.price" value="{{ old('price') }}" placeholder="Price" />
                                </x-form.form-feild>

                                <!-- Discount -->
                                <x-form.form-feild>
                                    <x-form.form-label>Discount</x-form.form-label>
                                    <x-form.form-input type="text" x-bind:name="`products[${index}][discount]`"
                                        x-model="product.discount" value="{{ old('discount') }}" placeholder="Discount" />
                                </x-form.form-feild>
                            </div>
                        </template>

                        <!-- Add Product Button -->
                        <button type="button" @click="products.push({ id: '', quantity: 1, price: '0.00', discount: '0.00' })"
                            class="mb-4 bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Add Product
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Buttons -->
            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900"
                    onclick="window.location='/customer'">Cancel</button>
                <x-form.form-button>Save Order</x-form.form-button>
            </div>
        </form>
    </x-form.form-panel>
</x-layout>