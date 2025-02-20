<x-layout>
    <x-headerfooter.section-heading>Shipper Form</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="post" action="{{ route('shipper.store') }}">
            @csrf

            <input type="hidden" name="user_id" value="{{ $userId }}">

            <div class="space-y-12 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Create a New Shipper</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">The below information will be used in creation of shipper.</p>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                        <x-form.form-feild>
                            <x-form.form-label for="company_name">Company name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="company_name" id="company_name" value="{{ old('company_name') }}" placeholder="COMPANY A" />

                                <x-form.form-error name="company_name" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="phone">Phone</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="phone" id="phone" value="{{ old('phone') }}" placeholder="+(32) 929-191" />

                                <x-form.form-error name="phone" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>

            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/shipper'">Cancel</button>
                <x-form.form-button>Save</x-form.form-button>
            </div>
        </form>
        </div>
    </x-form.form-panel>
</x-layout>