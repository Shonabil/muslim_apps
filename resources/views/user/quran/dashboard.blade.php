@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 bg-gradient-to-b from-emerald-50 to-white">
        <div class="max-w-5xl mx-auto">
            <!-- Header Section with Gradient Background -->
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-00 rounded-lg shadow-lg mb-8 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold">📖 Daftar Surah Al-Qur'an</h1>
                        <p class="mt-2 opacity-90">Pilih surah untuk melihat ayat-ayatnya</p>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ asset('assets/1234.png') }}" alt="Quran Icon" class="h-16 w-auto" />
                    </div>
                </div>
            </div>

            <!-- Search Bar with Shadow -->
            <div class="mb-8">
                <div class="relative">
                    <input type="text" id="search-surah" placeholder="Cari surah..."
                        class="w-full px-6 py-4 rounded-xl border-2 border-green-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent shadow-md text-lg" />
                    <span class="absolute right-5 top-4 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Loading State -->
            <div id="loading" class="flex justify-center items-center py-16">
                <div class="animate-spin rounded-full h-14 w-14 border-t-4 border-b-4 border-green-700"></div>
                <span class="ml-4 text-lg text-gray-600">Memuat data surah...</span>
            </div>

            <!-- Surah List with Increased Spacing -->
            <div id="surah-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"></div>

            <!-- Load More Button -->
            <div id="load-more-container" class="mt-10 text-center hidden">
                <button id="load-more"
                    class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-md transition-all duration-300 transform hover:scale-105">
                    Surah Selanjutnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <!-- No Results Message -->
            <div id="no-results" class="hidden text-center py-12 text-gray-500 text-lg">
                Tidak ada surah yang sesuai dengan pencarian Anda.
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const surahList = document.getElementById('surah-list');
            const loading = document.getElementById('loading');
            const searchInput = document.getElementById('search-surah');
            const noResults = document.getElementById('no-results');
            const loadMoreBtn = document.getElementById('load-more');
            const loadMoreContainer = document.getElementById('load-more-container');

            let allSurahs = [];
            let displayedSurahs = 0;
            const itemsPerLoad = 9; // Number of surahs to load each time

            // Array of gradient colors for cards
            const gradients = [
                'from-green-400 to-green-600',
                'from-blue-400 to-blue-600',
                'from-purple-400 to-purple-600',
                'from-red-400 to-red-600',
                'from-yellow-400 to-yellow-600',
                'from-indigo-400 to-indigo-600',
                'from-pink-400 to-pink-600',
                'from-teal-400 to-teal-600'
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
                    loadMoreSurahs(allSurahs);

                    // Add event listener for load more button
                    loadMoreBtn.addEventListener('click', function() {
                        loadMoreSurahs(allSurahs);
                    });

                    // Initialize search functionality
                    searchInput.addEventListener('input', function() {
                        const searchTerm = this.value.toLowerCase();
                        const filteredSurahs = allSurahs.filter(surah =>
                            surah.nama_latin.toLowerCase().includes(searchTerm) ||
                            surah.nama.toLowerCase().includes(searchTerm) ||
                            surah.nomor.toString().includes(searchTerm)
                        );

                        // Reset display when searching
                        surahList.innerHTML = '';
                        displayedSurahs = 0;
                        loadMoreSurahs(filteredSurahs);

                        // Show/hide no results message
                        if (filteredSurahs.length === 0) {
                            noResults.classList.remove('hidden');
                            loadMoreContainer.classList.add('hidden');
                        } else {
                            noResults.classList.add('hidden');
                        }
                    });
                })
                .catch(error => {
                    loading.innerHTML = `
                    <div class="text-center text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-lg">Gagal memuat data surah.</p>
                        <button id="retry-btn" class="mt-4 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-md">Coba Lagi</button>
                    </div>
                `;

                    document.getElementById('retry-btn').addEventListener('click', function() {
                        window.location.reload();
                    });

                    console.error('Error fetching data:', error);
                });

            function loadMoreSurahs(surahs) {
                // Get the subset of surahs to display
                const surahs_to_display = surahs.slice(displayedSurahs, displayedSurahs + itemsPerLoad);
                displayedSurahs += surahs_to_display.length;

                // Render the surahs
                renderSurahs(surahs_to_display);

                // Show/hide load more button
                if (displayedSurahs >= surahs.length) {
                    loadMoreContainer.classList.add('hidden');
                } else {
                    loadMoreContainer.classList.remove('hidden');
                }

                // Update the load more button text to show progress
                loadMoreBtn.innerHTML = `
                Surah Selanjutnya (${displayedSurahs}/${surahs.length})
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            `;
            }

            function renderSurahs(surahs) {
                surahs.forEach((surah, index) => {
                    const card = document.createElement('div');
                    card.className =
                        'rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-102 animate-fadeIn';

                    // Select a gradient color based on surah number for consistency
                    const gradientColor = gradients[(surah.nomor - 1) % gradients.length];

                    const link = document.createElement('a');
                    link.href = `/quran/${surah.nomor}`;
                    link.className = 'block h-full';

                    // Determine category badge based on tempat_turun
                    const categoryColor = surah.tempat_turun.toLowerCase() === 'mekah' ? 'bg-amber-500' :
                        'bg-blue-500';

                    link.innerHTML = `
                    <div class="relative h-full bg-white shadow-lg border-t-4 border-green-500">
                        <div class="absolute top-0 right-0 w-16 h-16 flex items-center justify-center bg-gradient-to-br ${gradientColor} text-white font-bold text-xl rounded-bl-xl shadow-md">
                            ${surah.nomor}
                        </div>

                        <div class="p-8">
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-1">${surah.nama_latin}</h2>
                                <p class="text-md text-gray-600 italic">${surah.arti}</p>
                            </div>

                            <div class="text-right rtl text-3xl mb-6 font-arabic text-gray-800">
                                ${surah.nama}
                            </div>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="${categoryColor} text-white px-3 py-1 rounded-full text-sm shadow-sm">
                                    ${surah.tempat_turun}
                                </span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                    ${surah.jumlah_ayat} Ayat
                                </span>
                            </div>
                        </div>

                        <div class="h-2 bg-gradient-to-r ${gradientColor}"></div>
                    </div>
                `;

                    card.appendChild(link);
                    surahList.appendChild(card);
                });
            }
        });
    </script>

    <style>
        @font-face {
            font-family: 'Scheherazade';
            src: url('https://fonts.gstatic.com/s/scheherazade/v20/YA9Ur0yF4ETZN60keViq1kQgtA.woff2') format('woff2');
        }

        .font-arabic {
            font-family: 'Scheherazade', serif;
        }

        .rtl {
            direction: rtl;
        }

        body {
            background-color: #f8f9fa;
        }

        /* Hover animation for cards */
        .hover\:scale-102:hover {
            --tw-scale-x: 1.02;
            --tw-scale-y: 1.02;
        }

        /* Fade-in animation for new cards */
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
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
@endsection
