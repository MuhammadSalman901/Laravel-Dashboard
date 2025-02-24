<x-card.panel {{ $attributes }} class="flex flex-col w-[42vh] h-[20vh] text-center">
    <div class = "text-center py-1 text-sm">{{ $header1 }}</div>
    <div class = "text-center text-sm">{{ $header2 }}</div>

    <div class="py-1">
        <h3 class = "group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">{{ $body1 }}</h3>
        <p class = "text-sm">{{ $body2 }}</p>
    </div>

    <div class="py-1">
        <p class = "text-sm">{{ $body3 }}</p>
        <p class = "text-sm">{{ $body4 }}</p>
        <p class = "text-sm">{{ $body5 }}</p>
        <p class = "text-sm">{{ $body6 }}</p>
        <p class = "text-sm">{{ $body7 }}</p>
    </div>

    </div>
</x-card.panel>