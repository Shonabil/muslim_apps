@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>
                <p class="mb-6">Halo, {{ auth()->user()->name }}! Ini adalah halaman dashboard admin.</p>

               <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Pengguna -->
    <div class="bg-emerald-100 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-emerald-800">Total Pengguna</h2>
        <p class="text-3xl font-bold text-emerald-900 mt-2">{{ $userCount }}</p>
    </div>

    <!-- Artikel -->
    <div class="bg-yellow-100 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-yellow-800">Total Artikel</h2>
        <p class="text-3xl font-bold text-yellow-900 mt-2">{{ $articleCount }}</p>
    </div>

    <!-- Dzikir -->
    <div class="bg-purple-100 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-purple-800">Total Doa</h2>
        <p class="text-3xl font-bold text-purple-900 mt-2">{{ $doaCount }}</p>
    </div>

    <!-- Doa -->
    <div class="bg-rose-100 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-rose-800">Total Dzikir</h2>
        <p class="text-3xl font-bold text-rose-900 mt-2">{{ $dzikirCount }}</p>
    </div>
</div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <!-- Doughnut Chart -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-4">Statistik Data</h2>
                        <canvas id="dashboardDoughnutChart" height="100"></canvas>
                    </div>

                    <!-- Kutipan Islami -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6 shadow-sm text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-600 mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-3-3v6m5.5-9.5A9 9 0 113.5 20.5 9 9 0 0119.5 5.5z" />
                        </svg>
                        <blockquote class="text-lg italic text-green-800">
                            "Barangsiapa bertakwa kepada Allah niscaya Dia akan mengadakan baginya jalan keluar."
                            <br>
                            <span class="text-sm text-green-600">— QS. At-Talaq: 2</span>
                        </blockquote>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>


        const doughnutCtx = document.getElementById('dashboardDoughnutChart').getContext('2d');
        const dashboardDoughnutChart = new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pengguna', 'Artikel', 'Dzikir','Doa'],
                datasets: [{
                    data: [{{ $userCount }}, {{ $articleCount }}, {{ $dzikirCount }}, {{ $doaCount }}],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(251, 191, 36, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(168, 85, 247, 0.7)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endpush
