@props(['reset', 'name', 'placeholder'])
<div>
    <form action="{{ route($name) }}" method="GET" class="mt-6 flex justify-self">
        <input name="search" {{ $attributes->merge([
      'class' => "rounded-xl bg-white/25 border border-black/30 px-5 py-4 w-[20vw] h-[4vh] max-w-xl hover:border-blue-800 focus:outline-blue-800 transition-colors duration-300",
      'placeholder' => $placeholder,
      'type' => "text",
      'id' => "search"
    ]) }}>
        <button type="submit" class="ml-2 p-2 h-10 bg-blue-500 text-white rounded-lg">Search</button>
        <a id="reset" type="reset" class="ml-2 px-2 py-2 h-10 bg-green-500 text-white rounded-lg" href="{{ route($reset) }}">Reset</a>
    </form>
</div>