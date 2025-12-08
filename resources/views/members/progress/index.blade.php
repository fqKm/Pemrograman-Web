<!-- @extends('layouts.member')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Progress Kelas: {{ $kelas->nama_kelas }}</h2>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama Latihan</th>
                <th class="border p-2">Deskripsi</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($progress as $idx => $item)
            <tr>
                <td class="border p-2">{{ $idx + 1 }}</td>
                <td class="border p-2">{{ $item->nama_latihan }}</td>
                <td class="border p-2">{{ $item->deskripsi ?? '-' }}</td>
                <td class="border p-2">
                    @php
                        $memberProgress = $item->kemajuanMembers->first();
                    @endphp
                    @if($memberProgress && $memberProgress->is_done)
                        <span class="text-green-600 font-semibold">Selesai</span>
                    @else
                        <span class="text-red-600 font-semibold">Belum</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection -->
