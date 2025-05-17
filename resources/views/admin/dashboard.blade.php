@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header section dengan welcome message -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl shadow-lg mb-6 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold">Dashboard Admin</h1>
                        <p class="mt-2 text-green-100">Assalamu'alaikum, {{ auth()->user()->name }}</p>
                        <p class="text-sm text-green-200">
                            {{ now()->format('l, d F Y') }} | <span id="live-clock"></span>
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-green-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Pengguna -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-full bg-emerald-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-gray-500 text-sm font-medium">Total Pengguna</p>
                                <div class="flex items-center">
                                    <h2 class="text-3xl font-bold text-gray-700">{{ $userCount }}</h2>
                                    <span class="ml-2 text-xs font-medium px-2 py-1 rounded-full bg-emerald-100 text-emerald-800">+{{ rand(1, 5) }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('users.index') ?? '#' }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-800">Lihat Semua Pengguna →</a>
                        </div>
                    </div>
                </div>

                <!-- Artikel -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-full bg-yellow-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-gray-500 text-sm font-medium">Total Artikel</p>
                                <div class="flex items-center">
                                    <h2 class="text-3xl font-bold text-gray-700">{{ $articleCount }}</h2>
                                    <span class="ml-2 text-xs font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">+{{ rand(1, 5) }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('articles.index') ?? '#' }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-800">Kelola Artikel →</a>
                        </div>
                    </div>
                </div>

                <!-- Dzikir -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-full bg-rose-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-gray-500 text-sm font-medium">Total Dzikir</p>
                                <div class="flex items-center">
                                    <h2 class="text-3xl font-bold text-gray-700">{{ $dzikirCount }}</h2>
                                    <span class="ml-2 text-xs font-medium px-2 py-1 rounded-full bg-rose-100 text-rose-800">+{{ rand(1, 5) }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('dzikir.index') ?? '#' }}" class="text-sm font-medium text-rose-600 hover:text-rose-800">Kelola Dzikir →</a>
                        </div>
                    </div>
                </div>

                <!-- Doa -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-full bg-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-gray-500 text-sm font-medium">Total Doa</p>
                                <div class="flex items-center">
                                    <h2 class="text-3xl font-bold text-gray-700">{{ $doaCount }}</h2>
                                    <span class="ml-2 text-xs font-medium px-2 py-1 rounded-full bg-purple-100 text-purple-800">+{{ rand(1, 5) }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('doa.index') ?? '#' }}" class="text-sm font-medium text-purple-600 hover:text-purple-800">Kelola Doa →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Data Chart -->
                <div class="bg-white rounded-xl shadow-md p-6 col-span-1 lg:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Statistik Data</h2>
                        <div class="flex space-x-2">
                            <button class="chart-type-btn bg-green-500 text-white px-3 py-1 rounded-md text-sm" data-type="doughnut">Doughnut</button>
                            <button class="chart-type-btn bg-gray-200 text-gray-700 px-3 py-1 rounded-md text-sm" data-type="bar">Bar</button>
                        </div>
                    </div>
                    <div class="h-64 relative">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>

                <!-- Kutipan Islami Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Kutipan Islami</h2>
                    <div class="bg-green-50 border border-green-100 rounded-lg p-4 shadow-sm mb-4">
                        <div class="flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <blockquote class="text-md italic text-green-800 text-center">
                            "Barangsiapa bertakwa kepada Allah niscaya Dia akan mengadakan baginya jalan keluar."
                            <footer class="text-sm text-green-600 mt-2">— QS. At-Talaq: 2</footer>
                        </blockquote>
                    </div>
                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 shadow-sm">
                        <div class="flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <h3 class="font-bold text-blue-800">Jadwal Sholat Hari Ini</h3>
                            <div class="mt-2 grid grid-cols-2 gap-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-600">Subuh:</span>
                                    <span class="font-medium">04:30</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-600">Dzuhur:</span>
                                    <span class="font-medium">12:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-600">Ashar:</span>
                                    <span class="font-medium">15:15</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-600">Maghrib:</span>
                                    <span class="font-medium">18:05</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-600">Isya:</span>
                                    <span class="font-medium">19:15</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-md p-6 col-span-1 lg:col-span-2">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Aktivitas Terbaru</h2>
                    <div class="space-y-4">
                        <div class="border-l-4 border-blue-500 pl-4 py-1">
                            <p class="text-gray-700">Admin <span class="font-medium">Ahmad</span> menambahkan artikel baru</p>
                            <p class="text-gray-500 text-sm">1 jam yang lalu</p>
                        </div>
                        <div class="border-l-4 border-yellow-500 pl-4 py-1">
                            <p class="text-gray-700">Admin <span class="font-medium">Fatimah</span> memperbarui doa harian</p>
                            <p class="text-gray-500 text-sm">3 jam yang lalu</p>
                        </div>
                        <div class="border-l-4 border-green-500 pl-4 py-1">
                            <p class="text-gray-700">Pengguna baru <span class="font-medium">Muhammad</span> bergabung</p>
                            <p class="text-gray-500 text-sm">5 jam yang lalu</p>
                        </div>
                        <div class="border-l-4 border-purple-500 pl-4 py-1">
                            <p class="text-gray-700">Admin <span class="font-medium">{{ auth()->user()->name }}</span> login ke sistem</p>
                            <p class="text-gray-500 text-sm">{{ now()->subMinutes(rand(1, 30))->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Lihat Semua Aktivitas
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Aksi Cepat</h2>
                    <div class="space-y-2">
                        <a href="{{ route('articles.create') ?? '#' }}" class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <div class="p-2 bg-blue-200 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="ml-3 text-blue-700 font-medium">Tambah Artikel</span>
                        </a>
                        <a href="{{ route('dzikir.create') ?? '#' }}" class="flex items-center p-3 bg-rose-50 rounded-lg hover:bg-rose-100 transition-colors">
                            <div class="p-2 bg-rose-200 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="ml-3 text-rose-700 font-medium">Tambah Dzikir</span>
                        </a>
                        <a href="{{ route('doa.create') ?? '#' }}" class="flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            <div class="p-2 bg-purple-200 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="ml-3 text-purple-700 font-medium">Tambah Doa</span>
                        </a>
                        <a href="{{ route('users.create') ?? '#' }}" class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                            <div class="p-2 bg-green-200 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="ml-3 text-green-700 font-medium">Tambah Pengguna</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Live Clock
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();

            // Pad with leading zeros
            hours = hours.toString().padStart(2, '0');
            minutes = minutes.toString().padStart(2, '0');
            seconds = seconds.toString().padStart(2, '0');

            document.getElementById('live-clock').textContent = `${hours}:${minutes}:${seconds}`;
            setTimeout(updateClock, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateClock();

            // Chart Data
            const chartData = {
                labels: ['Pengguna', 'Artikel', 'Dzikir', 'Doa'],
                datasets: [{
                    data: [{{ $userCount }}, {{ $articleCount }}, {{ $dzikirCount }}, {{ $doaCount }}],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)',  // Emerald for Pengguna
                        'rgba(251, 191, 36, 0.7)',  // Yellow for Artikel
                        'rgba(239, 68, 68, 0.7)',   // Rose for Dzikir
                        'rgba(168, 85, 247, 0.7)'   // Purple for Doa
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            };

            // Initialize Chart
            const ctx = document.getElementById('dashboardChart').getContext('2d');
            let dashboardChart = new Chart(ctx, {
                type: 'doughnut',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    }
                }
            });

            // Toggle Chart Type
            document.querySelectorAll('.chart-type-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const chartType = this.getAttribute('data-type');

                    // Update button styles
                    document.querySelectorAll('.chart-type-btn').forEach(btn => {
                        btn.classList.remove('bg-green-500', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });

                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    this.classList.add('bg-green-500', 'text-white');

                    // Destroy current chart
                    dashboardChart.destroy();

                    // Create new chart with selected type
                    let options = {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                }
                            }
                        }
                    };

                    if (chartType === 'doughnut') {
                        options.cutout = '60%';
                    }

                    // For bar chart, we need to adjust some options
                    if (chartType === 'bar') {
                        options.scales = {
                            y: {
                                beginAtZero: true
                            }
                        };
                    }

                    dashboardChart = new Chart(ctx, {
                        type: chartType,
                        data: chartData,
                        options: options
                    });
                });
            });
        });
    </script>
@endpush
