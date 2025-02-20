<x-card.panel class="flex gap-x-6">
    <div>
        {{ $image }}
    </div>

    <div class="flex-1 flex flex-col">
        <div class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">{{ $header1 }}</div>

        <p class="text-sm pt-5">{{ $body1 }}</p>
        <p class="text-sm">{{ $body2 }}</p>
    </div>
</x-card.panel>