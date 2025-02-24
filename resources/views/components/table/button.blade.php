@props(['item', 'type', 'name_1', 'name_2' => null, 'name_3' => null])

<button
    data-ripple-light="true"
    data-popover-target="menu-{{ $type }}-{{ $item->id }}"
    class="rounded-md py-2 px-4 text-center text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200 disabled:pointer-events-none disabled:opacity-50 ml-2"
    type="button">
    <img src="{{ Vite::asset('resources/images/menu.png') }}" />
</button>

<ul
    role="menu"
    data-popover="menu-{{ $type }}-{{ $item->id }}"
    data-popover-placement="bottom"
    class="hidden absolute z-10 min-w-[50px] overflow-auto rounded-lg border border-slate-200 bg-white p-1.5 shadow-lg shadow-sm focus:outline-none">

    <x-card.list_item :route="route($name_1, $item->id)">
        View
    </x-card.list_item>

    @if($name_2)
    <x-card.list_item :route="route($name_2, $item->id)">
        Edit
    </x-card.list_item>
    @endif

    @if($name_3)
    <li role="menuitem" class="cursor-pointer text-slate-800 text-sm flex w-full items-center justify-left rounded-md p-1 hover:bg-slate-300 focus:bg-slate-100 active:bg-slate-100">
        <x-delete.delete :item="$item" :route="$name_3" message="Do you want to delete this record?" />
    </li>
    @endif
</ul>

<script>
    document.querySelectorAll('[data-popover-target]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const targetId = this.getAttribute('data-popover-target');
            const menu = document.querySelector(`[data-popover="${targetId}"]`);

            // Close all other menus first
            document.querySelectorAll('[data-popover]').forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });

            // Position the menu correctly
            menu.classList.remove('hidden');

            // Get button's position relative to the viewport
            const buttonRect = this.getBoundingClientRect();

            // Calculate appropriate position
            const menuLeft = buttonRect.left;
            const menuTop = buttonRect.bottom;

            // Set the popover position
            menu.style.position = 'fixed';
            menu.style.top = `${menuTop}px`;
            menu.style.left = `${menuLeft}px`;
            menu.style.maxHeight = '300px'; // Adjust as needed
            menu.style.overflowY = 'auto';
        });
    });

    // Close all popovers when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[data-popover-target]')) {
            document.querySelectorAll('[data-popover]').forEach(menu => {
                menu.classList.add('hidden');
            });
        }
    });
</script>

<style>
    [data-popover] {
        position: fixed;
        z-index: 50;
        min-width: 50px;
        overflow: auto;
        border-radius: 0.5rem;
        border: 1px solid #e2e8f0;
        background-color: white;
        padding: 0.375rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        max-height: 300px;
    }
</style>