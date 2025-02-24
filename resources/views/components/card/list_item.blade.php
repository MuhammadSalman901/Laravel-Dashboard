@props(['route'])

<li
    role="menuitem"
    class="cursor-pointer text-slate-800 text-sm flex w-full items-center justify-left rounded-md p-1 hover:bg-slate-300 focus:bg-slate-100 active:bg-slate-100">
    <a href="{{ $route }}">
        {{ $slot }}
    </a>
</li>