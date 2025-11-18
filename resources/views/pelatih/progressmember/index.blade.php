<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Progress Member: {{ $member->nama_member }} ({{ $kelas->nama_kelas }})
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Detail Member --}}
            <div class="bg-white p-6 shadow rounded-lg mb-6">
                <h3 class="text-lg font-bold mb-4">Detail Member</h3>
                <p><strong>Nama:</strong> {{ $member->nama }}</p>
                <p><strong>Email:</strong> {{ $member->email }}</p>
                <p><strong>No HP:</strong> {{ $member->nomor_hp }}</p>
                <p><strong>Status:</strong> {{ $member->status }}</p>
            </div>

            {{-- Detail Kelas --}}
            <div class="bg-white p-6 shadow rounded-lg mb-6">
                <h3 class="text-lg font-bold mb-4">Detail Kelas</h3>
                <p><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</p>
                <p><strong>Pelatih:</strong> {{ $kelas->pelatih->nama_pelatih }}</p>
            </div>

            {{-- Progress --}}
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold mb-4">Daftar Progress Latihan</h3>

                @if($progress->isEmpty())
                    <p class="text-gray-500 text-center py-4">Belum ada progress latihan.</p>
                @else
                    <table class="w-full text-sm border border-gray-300">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">Latihan</th>
                            <th class="p-3 border">Set</th>
                            <th class="p-3 border">Repetisi</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Catatan</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($progress as $item)
                            <form method="POST" action="{{ route('progressmember.update', $item->id) }}">
                                @csrf
                                @method('PUT')

                                <tr>
                                    <td class="border p-3 font-semibold text-center">
                                        {{ $item->kemajuan->nama_latihan }}
                                    </td>

                                    <td class="border p-3 text-center">
                                        {{ $item->kemajuan->jumlah_set }}
                                    </td>

                                    <td class="border p-3 text-center">
                                        {{ $item->kemajuan->jumlah_repetisi }}
                                    </td>

                                    <td class="border p-3 text-center">
                                        @if($item->is_done == 1)
                                            <span class="text-green-600 font-semibold">Selesai</span>
                                        @elseif($item->is_done == 0)
                                            <span class="text-red-600 font-semibold">Belum</span>
                                        @endif
                                    </td>

                                    <!-- Deskripsi DI KOLOM TERPISAH -->
                                    <td class="border p-3 text-center">
                                        @if($item->is_done == 0)
                                            <textarea name="deskripsi"
                                                      class="w-full border rounded p-1 text-xs mt-2"
                                                      placeholder="Catatan pelatih..."></textarea>
                                        @else
                                            {{ $item->deskripsi ?? '-' }}
                                        @endif
                                    </td>

                                    <!-- Button selesai DI KOLOM TERPISAH -->
                                    <td class="border p-3 text-center">
                                        @if(!$item->is_done)
                                            <input type="hidden" name="is_done" value="1">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                                Tandai Selesai
                                            </button>
                                        @else
                                            <span class="text-gray-500 text-xs italic">Sudah dinilai</span>
                                        @endif
                                    </td>
                                </tr>
                            </form>
                        @endforeach


                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
