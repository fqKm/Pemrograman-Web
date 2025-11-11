<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Menggunakan helper __() adalah praktik terbaik untuk terjemahan --}}
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>

    {{-- Wrapper ini diambil dari dashboard.blade.php untuk konsistensi --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- space-y-8 memberi jarak antar seksi (header, main, footer) --}}
            <div class="space-y-8">

                {{-- Ini adalah header dari file member-dashboard.html --}}
                <header>
                  <div class="flex items-center justify-between mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Member Dashboard</h1>
                    <button class="inline-flex items-center justify-center rounded-md font-medium text-sm px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 shadow-sm">
                      Settings
                    </button>
                  </div>
                  <p class="text-lg text-gray-600">Welcome back, John Doe!</p>
                </header>

                {{-- Ini adalah <main> dari file member-dashboard.html --}}
                <main>
                  <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Your Membership</h2>
                    <div class="bg-white p-6 rounded-lg shadow-sm overflow-hidden">
                      <div class="flex items-start justify-between mb-4">
                        <div>
                          <h3 class="text-xl font-semibold mb-2 text-gray-900">Premium Plan</h3>
                          <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 self-start">Active</span>
                        </div>
                        <svg class="w-12 h-12 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                      </div>
                      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                          <p class="text-gray-500">Start Date</p>
                          <p class="font-semibold text-gray-900">January 15, 2025</p>
                        </div>
                        <div>
                          <p class="text-gray-500">Expiry Date</p>
                          <p class="font-semibold text-gray-900">January 15, 2026</p>
                        </div>
                        <div>
                          <p class="text-gray-500">Days Remaining</p>
                          <p class="font-semibold text-indigo-600">444 days</p>
                        </div>
                      </div>
                      <button class="mt-4 inline-flex items-center justify-center bg-indigo-600 text-white font-medium py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Renew Membership
                      </button>
                    </div>
                  </section>

                  <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Your Progress</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                      <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                          <h3 class="text-sm font-medium text-gray-500">Workout Streak</h3>
                          <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                          </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mb-1">12 Days</p>
                        <p class="text-xs text-gray-500 mt-2">Keep it up!</p>
                      </div>
                      
                      <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                          <h3 class="text-sm font-medium text-gray-500">Classes Completed</h3>
                          <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                          </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mb-1">28</p>
                        <p class="text-xs text-gray-500 mt-2">This month</p>
                      </div>

                      <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                          <h3 class="text-sm font-medium text-gray-500">Monthly Goal</h3>
                          <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                          </svg>
                        </div>
                        <div class="mb-2">
                          <div class="flex items-center justify-between text-sm mb-1">
                            <span class="text-gray-600">Progress</span>
                            <span class="font-medium text-gray-900">70%</span>
                          </div>
                          <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 70%"></div>
                          </div>
                        </div>
                        <p class="text-sm text-gray-500">21/30 workouts</p>
                      </div>
                    </div>
                  </section>

                  <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">My Classes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <article class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                        <div class="flex items-start justify-between mb-2">
                          <h3 class="text-lg font-semibold text-gray-900">HIIT Training</h3>
                          <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                          </svg>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 mb-4 self-start">
                          Joined
                        </span>
                        <div class="space-y-3">
                          <p class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <circle cx="12" cy="12" r="10"/>
                              <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <span>Mon, Wed, Fri at 6:00 PM</span>
                          </p>
                          <p class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                              <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>Trainer: Sarah Johnson</span>
                          </p>
                        </div>
                      </article>

                      <article class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                        <div class="flex items-start justify-between mb-2">
                          <h3 class="text-lg font-semibold text-gray-900">Yoga Flow</h3>
                          <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                          </svg>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 mb-4 self-start">
                          Joined
                        </span>
                        <div class="space-y-3">
                          <p class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <circle cx="12" cy="12" r="10"/>
                              <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <span>Tuesday & Thursday at 7:30 AM</span>
                          </p>
                          <p class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                              <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>Trainer: Emma Wilson</span>
                          </p>
                        </div>
                      </article>
                    </div>
                  </section>

                  <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Available Classes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                        <div class="flex items-start justify-between mb-3">
                          <h3 class="text-lg font-semibold text-gray-900">Strength Training</h3>
                          <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 self-start">Available</span>
                        </div>
                        <p class="text-sm mb-4 text-gray-600">Build muscle and increase strength with guided weightlifting sessions.</p>
                        <div class="space-y-2 text-sm mb-4 flex-grow">
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>Trainer: Mike Anderson</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <span>Mon & Wed, 5:00 PM</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <span>Capacity: 8/15</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                            <span>$15/session</span>
                          </div>
                        </div>
                        <button class="w-full mt-2 bg-indigo-600 text-white font-medium py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                          Join Class
                        </button>
                      </div>

                      <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                        <div class="flex items-start justify-between mb-3">
                          <h3 class="text-lg font-semibold text-gray-900">Spin Class</h3>
                          <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 self-start">Available</span>
                        </div>
                        <p class="text-sm mb-4 text-gray-600">High-energy cycling workout with music to boost your cardio.</p>
                        <div class="space-y-2 text-sm mb-4 flex-grow">
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>Trainer: Lisa Chen</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <span>Tue & Thu, 6:30 PM</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <span>Capacity: 12/20</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                            <span>$12/session</span>
                          </div>
                        </div>
                        <button class="w-full mt-2 bg-indigo-600 text-white font-medium py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                          Join Class
                        </button>
                      </div>

                      <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
                        <div class="flex items-start justify-between mb-3">
                          <h3 class="text-lg font-semibold text-gray-900">Pilates Core</h3>
                          <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 self-start">Available</span>
                        </div>
                        <p class="text-sm mb-4 text-gray-600">Strengthen your core and improve flexibility with pilates.</p>
                        <div class="space-y-2 text-sm mb-4 flex-grow">
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>Trainer: Rachel Green</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <span>Wednesday, 8:00 AM</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <span>Capacity: 5/10</span>
                          </div>
                          <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                            <span>$10/session</span>
                          </div>
                        </div>
                        <button class="w-full mt-2 bg-indigo-600 text-white font-medium py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                          Join Class
                        </button>
                      </div>
                    </div>
                  </section>

                  <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Available Equipment</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                      
                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <path d="M6.5 6.5m-3.5 0a3.5 3.5 0 1 0 7 0a3.5 3.5 0 1 0 -7 0"/>
                              <path d="M17.5 6.5m-3.5 0a3.5 3.5 0 1 0 7 0a3.5 3.5 0 1 0 -7 0"/>
                              <path d="M6.5 6.5l5 5.5"/><path d="M17.5 6.5l-5 5.5"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Dumbbells</h3>
                            <p class="text-sm text-gray-500">5-50 lbs</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Treadmills</h3>
                            <p class="text-sm text-gray-500">10 units</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Weight Plates</h3>
                            <p class="text-sm text-gray-500">Various sizes</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <ellipse cx="12" cy="12" rx="10" ry="6"/><ellipse cx="12" cy="12" rx="6" ry="3"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Ellipticals</h3>
                            <p class="text-sm text-gray-500">8 units</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                              <polyline points="14 2 14 8 20 8"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Benches</h3>
                            <p class="text-sm text-gray-500">12 units</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <circle cx="12" cy="5" r="3"/><line x1="12" y1="22" x2="12" y2="8"/>
                              <path d="M5 12H2a10 10 0 0 0 20 0h-3"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Kettlebells</h3>
                            <p class="text-sm text-gray-500">10-40 lbs</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <circle cx="12" cy="12" r="10"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Stationary Bikes</h3>
                            <p class="text-sm text-gray-500">15 units</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                      <div class="bg-white p-5 rounded-lg shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                          <div class="p-2 rounded-lg bg-indigo-100">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <rect x="3" y="8" width="18" height="12" rx="2" ry="2"/><line x1="3" y1="12" x2="21" y2="12"/>
                            </svg>
                          </div>
                          <div>
                            <h3 class="font-semibold text-gray-900">Cable Machines</h3>
                            <p class="text-sm text-gray-500">6 units</p>
                          </div>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                      </div>

                    </div>
                  </section>
                </main>

                {{-- Ini adalah <footer> dari file member-dashboard.html --}}
                <footer class="mt-8 pt-6 border-t border-gray-200 text-center text-gray-500">
                  <p>&copy; 2025 FitHub Gym. All rights reserved.</p>
                </footer>
                
            </div>
        </div>
    </div>
</x-app-layout>