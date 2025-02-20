@props(['size' => 'base'])

@php
$classes = "mb-2 bg-black/5 hover:bg-white/25 border border-black/25 hover:border-blue-800 rounded-xl font-bold transition-colors duration-300";

if ($size === 'base') {
$classes .= " px-5 py-1 text-sm";
}

if ($size === 'small') {
$classes .= " px-3 py-1 text-2xs";
}
@endphp

<p class="{{ $classes }}">{{ $slot }}</p>