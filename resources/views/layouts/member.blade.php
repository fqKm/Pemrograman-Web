<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FitHub Gym') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-900 bg-white">

    {{-- NAVBAR --}}
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            {{-- LOGO --}}
            <div class="flex items-center gap-2">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span class="font-bold text-xl tracking-tight text-gray-900">FitHub Gym</span>
            </div>

            {{-- DESKTOP NAV --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('member.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('members.membership.index') }}" class="nav-link">Membership</a>
                <a href="{{ route('kelas.index') }}" class="nav-link">Kelas</a>
            </div>

            {{-- PROFILE DROPDOWN --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-3 cursor-pointer focus:outline-none">
                    <span class="font-medium text-gray-900">{{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </button>

                {{-- MENU --}}
                <div x-show="open" @click.outside="open = false"
                     x-transition
                     class="absolute right-0 mt-3 w-48 bg-white shadow-lg rounded-lg py-2 border border-gray-100">
                    <a href="{{ route('members.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="pt-16"> {{-- Sesuaikan dengan tinggi navbar + spacing --}}
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-bold tracking-tight mb-4 block">FitHub Gym</span>
                    <p class="text-gray-400 text-sm max-w-xs">
                        Platform kebugaran modern untuk membantu Anda mencapai potensi fisik terbaik Anda.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('member.dashboard') }}" class="hover:text-white">Dashboard</a></li>
                        <li><a href="{{ route('kelas.index') }}" class="hover:text-white">Kelas</a></li>
                        <li><a href="{{ route('members.membership.index') }}" class="hover:text-white">Membership</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Jl. Sehat Selalu No. 123</li>
                        <li>contact@fithubgym.com</li>
                        <li>+62 812 3456 7890</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} FitHub Gym. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
