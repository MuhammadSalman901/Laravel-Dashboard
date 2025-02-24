<x-layout>
    <x-headerfooter.section-heading>Update Shipper</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="POST" action="{{ route('shipper.update', $shippers->id) }}">
            @csrf
            @method('PATCH')
            <div class="space-y-12 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Edit Customer</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Update the customer information below.</p>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                        <x-form.form-feild>
                            <x-form.form-label for="company_name">Company Name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="company_name" id="company_name"
                                    value="{{ old('company_name', $shippers->company_name) }}"
                                    placeholder="COMPANY A" />
                                <x-form.form-error name="company_name" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="phone">Phone</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="phone" id="phone"
                                    value="{{ old('phone', $shippers->phone) }}"
                                    placeholder="+(32) 929-191" />
                                <x-form.form-error name="phone" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>

            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/shipper'">Cancel</button>
                <x-form.form-button>Update Shipper</x-form.form-button>
            </div>
        </form>
    </x-form.form-panel>
</x-layout>