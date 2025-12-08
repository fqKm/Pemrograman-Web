@extends('layouts.member')

@section('content')
<div class="py-12">
    <div class="pt-32 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <h2 class="text-2xl font-semibold text-gray-900">Available Classes</h2>

        @if($kelass->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kelass as $kelas)
            <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h3>
                    @if($kelas->member_count >= $kelas->kapasitas_maksimum)
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">Full</span>
                    @else
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Available</span>
                    @endif
                </div>

                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $kelas->deskripsi ?? 'No description available.' }}</p>

                <div class="text-sm text-gray-600 mb-4">
                    <p>Trainer: {{ $kelas->pelatih ? $kelas->pelatih->nama_pelatih : 'TBA' }}</p>
                    <p>Schedule: {{ \Carbon\Carbon::parse($kelas->waktu_mulai)->format('l, H:i') }} - {{ \Carbon\Carbon::parse($kelas->waktu_selesai)->format('H:i') }}</p>
                    <p>Capacity: {{ $kelas->member_count }}/{{ $kelas->kapasitas_maksimum }}</p>
                </div>

                @if($kelas->member_count < $kelas->kapasitas_maksimum)
                <form action="{{ route('kelas.join', $kelas->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                        Join Class
                    </button>
                </form>
                @else
                <button disabled class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-md cursor-not-allowed">
                    Class Full
                </button>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white p-6 rounded-lg shadow-sm text-center text-gray-500">
            No classes available at the moment.
        </div>
        @endif
    </div>
</div>
@endsection
