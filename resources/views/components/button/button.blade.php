<button {{$attributes->merge([
    'class' => "px-3 h-8 text-white font-sm bg-green-500 rounded-xl border border-transparent hover:border-green-800 hover:bg-green-800 transition-colors duration-300"
])}}>{{ $slot }}</button>