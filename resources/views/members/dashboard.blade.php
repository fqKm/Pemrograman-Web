<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Member Dashboard</h1>
                    <button class="inline-flex items-center justify-center rounded-md font-medium text-sm px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 shadow-sm">
                      Settings
                    </button>
                  </div>
                  <p class="text-lg text-gray-600">Welcome back, {{ $member->nama ?? 'Member' }}!</p>
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
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Your Progress</h2>
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
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">My Classes</h2>
    
    @if($member->kelas->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($member->kelas as $kelas)
                <article class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h3>
                        {{-- Ikon Default --}}
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 mb-4 self-start">
                        Joined
                    </span>
                    <div class="space-y-3">
                        <p class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                @php
                    $waktu = \Carbon\Carbon::parse($kelas->waktu_mulai);
                @endphp
                <span>{{ $waktu->format('l') }} at {{ $waktu->format('H:i') }}</span>
                        </p>
                        <p class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            {{-- Menampilkan nama pelatih dari relasi kelas->pelatih --}}
                            <span>Trainer: {{ $kelas->pelatih ? $kelas->pelatih->nama_pelatih : 'TBA' }}</span>
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-sm text-center text-gray-500">
            You haven't joined any classes yet. Check out the available classes below!
        </div>
    @endif
</section>

<section class="mb-8">
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Available Classes</h2>
    
    @if($availableClasses->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($availableClasses as $class)
            <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $class->nama_kelas }}</h3>
                    {{-- Badge Status --}}
                    @if($class->member_count >= $class->kapasitas_maksimum)
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800 self-start">Full</span>
                    @else
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 self-start">Available</span>
                    @endif
                </div>
                
                {{-- Deskripsi Singkat (dipotong jika terlalu panjang) --}}
                <p class="text-sm mb-4 text-gray-600 line-clamp-2">{{ $class->deskripsi ?? 'No description available.' }}</p>
                
                <div class="space-y-2 text-sm mb-4 flex-grow">
                    {{-- Trainer --}}
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        <span>Trainer: {{ $class->pelatih ? $class->pelatih->nama_pelatih : 'TBA' }}</span>
                    </div>

                    {{-- Jadwal (Hari & Jam) --}}
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        @php
                            $schedule = \Carbon\Carbon::parse($class->waktu_mulai);
                        @endphp
                        <span>{{ $schedule->format('l, d M Y') }} at {{ $schedule->format('H:i') }}</span>
                    </div>

                    {{-- Kapasitas --}}
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        {{-- Logika warna jika penuh --}}
                        <span class="{{ $class->member_count >= $class->kapasitas_maksimum ? 'text-red-600 font-bold' : '' }}">
                            Capacity: {{ $class->member_count }}/{{ $class->kapasitas_maksimum }}
                        </span>
                    </div>
                </div>

                {{-- Tombol Join --}}
                @if($class->member_count < $class->kapasitas_maksimum)
                    <form action="{{ route('kelas.join', $class->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full mt-2 bg-indigo-600 text-white font-medium py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Join Class
                        </button>
                    </form>
                @else
                    <button disabled class="w-full mt-2 bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-md cursor-not-allowed">
                        Class Full
                    </button>
                @endif
            </div>
        @endforeach
    </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-sm text-center text-gray-500">
            No other classes available at the moment.
        </div>
    @endif
</section>

<section class="mb-8">
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Available Equipment</h2>
    
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
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Payment History</h2>
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