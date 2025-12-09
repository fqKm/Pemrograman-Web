<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Alat Gym') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Inventaris Alat</h1>
                    <p class="text-sm text-gray-500">Kelola stok dan pemakaian alat gym.</p>
                </div>
                
                @if(auth()->user()->hasPermission('tambah_alat'))
                    <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Tambah Alat Baru
                    </a>
                @endif
            </div>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">&times;</button>
                </div>
            @elseif(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">&times;</button>
                </div>
            @endif

            {{-- Grid Alat --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($alat as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col h-full">
                        
                        {{-- Card Header --}}
                        <div class="p-6 pb-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-bold text-lg text-gray-900 line-clamp-1" title="{{ $item->nama_alat }}">
                                    {{ $item->nama_alat }}
                                </h3>
                                <div class="p-2 rounded-full bg-indigo-50 text-indigo-600">
                                    {{-- Icon Dumbbell --}}
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.5 6.5m-3.5 0a3.5 3.5 0 1 0 7 0a3.5 3.5 0 1 0 -7 0"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.5 6.5m-3.5 0a3.5 3.5 0 1 0 7 0a3.5 3.5 0 1 0 -7 0"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.5 6.5l5 5.5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.5 6.5l-5 5.5"/></svg>
                                </div>
                            </div>

                            {{-- Statistik Alat --}}
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Total</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $item->jumlah }}</p>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Tersedia</p>
                                    @php
                                        $sisa = $item->jumlah - $item->terpakai;
                                    @endphp
                                    <p class="text-xl font-bold {{ $sisa > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $sisa }}
                                    </p>
                                </div>
                            </div>

                            {{-- Info Terpakai --}}
                            <div class="flex items-center justify-between text-sm mb-2">
                                <span class="text-gray-600">Sedang Dipakai:</span>
                                <span class="font-medium {{ $item->terpakai > 0 ? 'text-orange-600' : 'text-gray-400' }}">
                                    {{ $item->terpakai }} Unit
                                </span>
                            </div>

                            {{-- Info Tanggal --}}
                            <div class="flex items-center text-xs text-gray-400 mt-2">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Beli: {{ \Carbon\Carbon::parse($item->tanggal_pembelian)->format('d M Y') }}
                            </div>
                        </div>

                        {{-- Card Footer (Actions) --}}
                        <div class="mt-auto bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end space-x-2">
                            
                            @if(auth()->user()->hasPermission('ubah_alat'))
                                <a href="{{ route('admin.alat.edit', $item->id) }}" class="p-2 text-yellow-600 hover:bg-yellow-100 rounded-full transition" title="Edit Alat">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                            @endif

                            @if(auth()->user()->hasPermission('hapus_alat'))
                                <form action="{{ route('admin.alat.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus alat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-100 rounded-full transition" title="Hapus Alat">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <p class="mt-2 text-gray-500 font-medium">Belum ada alat terdaftar.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>