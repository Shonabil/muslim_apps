@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-emerald-50 to-white">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-6xl mx-auto">
                <!-- Hero Section -->
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-2xl mb-10 p-8 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex flex-col md:flex-row items-center justify-between">
                            <div class="mb-6 md:mb-0">
                                <h1 class="text-4xl font-bold mb-3">📖 Daftar Surah Al-Qur'an</h1>
                                <p class="text-lg opacity-90">Temukan dan baca seluruh 114 surah dalam Al-Qur'an</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm">114 Surah</span>
                                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm">6,236 Ayat</span>
                                </div>
                            </div>
                            <div class="hidden md:block transform transition duration-500 hover:scale-110">
                                <img src="{{ asset('assets/1234.png') }}" alt="Quran Illustration" class="h-32 w-auto" />
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open text-white">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Search and Filter Section -->
                <div class="mb-10 bg-white rounded-xl shadow-md p-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 relative">
                            <input type="text" id="search-surah" placeholder="Cari surah berdasarkan nama atau nomor..."
                                class="w-full px-6 py-4 rounded-xl border-2 border-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent shadow-sm text-lg placeholder-gray-400" />
                            <span class="absolute right-5 top-4 text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                        </div>
                        <div class="w-full md:w-64">
                            <select id="filter-surah" class="w-full px-4 py-4 rounded-xl border-2 border-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent shadow-sm text-lg bg-white">
                                <option value="all">Semua Surah</option>
                                <option value="mekah">Makkiyah</option>
                                <option value="madinah">Madaniyah</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Loading State -->
                <div id="loading" class="flex flex-col justify-center items-center py-16 space-y-4">
                    <div class="animate-spin rounded-full h-14 w-14 border-t-4 border-b-4 border-emerald-600"></div>
                    <div class="text-center">
                        <p class="text-lg text-gray-600 font-medium">Memuat daftar surah...</p>
                        <p class="text-gray-500">Mohon tunggu sebentar</p>
                    </div>
                </div>

                <!-- Surah List -->
                <div id="surah-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>

                <!-- Empty State -->
                <div id="empty-state" class="hidden text-center py-16">
                    <div class="mx-auto max-w-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-2xl font-medium text-gray-700 mb-2">Surah tidak ditemukan</h3>
                        <p class="text-gray-500 mb-6">Tidak ada surah yang sesuai dengan pencarian Anda</p>
                        <button id="reset-search" class="px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 shadow-md transition-colors duration-300">
                            Reset Pencarian
                        </button>
                    </div>
                </div>

                <!-- Load More Button -->
                <div id="load-more-container" class="mt-12 text-center hidden">
                    <button id="load-more" class="group relative px-8 py-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 shadow-lg transition-all duration-300 overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center">
                            <span>Muat Lebih Banyak</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-y-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </span>
                        <span class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </button>
                    <p id="load-more-info" class="mt-3 text-sm text-gray-500"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const surahList = document.getElementById('surah-list');
            const loading = document.getElementById('loading');
            const searchInput = document.getElementById('search-surah');
            const filterSelect = document.getElementById('filter-surah');
            const emptyState = document.getElementById('empty-state');
            const resetSearchBtn = document.getElementById('reset-search');
            const loadMoreBtn = document.getElementById('load-more');
            const loadMoreContainer = document.getElementById('load-more-container');
            const loadMoreInfo = document.getElementById('load-more-info');

            let allSurahs = [];
            let filteredSurahs = [];
            let displayedSurahs = 0;
            const itemsPerLoad = 9;

            // Gradient colors for cards
            const gradients = [
                'from-emerald-400 to-emerald-600',
                'from-blue-400 to-blue-600',
                'from-purple-400 to-purple-600',
                'from-amber-400 to-amber-600',
                'from-indigo-400 to-indigo-600',
                'from-teal-400 to-teal-600',
                'from-cyan-400 to-cyan-600',
                'from-green-400 to-green-600'
            ];

            // Fetch surah data
            fetch('https://quran-api.santrikoding.com/api/surah')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    allSurahs = data;
                    loading.style.display = 'none';
                    
                    // Initial load
                    filterAndDisplaySurahs();
                    
                    // Event listeners
                    searchInput.addEventListener('input', filterAndDisplaySurahs);
                    filterSelect.addEventListener('change', filterAndDisplaySurahs);
                    resetSearchBtn.addEventListener('click', resetSearch);
                    loadMoreBtn.addEventListener('click', loadMoreSurahs);
                })
                .catch(error => {
                    loading.innerHTML = `
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <h3 class="text-xl font-medium text-gray-700 mb-2">Gagal memuat data</h3>
                        <p class="text-gray-500 mb-6">Terjadi kesalahan saat mengambil data surah</p>
                        <button id="retry-btn" class="px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 shadow-md transition-colors duration-300">
                            Coba Lagi
                        </button>
                    </div>
                    `;

                    document.getElementById('retry-btn').addEventListener('click', function() {
                        window.location.reload();
                    });

                    console.error('Error fetching data:', error);
                });

            function filterAndDisplaySurahs() {
                const searchTerm = searchInput.value.toLowerCase();
                const filterValue = filterSelect.value;
                
                filteredSurahs = allSurahs.filter(surah => {
                    const matchesSearch = 
                        surah.nama_latin.toLowerCase().includes(searchTerm) ||
                        surah.nama.toLowerCase().includes(searchTerm) ||
                        surah.nomor.toString().includes(searchTerm);
                    
                    const matchesFilter = 
                        filterValue === 'all' || 
                        (filterValue === 'mekah' && surah.tempat_turun.toLowerCase() === 'mekah') ||
                        (filterValue === 'madinah' && surah.tempat_turun.toLowerCase() === 'madinah');
                    
                    return matchesSearch && matchesFilter;
                });

                // Reset display
                surahList.innerHTML = '';
                displayedSurahs = 0;
                
                if (filteredSurahs.length === 0) {
                    emptyState.classList.remove('hidden');
                    loadMoreContainer.classList.add('hidden');
                } else {
                    emptyState.classList.add('hidden');
                    loadMoreSurahs();
                }
            }

            function loadMoreSurahs() {
                const surahsToDisplay = filteredSurahs.slice(displayedSurahs, displayedSurahs + itemsPerLoad);
                displayedSurahs += surahsToDisplay.length;
                
                renderSurahs(surahsToDisplay);
                updateLoadMoreButton();
            }

            function renderSurahs(surahs) {
                surahs.forEach((surah, index) => {
                    const gradientColor = gradients[(surah.nomor - 1) % gradients.length];
                    const isMakkiyah = surah.tempat_turun.toLowerCase() === 'mekah';
                    
                    const card = document.createElement('div');
                    card.className = 'animate-fadeIn transform transition duration-300 hover:-translate-y-1 hover:shadow-xl';
                    card.innerHTML = `
                        <a href="/quran/${surah.nomor}" class="block h-full">
                            <div class="h-full bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-emerald-500 flex flex-col">
                                <div class="p-6 flex-1">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <span class="inline-block ${isMakkiyah ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800'} text-xs px-3 py-1 rounded-full font-medium mb-2">
                                                ${surah.tempat_turun}
                                            </span>
                                            <h3 class="text-xl font-bold text-gray-800 leading-tight">${surah.nama_latin}</h3>
                                            <p class="text-gray-600 text-sm">${surah.arti}</p>
                                        </div>
                                        <div class="bg-gradient-to-br ${gradientColor} text-white w-12 h-12 rounded-lg flex items-center justify-center text-xl font-bold shadow-sm">
                                            ${surah.nomor}
                                        </div>
                                    </div>
                                    
                                    <div class="my-6 text-right rtl text-3xl font-arabic text-gray-800 leading-relaxed">
                                        ${surah.nama}
                                    </div>
                                    
                                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
                                        <div class="text-sm text-gray-500">
                                            <span class="font-medium">${surah.jumlah_ayat} Ayat</span>
                                        </div>
                                        <div class="flex items-center text-emerald-600">
                                            <span class="text-sm mr-2">Baca</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-1.5 bg-gradient-to-r ${gradientColor}"></div>
                            </div>
                        </a>
                    `;
                    
                    surahList.appendChild(card);
                });
            }

            function updateLoadMoreButton() {
                if (displayedSurahs >= filteredSurahs.length) {
                    loadMoreContainer.classList.add('hidden');
                } else {
                    loadMoreContainer.classList.remove('hidden');
                    loadMoreInfo.textContent = `Menampilkan ${displayedSurahs} dari ${filteredSurahs.length} surah`;
                }
            }

            function resetSearch() {
                searchInput.value = '';
                filterSelect.value = 'all';
                filterAndDisplaySurahs();
            }
        });
    </script>

    <style>
        @font-face {
            font-family: 'Scheherazade';
            src: url('https://fonts.gstatic.com/s/scheherazade/v20/YA9Ur0yF4ETZN60keViq1kQgtA.woff2') format('woff2');
            font-display: swap;
        }

        .font-arabic {
            font-family: 'Scheherazade', serif;
            line-height: 1.8;
        }

        .rtl {
            direction: rtl;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.4s ease-out forwards;
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        /* Card hover effect */
        .hover\:-translate-y-1:hover {
            transform: translateY(-0.25rem);
        }
    </style>
@endsection