<div {{ $attributes->merge([
    'class' => "ml-64 mb-16 border border-black rounded-xl w-[50vh] mt-10 flex justify-center hover:border-blue-800 transition-colors duration-300 bg-black/10"
]) }}>{{ $slot }}</div>