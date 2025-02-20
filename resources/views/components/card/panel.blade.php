<div {{ $attributes
        ->merge([
        "class" => "p-4 rounded-xl border border-black bg-black/10 hover:border-blue-800 transition-colors duration-300 group"
        ]) }}>
    {{ $slot }}
</div>