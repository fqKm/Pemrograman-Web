<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-white text-gray-800 leading-tight">
            {{-- Menggunakan helper __() adalah praktik terbaik untuk terjemahan --}}
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>

    {{-- Wrapper ini diambil dari dashboard.blade.php untuk konsistensi --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- space-y-8 memberi jarak antar seksi (header, main, footer) --}}
            <div class="space-y-8">

                {{-- Ini adalah header dari file member-dashboard.html --}}
                <header>
                  <div class="flex items-center justify-between mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Member Dashboard</h1>
                    <button class="inline-flex items-center justify-center rounded-md font-medium text-sm px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 shadow-sm">
                      Settings
                    </button>
                  </div>
                  <p class="text-lg text-gray-600 dark:text-white">Welcome back, {{ $member->nama ?? 'Member' }}!</p>
                </header>

                {{-- Ini adalah <main> dari file member-dashboard.html --}}
                <main>
<section class="mb-8">
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Your Membership</h2>
    <div class="bg-white p-6 rounded-lg shadow-sm overflow-hidden">
        
        {{-- KONDISI 1: User Sudah Punya Membership --}}
        @if($member->membership)
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">
                        {{ $member->membership->nama_plan }}
                    </h3>
                    
                    @if($member->status == 'aktif')
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 self-start">Active</span>
                    @else
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800 self-start">Inactive</span>
                    @endif
                </div>
                <svg class="w-12 h-12 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                </svg>
            </div>

            @php
                $joinDate = \Carbon\Carbon::parse($member->tanggal_bergabung);
                $expiryDate = $joinDate->copy()->addDays($member->membership->durasi); 
                $daysRemaining = now()->diffInDays($expiryDate, false);
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Start Date</p>
                    <p class="font-semibold text-gray-900">{{ $joinDate->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Expiry Date</p>
                    <p class="font-semibold text-gray-900">{{ $expiryDate->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Days Remaining</p>
                    <p class="font-semibold {{ $daysRemaining > 0 ? 'text-indigo-600' : 'text-red-600' }}">
                        {{ $daysRemaining > 0 ? round($daysRemaining) . ' days' : 'Expired' }}
                    </p>
                </div>
            </div>

        {{-- KONDISI 2: User Belum Punya Membership (Tampilkan Pilihan Paket) --}}
        @else
            <div class="text-center pb-6 border-b border-gray-100 mb-6">
                <h3 class="text-lg font-medium text-gray-900">Anda belum memiliki Membership Aktif</h3>
                <p class="text-gray-500">Silakan pilih paket di bawah ini untuk mulai booking kelas dan latihan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($membershipsPlans as $plan)
                <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-500 hover:shadow-md transition">
                    <h4 class="text-lg font-bold text-gray-900">{{ $plan->nama_plan }}</h4>
                    <p class="text-2xl font-bold text-indigo-600 my-2">Rp {{ number_format($plan->harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mb-4">{{ $plan->durasi }} Hari</p>
                    
                    {{-- Tombol Beli (Pastikan route 'membership.buy' sudah ada di web.php) --}}
                    <a href="{{ route('membership.buy', $plan->id) }}" class="block w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-center font-semibold rounded-md transition">
                        Pilih Paket
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Your Progress</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-gray-500">Workout Streak</h3>
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
            </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">12 Days</p>
            <p class="text-xs text-gray-500 mt-2">Keep it up!</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-gray-500">Classes Completed</h3>
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">28</p>
            <p class="text-xs text-gray-500 mt-2">This month</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-gray-500">Monthly Goal</h3>
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M22 12h-4l-3 9L9 3l-3 9H2"/>
            </svg>
            </div>
            <div class="mb-2">
            <div class="flex items-center justify-between text-sm mb-1">
                <span class="text-gray-600">Progress</span>
                <span class="font-medium text-gray-900">70%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-indigo-600 h-2 rounded-full" style="width: 70%"></div>
            </div>
            </div>
            <p class="text-sm text-gray-500">21/30 workouts</p>
        </div>
        </div>
    </section>

<section class="mb-8">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Available Equipment</h2>
    
    @if($availableTools->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($availableTools as $tool)
                @php
                    // Hitung sisa alat
                    $sisa = $tool->jumlah - $tool->terpakai;
                    $isAvailable = $sisa > 0;
                @endphp

                <div class="bg-white p-5 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-3">
                        {{-- Generic Icon for Tools --}}
                        <div class="p-2 rounded-lg {{ $isAvailable ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-400' }}">
                            {{-- Icon Dumbbell --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M6.5 6.5m-3.5 0a3.5 3.5 0 1 0 7 0a3.5 3.5 0 1 0 -7 0"/>
                                <path d="M17.5 6.5m-3.5 0a3.5 3.5 0 1 0 7 0a3.5 3.5 0 1 0 -7 0"/>
                                <path d="M6.5 6.5l5 5.5"/><path d="M17.5 6.5l-5 5.5"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 line-clamp-1" title="{{ $tool->nama_alat }}">
                                {{ $tool->nama_alat }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $isAvailable ? $sisa . ' units left' : 'Out of stock' }}
                            </p>
                        </div>
                    </div>
                    
                    {{-- Status Badge --}}
                    @if($isAvailable)
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Available
                        </span>
                    @else
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            In Use
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-sm text-center text-gray-500">
            No equipment data available.
        </div>
    @endif
</section>

<section class="mb-8">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Payment History</h2>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($member->user->orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $order->membership ? $order->membership->nama_plan : ($order->product ? $order->product->name : '-') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($order->total_amount) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
                </main>

                {{-- Ini adalah <footer> dari file member-dashboard.html --}}
                <footer class="mt-8 pt-6 border-t border-gray-200 text-center text-gray-500">
                  <p>&copy; 2025 FitHub Gym. All rights reserved.</p>
                </footer>
                
            </div>
        </div>
    </div>
</x-app-layout>