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
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1200&h=300&fit=crop" alt="Gym training environment" class="w-full h-60 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center p-6">
                        <h1 class="text-4xl font-bold text-white mb-2">Trainer Dashboard</h1>
                        <p class="text-lg text-gray-200">Manage your classes, track student progress, and organize workout plans</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm font-medium text-gray-500 mb-2">Total Classes</div>
                        <div class="text-4xl font-bold text-gray-900">12</div>
                        <div class="text-xs text-gray-400 mt-2">+2 from last month</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm font-medium text-gray-500 mb-2">Active Students</div>
                        <div class="text-4xl font-bold text-gray-900">48</div>
                        <div class="text-xs text-gray-400 mt-2">+8 new this week</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm font-medium text-gray-500 mb-2">Workout Plans</div>
                        <div class="text-4xl font-bold text-gray-900">24</div>
                        <div class="text-xs text-gray-400 mt-2">+5 created recently</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm font-medium text-gray-500 mb-2">Next Class</div>
                        <div class="text-4xl font-bold text-gray-900">2:00 PM</div>
                        <div class="text-xs text-gray-400 mt-2">HIIT Traxining</div>
                    </div>
                </div>

                <section>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Upcoming Classes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <article class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-semibold">HIIT Training</h3>
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Manage</a>
                            </div>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 mb-4 self-start">
                                ongoing
                            </span>
                            <div class="space-y-3">
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Today</span>
                                </p>
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>09:00 AM - 10:00 AM</span>
                                </p>
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <span>15/20 participants</span>
                                </p>
                            </div>
                        </article>

                        <article class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-semibold">Strength & Conditioning</h3>
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Manage</a>
                            </div>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 mb-4 self-start">
                                scheduled
                            </span>
                            <div class="space-y-3">
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Today</span>
                                </p>
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>02:00 PM - 03:00 PM</span>
                                </p>
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <span>12/15 participants</span>
                                </p>
                            </div>
                        </article>
                        
                        <article class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-semibold">Core Blast</h3>
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Manage</a>
                            </div>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 mb-4 self-start">
                                scheduled
                            </span>
                            <div class="space-y-3">
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Tomorrow</span>
                                </p>
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>06:00 PM - 07:00 PM</span>
                                </p>
                                <p class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <span>8/12 participants</span>
                                </p>
                            </div>
                        </article>

                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Recent Students</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="flex items-center p-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white bg-blue-500 mr-4 flex-shrink-0">SJ</div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Sarah Johnson</h4>
                                    <p class="text-sm text-gray-500">HIIT Training</p>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                    <span>Progress</span>
                                    <span>85%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 85%;"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-gray-50 border-t border-gray-200">
                                <span class="flex items-center text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    24 sessions completed
                                </span>
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View Details</a>
                            </div>
                        </article>

                        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="flex items-center p-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white bg-green-500 mr-4 flex-shrink-0">MC</div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Mike Chen</h4>
                                    <p class="text-sm text-gray-500">Strength & Conditioning</p>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                    <span>Progress</span>
                                    <span>72%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 72%;"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-gray-50 border-t border-gray-200">
                                <span class="flex items-center text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    18 sessions completed
                                </span>
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View Details</a>
                            </div>
                        </article>

                        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="flex items-center p-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white bg-purple-500 mr-4 flex-shrink-0">ED</div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Emma Davis</h4>
                                    <p class="text-sm text-gray-500">Core Blast</p>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                    <span>Progress</span>
                                    <span>90%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-gray-50 border-t border-gray-200">
                                <span class="flex items-center text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    28 sessions completed
                                </span>
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View Details</a>
                            </div>
                        </article>
                        
                        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="flex items-center p-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white bg-yellow-500 mr-4 flex-shrink-0">JW</div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">James Wilson</h4>
                                    <p class="text-sm text-gray-500">HIIT Training</p>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                    <span>Progress</span>
                                    <span>65%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 65%;"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-gray-50 border-t border-gray-200">
                                <span class="flex items-center text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    15 sessions completed
                                </span>
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View Details</a>
                            </div>
                        </article>

                    </div>
                </section>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Active Workout Plans</h2>
                    <div class="flex flex-col space-y-4">
                        
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">Beginner Full Body</h3>
                            <div class="text-sm text-gray-500 mb-2 space-y-1">
                                <div class="flex items-center">⏱️ Duration: 4 weeks</div>
                                <div class="flex items-center">📊 Difficulty: Beginner</div>
                                <div class="flex items-center">👥 12 students enrolled</div>
                            </div>
                            <button class="w-full mt-2 bg-indigo-600 text-white font-medium py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                View Details
                            </button>
                        </div>
                        
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">Advanced HIIT</h3>
                            <div class="text-sm text-gray-500 mb-2 space-y-1">
                                <div class="flex items-center">⏱️ Duration: 6 weeks</div>
                                <div class="flex items-center">📊 Difficulty: Advanced</div>
                                <div class="flex items-center">👥 8 students enrolled</div>
                            </div>
                            <button class="w-full mt-2 bg-indigo-600 text-white font-medium py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                View Details
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>