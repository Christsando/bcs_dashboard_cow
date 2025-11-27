@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center pt-1 border-r-2 border-activeblue text-sm font-medium leading-5 text-activeblue focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center pt-1 border-r-2 border-transparent text-sm font-medium leading-5 text-inactiveblue hover:text-activeblue focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
