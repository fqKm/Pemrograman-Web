@extends('layouts.admin') {{-- pastiin layout admin lo udah ada --}}

@section('content')
<div class="py-0">
    <div class="pt-32 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Judul halaman --}}
        <h1 class="text-2xl font-bold text-gray-900">
            Admin Dashboard
        </h1>

        {{-- Header --}}
        <header>
            <p class="text-lg text-gray-700 mt-2">Welcome back, {{ $admin->nama ?? 'Admin' }}!</p>
        </header>

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mt-6">
            
            {{-- Members --}}
            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Members</h2>
                    <p class="text-gray-700 text-2xl">{{ $memberCount }}</p>
                </div>
            </div>

            {{-- Kelas --}}
            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Kelas</h2>
                    <p class="text-gray-700 text-2xl">{{ $kelasCount }}</p>
                </div>
            </div>

            {{-- Pelatih --}}
            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Pelatih</h2>
                    <p class="text-gray-700 text-2xl">{{ $pelatihCount }}</p>
                </div>
            </div>

            {{-- Alat --}}
            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Alat</h2>
                    <p class="text-gray-700 text-2xl">{{ $alatCount }}</p>
                </div>
            </div>

            {{-- Membership --}}
            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Membership</h2>
                    <p class="text-gray-700 text-2xl">{{ $membershipCount }}</p>
                </div>
            </div>
        </div>

        {{-- Recent Orders Table --}}
        <div class="mt-8 bg-white p-6 rounded-lg border border-gray-100 shadow-sm overflow-hidden">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Orders</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Order #</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Member</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Membership</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentOrders as $order)
                        <tr>
                            <td class="px-4 py-2 text-gray-800">{{ $order->order_number }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $order->user->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $order->membership->nama_plan ?? '-' }}</td>
                            <td class="px-4 py-2 text-gray-800">Rp {{ number_format($order->total_amount,0,',','.') }}</td>
                            <td class="px-4 py-2 text-gray-800 capitalize">{{ $order->payment_status }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                        @if($recentOrders->isEmpty())
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-gray-500">No orders found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
