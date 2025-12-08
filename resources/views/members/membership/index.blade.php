@extends('layouts.member')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Available Membership Plans</h2>

    @if(session('success'))
        <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if($membership->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($membership as $plan)
                <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $plan->nama_plan }}</h3>
                    <p class="text-gray-500 mb-1">Duration: {{ $plan->durasi }} Days</p>
                    <p class="text-indigo-600 font-bold text-xl mb-4">Rp {{ number_format($plan->harga, 0, ',', '.') }}</p>
                    
                    <a href="{{ route('membership.buy', $plan->id) }}" 
                       class="block text-center py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Choose Plan
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $membership->links() }}
        </div>
    @else
        <div class="p-6 bg-gray-100 rounded-md text-center text-gray-500">
            No Membership Plans Available.
        </div>
    @endif
</div>
@endsection
