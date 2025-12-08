<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        
        <div class="mb-6 flex flex-col items-center">
            <a href="/" class="flex items-center gap-2 mb-2">
                <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </a>
            <span class="text-2xl font-extrabold text-gray-900 tracking-tight">FitHub Gym</span>
        </div>

        <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-gray-100">
            {{ $slot }}
        </div>
        
        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} FitHub Gym. All rights reserved.
        </div>
    </div>
</body>