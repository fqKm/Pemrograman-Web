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
    <nav class="sticky top-0 w-full z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span class="font-bold text-xl tracking-tight text-gray-900">FitHub Gym</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-600 hover:text-indigo-600 transition">Home</a>
                    <a href="#about" class="text-gray-600 hover:text-indigo-600 transition">About</a>
                    <a href="#classes" class="text-gray-600 hover:text-indigo-600 transition">Classes</a>
                    <a href="#pricing" class="text-gray-600 hover:text-indigo-600 transition">Membership</a>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-900 hover:text-indigo-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Log in</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">Join Now</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                    Build Your Body, <br>
                    <span class="text-indigo-600">Transform Your Life.</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Bergabunglah dengan FitHub Gym untuk mendapatkan akses ke peralatan terbaik, pelatih profesional, dan komunitas yang mendukung perjalanan kebugaran Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:text-lg transition shadow-lg hover:shadow-xl">
                        Mulai Sekarang
                    </a>
                    <a href="#pricing" class="inline-flex justify-center items-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 md:text-lg transition">
                        Lihat Paket
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="bg-indigo-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-white mb-1">500+</div>
                    <div class="text-indigo-200 text-sm">Happy Members</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">20+</div>
                    <div class="text-indigo-200 text-sm">Expert Trainers</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">30+</div>
                    <div class="text-indigo-200 text-sm">Daily Classes</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">24/7</div>
                    <div class="text-indigo-200 text-sm">Support</div>
                </div>
            </div>
        </div>
    </section>

    {{-- CLASSES PREVIEW --}}
    <section id="classes" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kelas Unggulan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berbagai pilihan kelas untuk semua tingkat kemampuan. Pesan kelas favorit Anda setelah menjadi member.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @forelse($featuredClasses as $kelas)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        {{-- Placeholder Image --}}
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $kelas->nama_kelas }}</h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $kelas->deskripsi }}</p>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-indigo-600 font-medium">
                                {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} WIB
                            </span>
                            <span class="text-gray-500">by {{ $kelas->pelatih->nama_pelatih ?? 'Trainer' }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500">
                    Belum ada kelas yang tersedia saat ini.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- PRICING / MEMBERSHIP SECTION --}}
    <section id="pricing" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pilih Paket Membership</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Investasi terbaik untuk kesehatan Anda. Pilih paket yang sesuai dengan kebutuhan dan target Anda.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($memberships as $plan)
                <div class="relative bg-white rounded-2xl border border-gray-200 p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $plan->nama_plan }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $plan->formatted_duration }} Access</p>
                    </div>
                    
                    <div class="mb-6">
                        <span class="text-4xl font-extrabold text-gray-900">Rp {{ number_format($plan->harga, 0, ',', '.') }}</span>
                    </div>

                    <p class="text-gray-600 mb-8 text-sm flex-grow">
                        {{ $plan->deskripsi ?? 'Akses penuh ke semua fasilitas gym dan kelas reguler.' }}
                    </p>

                    <ul class="mb-8 space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Gym Access
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Locker Room
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Free WiFi
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="block w-full text-center bg-indigo-50 text-indigo-700 hover:bg-indigo-600 hover:text-white font-semibold py-3 rounded-lg transition-colors duration-200">
                        Pilih Paket Ini
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white py-12">
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
                        <li><a href="#home" class="hover:text-white">Home</a></li>
                        <li><a href="#about" class="hover:text-white">About Us</a></li>
                        <li><a href="#classes" class="hover:text-white">Classes</a></li>
                        <li><a href="#pricing" class="hover:text-white">Pricing</a></li>
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