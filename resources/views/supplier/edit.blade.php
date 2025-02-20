<x-layout>
    <x-headerfooter.section-heading>Update Shipper</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="POST" action="{{ route('supplier.update', $suppliers->id) }}">
            @csrf
            @method('PATCH')
            <div class="space-y-12 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Edit Supplier</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Update the supplier information below.</p>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                        <x-form.form-feild>
                            <x-form.form-label for="contact_name">Contact Name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="contact_name" id="contact_name"
                                    value="{{ old('contact_name', $suppliers->contact_name) }}"
                                    placeholder="SUPPLIER A" />
                                <x-form.form-error name="contact_name" />
                            </div>
                        </x-form.form-feild>
                        
                        <x-form.form-feild>
                            <x-form.form-label for="company_name">Company Name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="company_name" id="company_name"
                                    value="{{ old('company_name', $suppliers->company_name) }}"
                                    placeholder="COMPANY A" />
                                <x-form.form-error name="company_name" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="contact_title">Contact_title</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="contact_title" id="contact_title"
                                    value="{{ old('contact_title', $suppliers->contact_title) }}"
                                    placeholder="CT A" />
                                <x-form.form-error name="contact_title" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="email">Email</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="email" type="email" id="email"
                                    value="{{ old('email', $suppliers->email) }}"
                                    placeholder="cta.spa@example.com" />
                                <x-form.form-error name="email" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="phone">Phone</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="phone" id="phone"
                                    value="{{ old('phone', $suppliers->phone) }}"
                                    placeholder="+(32) 929-191" />
                                <x-form.form-error name="phone" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="address">Address</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="address" id="address"
                                    value="{{ old('address', $suppliers->address) }}"
                                    placeholder="Abx-123, Ab, Abx" />
                                <x-form.form-error name="address" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>

            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/supplier'">Cancel</button>
                <x-form.form-button>Update Supplier</x-form.form-button>
            </div>
        </form>
    </x-form.form-panel>
</x-layout>