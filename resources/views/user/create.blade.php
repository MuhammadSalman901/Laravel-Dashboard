<x-layout>
    <x-headerfooter.section-heading>User Form</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12 px-5 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Create a New User</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">The below information will be used in creation of user.</p>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                        <x-form.form-feild>
                            <x-form.form-label for="name">Name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="name" id="name" placeholder="Jane Doe" value="{{ old('name') }}" />

                                <x-form.form-error name="name" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="title">Title</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="title" id="title" placeholder="Super Admin" value="{{ old('title') }}" />

                                <x-form.form-error name="title" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="email">Email</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="email" type="email" id="email" placeholder="jane.doe@example.com" value="{{ old('email') }}" />

                                <x-form.form-error name="email" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="password">Password</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="password" type="password" id="password" />

                                <x-form.form-error name="password" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="phone">Phone</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="phone" id="phone" placeholder="+(32) 929-191" value="{{ old('phone') }}" />

                                <x-form.form-error name="phone" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="address">Address</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="address" id="address" placeholder="Abx-123, Ab, Abx" value="{{ old('address') }}" />

                                <x-form.form-error name="address" />
                            </div>
                        </x-form.form-feild>

                        <x-form.skill-input-field name="skills_input" />
                        
                        <x-form.form-feild>
                            <x-form.form-label for="experience">Experience</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input type="number" name="experience" placeholder="10" value="{{ old('experience') }}" />

                                <x-form.form-error name="experience" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="bio">Bio</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input type="text" name="bio" placeholder="Tell us a little about yourself" value="{{ old('bio') }}" />

                                <x-form.form-error name="bio" />
                            </div>
                        </x-form.form-feild>


                        <x-form.form-feild>
                            <x-form.form-label for="image_path">Image</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input type="file" name="image_path" id="image_path" class="mt-1" />

                                <x-form.form-error name="image_path" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>

            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/user'">Cancel</button>
                <x-form.form-button>Save</x-form.form-button>
            </div>
        </form>
        </div>
    </x-form.form-panel>
</x-layout>