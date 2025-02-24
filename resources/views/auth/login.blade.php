<x-layout>
    <x-headerfooter.section-heading>Log in</x-headerfooter.section-heading>

    <div class="ml-64 mb-16 border border-black rounded-xl w-[50vh] mt-10 flex justify-center hover:border-blue-800 transition-colors duration-300">
        <form method="post" action="/login">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.form-feild>
                            <x-form.form-label for="email">Email</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="email" id="email" type="email" placeholder="JaneDoe@xyz.com" :value="old('email')" />

                                <x-form.form-error name="email" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="password">Password</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="password" id="password" type="password" placeholder="Password:" />

                                <x-form.form-error name="password" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>
            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/'">Cancel</button>
                <x-form.form-button>Login</x-form.form-button>
            </div>
        </form>
    </div>
</x-layout>