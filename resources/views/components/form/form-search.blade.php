<div>
    <form action="{{ route($name) }}" method="GET" class="mt-6 flex justify-center">
        <input name="search" {{ $attributes->merge([
            'class' => "rounded-xl bg-white/25 border border-black/30 px-5 py-4 w-full max-w-xl hover:border-blue-800 focus:outline-blue-800 transition-colors duration-300",
            'placeholder' => $placeholder,
            'type' => "text",
            'id' => "search"
        ]) }}>
        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Search</button>
    </form>
</div>