<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Membership: ') . $membership->nama_plan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white ">Detail Membership</h1>
                <a href="{{ route('admin.membership.index') }}" class="text-indigo-500 hover:text-indigo-700">
                    &larr; Kembali ke Daftar Membership
                </a>
            </div>

            {{-- Kartu Detail Pelatih --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Nama Plan</span>
                            <p class="font-medium text-lg">{{ $membership->nama_plan }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Durasi</span>
                            <p class="font-medium text-lg">{{ $membership->formatted_duration ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Harga</span>
                            <p class="font-medium text-lg">Rp.{{ $membership->harga ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Deskripsi</span>
                            <p class="font-medium text-lg">{{ $membership->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end">
                        <a href="{{ route('admin.membership.edit', $membership) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Edit Membership Ini Ini
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kartu Daftar Kelas yang Diajar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg text-gray-900 mb-4">Daftar Member</h3>
                    @if($membership->members->isNotEmpty())
                        <ul class="divide-y divide-gray-200">
                            @foreach($membership->members as $member)
                                <li>
                                    <strong>
                                        <a href="{{ route('admin.members.show', $member->id) }}" class="text-indigo-500 hover:underline">
                                            {{ $member->nama }}
                                        </a>
                                    </strong>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center text-gray-500">Belum Ada Member yang berlangganan Membership Ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
