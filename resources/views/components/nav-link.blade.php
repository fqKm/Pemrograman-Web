@props(['active'])

@php
$classes = $active
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent 
               text-sm font-medium text-indigo-600 
               focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent 
               text-sm font-medium text-gray-500 dark:text-gray-400 
               hover:text-indigo-600 dark:hover:text-indigo-400 
               hover:border-indigo-600 dark:hover:border-indigo-400 
               hover:decoration-2 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
