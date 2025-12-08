<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pelatih') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tambahkan space-y-8 untuk memberi jarak antar seksi --}}
            <div class="space-y-8">

                <div class="relative rounded-lg overflow-hidden shadow-lg">
                     <img {{--src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1200&h=300&fit=crop" --}}
                         alt="Gym training environment" class="w-full h-60 object-cover">
                    <div class="absolute inset-0 bg-white bg-opacity-100 flex flex-col justify-center items-center text-center p-6">
                        <h1 class="text-10xl font-bold text-black mb-2">Selamat Datang {{$pelatih->nama_pelatih}}</h1>
                        <p class="text-lg text-gray-600 dark:text-black ">Manage your classes, track student progress, and organize
                            workout plans</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm font-medium text-gray-500 mb-2">Total Classes</div>
                        <div class="text-4xl font-bold text-gray-900">{{ $kelas->count() }}</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm font-medium text-gray-500 mb-2">Active Students</div>
                        <div class="text-4xl font-bold text-gray-900"> {{ $members->count() }}</div>
                    </div>
                </div>

                <section>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4 dark:text-white">Your Class</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($kelas as $kelas_data)
                            <article class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-lg font-semibold">{{$kelas_data->nama_kelas}}</h3>
                                    <a href="{{ route('kelas.show', $kelas_data->id) }}"
                                       class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Manage</a>
                                </div>
                                <span></span>
                                <h3 class="text-lg font-semibol mb-2"> Jumlah Member Bergabung
                                    : {{$kelas_data->member->count()}}</h3>
                                <span
                                    class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 mb-4 self-start">
                                ongoing
                                </span>
                            </article>
                        @empty
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <p class="text-center text-gray-500 py-10">Belum ada kelas tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
                
                <section>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Your Students</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        @forelse($members as $member)
                            <article class="bg-white rounded-lg shadow-sm overflow-hidden ">
                                <div class="flex items-center p-4">
                                    <div>
                                        <h4 class="font-semibold text-gray-900"> {{$member->nama }}</h4>
                                        @foreach($member->kelas as $kelas_member)

                                            <p class="text-sm text-gray-500">{{$kelas_member->nama_kelas}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <p class="text-center text-gray-500 py-10">Belum ada member yang bergabung ke
                                    kelasmu.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
