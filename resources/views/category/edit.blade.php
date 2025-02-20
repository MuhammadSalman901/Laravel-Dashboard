<x-layout>
    <x-headerfooter.section-heading>Update Category</x-headerfooter.section-heading>

    <x-form.form-panel>
        <form method="POST" action="{{ route('category.update', $categories->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="space-y-12 px-10 mt-3">
                <div class="border-b border-gray-900/90 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Edit Catrgory</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Update the category information below.</p>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                        <x-form.form-feild>
                            <x-form.form-label for="category_name">Category Name</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="category_name" id="category_name"
                                    value="{{ old('category_name', $categories->category_name) }}"
                                    placeholder="FOOD" />
                                <x-form.form-error name="category_name" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="description">Description</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input name="description" id="description"
                                    value="{{ old('description', $categories->description) }}"
                                    placeholder="Meat/Vegetables" />
                                <x-form.form-error name="description" />
                            </div>
                        </x-form.form-feild>

                        <x-form.form-feild>
                            <x-form.form-label for="image_path">Image</x-form.form-label>
                            <div class="mt-2">
                                <x-form.form-input
                                    type="file"
                                    name="image_path"
                                    id="image_path"
                                    class="mt-1" />
                                <x-form.form-error name="image_path" />
                            </div>
                        </x-form.form-feild>
                    </div>
                </div>
            </div>

            <div class="mt-6 px-6 flex items-center justify-end gap-x-6">
                <button type="button" class="mb-3 border border-hidden hover:bg-red-500 rounded-lg py-1 px-1 text-sm/6 font-semibold text-gray-900" onclick="window.location='/category'">Cancel</button>
                <x-form.form-button>Update Category</x-form.form-button>
            </div>
        </form>
    </x-form.form-panel>
</x-layout>