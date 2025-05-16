@push('styles')
    <style>
        .arabic-text {
            font-family: 'Scheherazade New', 'Amiri', serif;
            font-size: 2rem !important;
            line-height: 2.2 !important;
            direction: rtl !important;
            text-align: right !important;
            color: #0f766e !important;
            margin-bottom: 1rem !important;
        }



        .doa-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 1rem;
            height: 100%;
        }

        .doa-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Enhanced search container */
        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #059669;
            font-size: 1.2rem;
        }

        /* Filter badges */
        .filter-badge {
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .filter-badge:hover {
            background-color: #047857 !important;
            color: white !important;
        }

        /* Hide filtered items */
        .hidden-doa {
            display: none;
        }

        /* Buttons styling */
        .doa-btn {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .doa-btn:hover {
            background-color: #f0fdfa;
        }

        .doa-btn i {
            margin-right: 0.5rem;
        }

        /* Typography improvements */
        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
        }

        /* Copy & Share success notification */
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #10b981;
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 50;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Prayer header decoration */
        .prayer-header {
            position: relative;
            overflow: hidden;
        }

        .prayer-header:before {
            content: "دعاء";
            position: absolute;
            right: -5px;
            top: -15px;
            font-size: 4rem;
            opacity: 0.1;
            font-family: 'Amiri', serif;
            color: white;
        }

        /* Arabic text emphasis */
        .arabic-container {
            background-color: #f0fdfa;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            border: 1px solid #d1fae5;
        }

        .arabic-label {
            position: absolute;
            top: -10px;
            right: 20px;
            background-color: #10b981;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Latin text styling */
        .latin-container {
            background-color: #f8fafc;
            border-radius: 1rem;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
            border: 1px solid #e2e8f0;
            font-style: italic;
            color: #334155;
        }

        /* Button group styling */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background-color: #f0fdfa;
            border-radius: 0 0 0.75rem 0.75rem;
        }
    </style>
@endpush

@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-b from-emerald-50 to-white py-10 min-h-screen">
        <div class="container mx-auto px-4">
            <!-- Hero Section with Arabic Decoration -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-emerald-800 mb-2"> مجموعة من الأدعية اليومية</h1>
                <h2 class="text-3xl font-bold text-emerald-700 mb-3">Kumpulan Doa Harian</h2>
            </div>

            <div class="flex justify-center">
                <div class="w-full lg:w-10/12">
                    <div class="bg-white shadow-xl border border-emerald-200 rounded-xl mb-8 overflow-hidden">
                        <!-- Search Section with Design Improvements -->
                        <div class="p-6 bg-gradient-to-r from-emerald-600 to-emerald-500 border-b border-emerald-400">
                            <div class="search-container mb-4">
                                <i class="bi bi-search search-icon"></i>
                                <input type="text" id="searchInput"
                                    placeholder="Cari doa berdasarkan judul, arti, atau bacaan..."
                                    class="w-full p-4 pl-12 border-2 border-emerald-300 rounded-lg focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition-all text-emerald-800 bg-white" />
                            </div>

                            <!-- Search Results Info -->
                            <div class="mt-3 text-sm text-white hidden" id="searchResults">
                                <span id="resultCount">0</span> doa ditemukan
                            </div>
                        </div>

                        <div class="p-6">
                            @if (!empty($message))
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm mb-6"
                                    role="alert">
                                    <div class="flex">
                                        <div class="py-1"><i
                                                class="bi bi-exclamation-triangle-fill text-red-500 mr-3"></i></div>
                                        <div>
                                            <p>{{ $message }}</p>
                                        </div>
                                        <button type="button" class="ml-auto"
                                            onclick="this.parentElement.parentElement.remove()">
                                            <i class="bi bi-x-lg text-red-500"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($doas))
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6" id="doaContainer">
                                    @foreach ($doas as $index => $doa)
                                        <div class="bg-white border border-emerald-200 shadow-md rounded-xl doa-card flex flex-col justify-between overflow-hidden"
                                            data-title="{{ strtolower($doa['judul']) }}"
                                            data-translation="{{ strtolower($doa['terjemah']) }}"
                                            data-category="{{ isset($doa['kategori']) ? strtolower($doa['kategori']) : 'umum' }}">

                                            <div
                                                class="prayer-header bg-gradient-to-r from-emerald-600 to-emerald-500 p-4 border-b border-emerald-300 flex justify-between items-center">
                                                <h3 class="card-title">{{ $doa['judul'] }}</h3>
                                                <span
                                                    class="bg-white text-emerald-600 font-bold text-sm rounded-full w-8 h-8 flex items-center justify-center shadow-md">{{ $index + 1 }}</span>
                                            </div>

                                            <div class="p-5 flex-1 bg-white">
                                                <!-- Arabic Text Section - Enhanced prominence -->
                                                <div class="arabic-container">
                                                    <span class="arabic-label">الدعاء</span>
                                                    <p class="arabic-text">{{ $doa['arab'] }}</p>
                                                </div>

                                                <!-- Latin Transliteration -->
                                                <div class="latin-container">
                                                    <p class="text-emerald-800">{{ $doa['latin'] }}</p>
                                                </div>

                                                <!-- Translation -->
                                                <div class="mt-4 pt-4 border-t border-emerald-100">
                                                    <p class="text-gray-700"><strong
                                                            class="text-emerald-700">Artinya:</strong>
                                                        {{ $doa['terjemah'] }}</p>
                                                </div>
                                            </div>

                                            <div class="action-buttons">
                                                <button class="doa-btn text-emerald-600 hover:text-emerald-800"
                                                    onclick="copyToClipboard('{{ addslashes($doa['arab']) }}', 'arab')">
                                                    <i class="bi bi-clipboard"></i> Salin Arab
                                                </button>

                                                <button class="doa-btn text-emerald-600 hover:text-emerald-800"
                                                    onclick="shareDoa('{{ addslashes($doa['judul']) }}', '{{ addslashes($doa['arab']) }}', '{{ addslashes($doa['terjemah']) }}')">
                                                    <i class="bi bi-share"></i> Bagikan
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- No Search Results -->
                                <div id="noResults" class="hidden text-center py-16">
                                    <svg class="w-16 h-16 mx-auto text-emerald-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <p class="mt-4 text-lg text-gray-600">Tidak ada doa yang sesuai dengan pencarian Anda
                                    </p>
                                    <button id="resetSearch"
                                        class="mt-3 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">Reset
                                        Pencarian</button>
                                </div>
                            @else
                                <div class="text-center py-20">
                                    <svg class="w-20 h-20 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p class="mt-6 text-xl text-gray-600">Tidak ada data doa yang tersedia.</p>
                                    <p class="mt-2 text-gray-500">Silakan coba lagi nanti atau hubungi administrator.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast notification -->
        <div class="notification" id="notification">
            <div class="flex items-center">
                <i class="bi bi-check-circle-fill mr-2"></i>
                <span id="notificationText">Teks berhasil disalin!</span>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const doaCards = document.querySelectorAll('.doa-card');
                const noResults = document.getElementById('noResults');
                const resetSearchBtn = document.getElementById('resetSearch');
                const searchResults = document.getElementById('searchResults');
                const resultCount = document.getElementById('resultCount');
                const filterBadges = document.querySelectorAll('.filter-badge');
                const notification = document.getElementById('notification');
                const notificationText = document.getElementById('notificationText');
                let activeFilter = 'all';

                // Fungsi pencarian dengan peningkatan
                function performSearch() {
                    const searchTerm = searchInput.value.toLowerCase().trim();
                    let visibleCount = 0;

                    doaCards.forEach(card => {
                        const title = card.getAttribute('data-title');
                        const translation = card.getAttribute('data-translation');
                        const category = card.getAttribute('data-category');

                        // Memeriksa apakah kartu cocok dengan pencarian dan filter
                        const matchesSearch = searchTerm === '' ||
                            title.includes(searchTerm) ||
                            translation.includes(searchTerm);

                        const matchesFilter = activeFilter === 'all' || category === activeFilter;

                        if (matchesSearch && matchesFilter) {
                            card.classList.remove('hidden-doa');
                            visibleCount++;
                        } else {
                            card.classList.add('hidden-doa');
                        }
                    });

                    // Update hasil
                    resultCount.textContent = visibleCount;
                    searchResults.classList.toggle('hidden', searchTerm === '' && activeFilter === 'all');

                    // Tampilkan pesan tidak ada hasil jika perlu
                    if (visibleCount === 0) {
                        noResults.classList.remove('hidden');
                    } else {
                        noResults.classList.add('hidden');
                    }
                }

                // Event untuk input pencarian dengan delay untuk performance
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(performSearch, 300);
                });

                // Event untuk reset pencarian
                if (resetSearchBtn) {
                    resetSearchBtn.addEventListener('click', function() {
                        searchInput.value = '';
                        activeFilter = 'all';

                        // Reset tampilan filter
                        filterBadges.forEach(badge => {
                            if (badge.getAttribute('data-filter') === 'all') {
                                badge.classList.remove('bg-emerald-100', 'text-emerald-800');
                                badge.classList.add('bg-emerald-600', 'text-white');
                            } else {
                                badge.classList.remove('bg-emerald-600', 'text-white');
                                badge.classList.add('bg-emerald-100', 'text-emerald-800');
                            }
                        });

                        performSearch();
                    });
                }

                // Event untuk filter kategori
                filterBadges.forEach(badge => {
                    badge.addEventListener('click', function() {
                        const filter = this.getAttribute('data-filter');
                        activeFilter = filter;

                        // Update tampilan filter
                        filterBadges.forEach(b => {
                            if (b === this) {
                                b.classList.remove('bg-emerald-100', 'text-emerald-800');
                                b.classList.add('bg-emerald-600', 'text-white');
                            } else {
                                b.classList.remove('bg-emerald-600', 'text-white');
                                b.classList.add('bg-emerald-100', 'text-emerald-800');
                            }
                        });

                        performSearch();
                    });
                });

                // Fungsi untuk menampilkan notifikasi
                function showNotification(message) {
                    notificationText.textContent = message;
                    notification.classList.add('show');

                    setTimeout(() => {
                        notification.classList.remove('show');
                    }, 3000);
                }

                // Fungsi untuk menyalin teks ke clipboard dengan peningkatan
                window.copyToClipboard = function(text, type) {
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);

                    // Tampilkan pesan sukses dengan toast notification
                    let message = 'Teks berhasil disalin!';
                    if (type === 'arab') {
                        message = 'Teks Arab berhasil disalin!';
                    } else if (type === 'latin') {
                        message = 'Teks Latin berhasil disalin!';
                    }

                    showNotification(message);
                };

                // Fungsi untuk berbagi doa dengan peningkatan
                window.shareDoa = function(title, arabic, translation) {
                    if (navigator.share) {
                        navigator.share({
                                title: 'Doa: ' + title,
                                text: `${title}\n\n${arabic}\n\n${translation}`,
                            })
                            .then(() => {
                                showNotification('Doa berhasil dibagikan!');
                            })
                            .catch(error => {
                                console.log('Error sharing:', error);
                                // Fallback jika error
                                copyToClipboard(`${title}\n\n${arabic}\n\n${translation}`);
                                showNotification('Teks doa berhasil disalin! Anda dapat membagikannya.');
                            });
                    } else {
                        // Fallback untuk browser yang tidak mendukung Web Share API
                        copyToClipboard(`${title}\n\n${arabic}\n\n${translation}`);
                        showNotification('Teks doa berhasil disalin! Anda dapat membagikannya.');
                    }
                };

                // Animasi pada scroll untuk cards
                const animateCards = () => {
                    doaCards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('animated');
                        }, 100 * index);
                    });
                };

                // Run animation on page load
                animateCards();
            });
        </script>
    @endpush
@endsection
