@props(['item', 'route', 'message' => 'Do you want to delete this item?'])

<div x-data="{ open: false }" class="inline-block">
    <!-- Trigger Button -->
    <button
        @click="open = true; $event.stopPropagation()"
        type="button">
        Delete
    </button>

    <!-- Dialog -->
    <div x-show="open" @click.away="open = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full">
            <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
            <p class="mb-6">{{ $message }}</p>
            <div class="flex justify-end space-x-4">
                <button @click="open = false" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Cancel</button>
                <form method="POST" action="{{ route($route, $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>