@props(['module'])

<div class="pagination-info text-sm text-gray-600">
    Page {{ $module->currentPage() }} of {{ $module->lastPage() }}

    {{ $module->links('pagination::tailwind') }}
</div>