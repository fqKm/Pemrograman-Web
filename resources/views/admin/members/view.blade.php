<x-app-layout>
    {{-- Slot untuk header (opsional, tapi sering ada) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Member') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white ">Detail Member</h1>
                <a href="{{ route('members.index') }}" class="text-indigo-500 hover:text-indigo-700">
                    &larr; Kembali ke Daftar
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Nama:</span>
                            <p class="font-medium text-lg">{{ $member->nama }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email:</span>
                            <p class="font-medium text-lg">{{ $member->email }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">Nomor Telepon:</span>
                            <p class="font-medium text-lg">{{ $member->nomor_hp ?? '-' }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">Paket Membership:</span>
                            <p class="font-medium text-lg">{{ $member->membership->nama_plan ?? 'Tidak ada paket' }}</p>
                        </div>

                        {{-- <div>
                            <span class="text-sm text-gray-500">Tanggal Lahir:</span>
                            <p class="font-medium text-lg">{{ \Carbon\Carbon::parse($member->tanggal_lahir)->format('d F Y') }}</p>
                        </div> --}}

                        <div>
                            <span class="text-sm text-gray-500">Tanggal Bergabung:</span>
                            <p class="font-medium text-lg">{{ \Carbon\Carbon::parse($member->tanggal_bergabung)->format('d F Y') }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">Status:</span>
                            <p class="font-medium text-lg">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $member->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">Dibuat Pada:</span>
                            <p class="font-medium text-lg">{{ $member->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
