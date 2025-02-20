@props(['name'])

@error($name)
    <p class="text-xs text-red-600 font-semibold py-2">{{ $message }}</p>
@enderror