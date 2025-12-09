<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. Welcome Banner --}}
            <div class="relative bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-lg p-8 text-white overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h1 class="text-3xl font-bold">Welcome back, {{ $member->nama ?? 'Member' }}! 👋</h1>
                        <p class="mt-2 text-indigo-100">Siap untuk latihan hari ini?</p>
                    </div>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="inline-block bg-white/20 hover:bg-white/30 text-white font-semibold py-2 px-6 rounded-lg backdrop-blur-sm transition cursor-pointer">
                            Edit Profile
                        </a>
                    </div>
                </div>
                {{-- Decorative Shapes --}}
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            </div>

            {{-- 2. Main Grid Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI (Membership & Progress & Payment) --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- Membership Status --}}
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Status Membership</h2>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                            @if($member->membership)
                                {{-- JIKA MEMBER AKTIF --}}
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                                    <div>
                                        <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-1">
                                            {{ $member->membership->nama_plan }}
                                        </h3>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Status:</span>
                                            @if($member->status == 'aktif')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                    ● Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                    ● Inactive
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-full mt-4 sm:mt-0">
                                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    </div>
                                </div>

                                @php
                                    $joinDate = \Carbon\Carbon::parse($member->tanggal_bergabung);
                                    $expiryDate = $joinDate->copy()->addDays($member->membership->durasi); 
                                    $daysRemaining = now()->diffInDays($expiryDate, false);
                                    // Hitung persentase durasi berjalan (untuk progress bar)
                                    $totalDays = $member->membership->durasi;
                                    $daysPassed = $totalDays - $daysRemaining;
                                    $progress = ($daysPassed / $totalDays) * 100;
                                    $progress = max(0, min(100, $progress)); // Limit 0-100%
                                @endphp

                                <div class="space-y-4">
                                    {{-- Progress Bar Masa Aktif --}}
                                    <div class="flex justify-between text-xs font-medium text-gray-500 mb-1">
                                        <span>Masa Aktif Berjalan</span>
                                        <span>{{ round($progress) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
                                    </div>
                                    
                                    <div class="grid grid-cols-3 gap-4 text-center divide-x divide-gray-100 dark:divide-gray-700 pt-2">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Mulai</p>
                                            <p class="font-semibold text-gray-900 dark:text-white">{{ $joinDate->format('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Berakhir</p>
                                            <p class="font-semibold text-gray-900 dark:text-white">{{ $expiryDate->format('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Sisa Hari</p>
                                            <p class="font-bold {{ $daysRemaining > 7 ? 'text-indigo-600' : 'text-red-600' }}">
                                                {{ $daysRemaining > 0 ? round($daysRemaining) : 0 }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- JIKA BELUM PUNYA MEMBER --}}
                                <div class="text-center py-8">
                                    <div class="bg-indigo-50 dark:bg-indigo-900/20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Membership Tidak Aktif</h3>
                                    <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">Pilih paket membership di bawah ini untuk membuka akses penuh ke fasilitas gym dan kelas.</p>
                                    
                                    {{-- Grid Pilihan Paket --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                                        @foreach($membershipsPlans as $plan)
                                        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:border-indigo-500 dark:hover:border-indigo-500 transition group bg-white dark:bg-gray-800 relative overflow-hidden shadow-sm hover:shadow-md">
                                            <div class="relative z-10">
                                                <h4 class="font-bold text-lg text-gray-900 dark:text-white group-hover:text-indigo-600 transition">{{ $plan->nama_plan }}</h4>
                                                <div class="flex items-baseline gap-1 my-3">
                                                    <span class="text-2xl font-extrabold text-gray-900 dark:text-white">Rp {{ number_format($plan->harga, 0, ',', '.') }}</span>
                                                    <span class="text-sm text-gray-500">/ {{ $plan->durasi }} hari</span>
                                                </div>
                                                <a href="{{ route('membership.buy', $plan->id) }}" class="mt-2 block w-full py-2.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-center font-bold rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition duration-200">
                                                    Pilih Paket Ini
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>

                    {{-- Progress Stats --}}
                    <section>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Statistik Latihan</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg text-orange-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Workout Streak</span>
                                </div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">12 <span class="text-sm font-normal text-gray-500">Hari</span></p>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Sesi</span>
                                </div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $workoutsThisMonth ?? 0 }} <span class="text-sm font-normal text-gray-500">Bulan Ini</span></p>
                            </div>

                            <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg text-green-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Target</span>
                                    </div>
                                    <span class="text-sm font-bold text-green-600">70%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mt-2">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Payment History --}}
                    <section>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Riwayat Pembayaran</h2>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Order ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Item</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Total</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse($member->user->orders as $order)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                            <td class="px-6 py-4 text-sm font-medium text-indigo-600 dark:text-indigo-400">
                                                #{{ substr($order->order_number, -6) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $order->membership ? $order->membership->nama_plan : ($order->product ? $order->product->name : 'Unknown') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $statusClasses = [
                                                        'paid' => 'bg-green-100 text-green-800 border-green-200',
                                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                        'failed' => 'bg-red-100 text-red-800 border-red-200',
                                                        'expired' => 'bg-gray-100 text-gray-800 border-gray-200',
                                                    ];
                                                    $statusClass = $statusClasses[$order->payment_status] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusClass }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                                Belum ada riwayat transaksi.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>

                {{-- KOLOM KANAN (Status Alat) --}}
                <div class="lg:col-span-1">
                    <section class="sticky top-8">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Status Alat Gym</h2>
                            <span class="text-xs font-semibold bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-gray-600 dark:text-gray-300 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Live
                            </span>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 space-y-4 max-h-[80vh] overflow-y-auto custom-scrollbar">
                            @if($availableTools->count() > 0)
                                @foreach($availableTools as $tool)
                                    @php
                                        $sisa = $tool->jumlah - $tool->terpakai;
                                        $isAvailable = $sisa > 0;
                                        $percentage = ($tool->jumlah > 0) ? ($sisa / $tool->jumlah) * 100 : 0;
                                        // Warna indikator
                                        $color = $isAvailable ? ($percentage < 30 ? 'text-orange-500' : 'text-indigo-600') : 'text-red-500';
                                        $bgColor = $isAvailable ? ($percentage < 30 ? 'bg-orange-500' : 'bg-indigo-600') : 'bg-red-500';
                                    @endphp

                                    <div class="flex items-center p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition border border-transparent hover:border-gray-100 dark:hover:border-gray-700">
                                        <div class="w-12 h-12 rounded-lg bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 mr-4 flex-shrink-0">
                                            {{-- Icon Barbel --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between mb-1">
                                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate pr-2">{{ $tool->nama_alat }}</h4>
                                                <span class="text-xs font-bold {{ $color }} whitespace-nowrap">
                                                    {{ $sisa }} / {{ $tool->jumlah }}
                                                </span>
                                            </div>
                                            {{-- Mini Progress Bar --}}
                                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-1.5">
                                                <div class="{{ $bgColor }} h-1.5 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <p>Data alat tidak tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>