<x-layout>
    <x-headerfooter.section-heading>Sales Order Form</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="post" action="{{ route('sales_order.store') }}">
            @csrf
            <div class="space-y-12 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Create a New Sales Order</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">The below information will be used in creation of sales order.</p>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                        <x-form.form-feild>
                            <x-form.form-label for="user_id">Users</x-form.form-label>
                            <div class="mt-2">
                                <select name="user_id" id="user_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-form.form-error name="user_id" />
                            </div>
                        </x-form.form-feild>
                        
                        <x-form.form-feild>
                            <x-form.form-label for="customers_id">Customer</x-form.form-label>
                            <div class="mt-2">
                                <select name="customers_id" id="customers_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->contact_name }}</option>
                                    @endforeach
                                </select>
                                <x-form.form-error name="customer_id" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="shippers_id">Shippers</x-form.form-label>
                            <div class="mt-2">
                                <select name="shippers_id" id="shippers_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @foreach($shippers as $shipper)
                                    <option value="{{ $shipper->id }}">{{ $shipper->company_name }}</option>
                                    @endforeach
                                </select>
                                <x-form.form-error name="shippers_id" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="ship_name">Ship name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="ship_name" id="ship_name" value="{{ old('ship_name') }}" placeholder="SHIP A" />

                                <x-form.form-error name="ship_name" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="ship_address">Ship address</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="ship_address" id="ship_address" value="{{ old('ship_address') }}" placeholder="Abx 123, Ab, x" />

                                <x-form.form-error name="ship_address" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="ship_city">Ship city</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="ship_city" id="ship_city" value="{{ old('ship_city') }}" placeholder="Lagos" />

                                <x-form.form-error name="ship_city" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="ship_country">Ship country</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="ship_country" id="ship_country" value="{{ old('ship_country') }}" placeholder="Nigeria" />

                                <x-form.form-error name="ship_country" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="order_date">Order date</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="order_date" value="{{ old('order_date') }}" type="date" id="order_date" />

                                <x-form.form-error name="order_date" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="required_date">Required date</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="required_date" value="{{ old('required_date') }}" type="date" id="required_date" />

                                <x-form.form-error name="required_date" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="shipped_date">Shipped date</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="shipped_date" value="{{ old('shipped_date') }}" type="date" id="shipped_date" />

                                <x-form.form-error name="shipped_date" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>

            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/sales_order'">Cancel</button>
                <x-form.form-button>Save</x-form.form-button>
            </div>
        </form>
        </div>
    </x-form.form-panel>
</x-layout>