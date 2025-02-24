<a {{ $attributes->merge([
    "class" => "block text-center py-4 mt-7 hover:bg-gray-700 hover:pl-3 transition-all duration-300"
]) }}>
    {{ $slot }}
</a>