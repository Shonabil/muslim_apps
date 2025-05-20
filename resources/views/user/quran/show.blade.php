@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">
    <!-- Notification Toast -->
    <div id="notification-toast" class="fixed top-4 right-4 z-50 transform transition-transform duration-300 translate-x-full">
        <div class="bg-white rounded-lg shadow-lg border-l-4 border-emerald-500 px-4 py-3 flex items-start max-w-md">
            <div id="notification-icon" class="mr-3 text-emerald-500">
                <!-- Icon will be inserted here -->
            </div>
            <div class="flex-1">
                <h4 id="notification-title" class="font-semibold text-gray-800"></h4>
                <p id="notification-message" class="text-sm text-gray-600 mt-1"></p>
            </div>
            <button onclick="hideNotification()" class="ml-4 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Header dengan detail surat -->
    <div class="bg-white shadow-md rounded-xl p-6 mb-6 border-t-4 border-emerald-500">
        <div class="flex flex-col md:flex-row justify-between items-start">
            <div>
                <div class="flex items-center">
                    <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $surah['nama_latin'] }}</h2>
                    <span class="ml-3 text-xl font-arab text-emerald-600">{{ $surah['nama'] }}</span>
                </div>
                <p class="text-gray-600 mb-1 text-lg">{{ $surah['arti'] }}</p>
                <div class="flex flex-wrap gap-3 mt-2">
                    <div class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                        Ayat: {{ $surah['jumlah_ayat'] }}
                    </div>
                    <div class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ ucfirst($surah['tempat_turun']) }}
                    </div>
                    <div class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        No. {{ $surah['nomor'] }}
                    </div>
                </div>
            </div>

            <!-- Navigasi surat -->
            <div class="flex space-x-2 mt-4 md:mt-0">
                @if($surah['nomor'] > 1)
                <a href="{{ route('user.quran.show', $surah['nomor'] - 1) }}"
                   class="bg-white border border-emerald-500 text-emerald-700 px-4 py-2 rounded-lg hover:bg-emerald-50 transition flex items-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Surat Sebelumnya
                </a>
                @endif

                @if($surah['nomor'] < 114)
                <a href="{{ route('user.quran.show', $surah['nomor'] + 1) }}"
                   class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition flex items-center shadow-sm">
                    Surat Selanjutnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                @endif
            </div>
        </div>

        <div class="mt-6 text-gray-600 mb-3 bg-gray-50 p-4 rounded-lg border-l-4 border-emerald-300 text-sm leading-relaxed">
            {!! $surah['deskripsi'] !!}
        </div>

        @if(isset($surah['audio']))
        <div class="mt-4 p-4 bg-emerald-50 rounded-lg border border-emerald-100">
            <h3 class="text-lg font-semibold mb-2 flex items-center text-emerald-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>
                Audio Lengkap Surat
            </h3>
            <div class="relative">
                <audio controls class="w-full h-10 rounded">
                    <source src="{{ $surah['audio'] }}" type="audio/mpeg">
                    Browser Anda tidak mendukung pemutar audio.
                </audio>
            </div>
        </div>
        @endif
    </div>

    <!-- Pengaturan Tampilan -->
    <div class="bg-white shadow-md rounded-xl p-5 mb-6 border-l-4 border-emerald-500">
        <h3 class="text-lg font-semibold mb-3 text-gray-800">Pengaturan Tampilan</h3>
        <div class="flex flex-wrap items-center justify-between gap-y-3">
            <div class="flex items-center mr-6">
                <label class="inline-flex items-center cursor-pointer mr-4">
                    <input type="checkbox" id="toggleTerjemahan" class="sr-only peer" checked>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan Terjemahan</span>
                </label>

              
            </div>

            <div class="flex items-center">
                <button id="jumpToAyat" class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-lg hover:bg-emerald-200 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari Ayat
                </button>
            </div>
        </div>
    </div>

    <!-- Daftar Ayat -->
    <div class="space-y-6" id="ayat-container">
        @foreach ($ayat as $a)
            <div class="bg-white shadow-md rounded-xl p-5 relative group hover:border-emerald-300 transition border border-gray-100" id="ayat-{{ $a['nomor'] }}">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-sm bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-lg font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                        Ayat {{ $a['nomor'] }}
                    </div>
                    <div class="flex space-x-1">
                        <button class="play-ayat-btn text-emerald-600 hover:text-emerald-800 p-2 rounded-full hover:bg-emerald-100 transition"
                                data-audio="{{ $a['audio'] ?? '' }}"
                                data-ayat="{{ $a['nomor'] }}"
                                title="Putar Audio">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button class="bookmark-btn text-emerald-600 hover:text-emerald-800 p-2 rounded-full hover:bg-emerald-100 transition"
                                data-surah="{{ $surah['nomor'] }}"
                                data-ayat="{{ $a['nomor'] }}"
                                data-surat-name="{{ $surah['nama_latin'] }}"
                                title="Bookmark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                        <button class="share-btn text-emerald-600 hover:text-emerald-800 p-2 rounded-full hover:bg-emerald-100 transition"
                                data-surah="{{ $surah['nomor'] }}"
                                data-ayat="{{ $a['nomor'] }}"
                                data-surat-name="{{ $surah['nama_latin'] }}"
                                title="Bagikan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="text-right text-3xl font-arab leading-loose my-5 text-gray-800">{{ $a['ar'] }}</div>

                <div class="terjemahan-container border-t pt-4 mt-4">
                    <div class="text-gray-700 leading-relaxed">{{ $a['idn'] }}</div>
                </div>

                <!-- Progress Bar untuk Audio (tersembunyi secara default) -->
                <div class="audio-progress-container hidden mt-3">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="audio-progress-bar bg-emerald-600 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-6 right-6 bg-emerald-600 text-white p-3 rounded-full shadow-lg hover:bg-emerald-700 transition-all opacity-0 invisible">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
</div>

<!-- Modal Bookmark -->
<div id="bookmarkModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-md w-full p-6 transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Bookmark</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" id="closeModal">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mb-5" id="modalContent">
            <!-- Content will be inserted here -->
        </div>
        <div class="flex justify-end">
            <button type="button" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700" id="confirmModal">
                OK
            </button>
        </div>
    </div>
</div>

<!-- Jump to Ayat Modal -->
<div id="jumpToAyatModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg max-w-sm w-full p-6 transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Cari Ayat</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" id="closeJumpModal">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mb-4">
            <label for="ayatNumber" class="block text-sm font-medium text-gray-700 mb-1">Nomor Ayat</label>
            <input type="number" id="ayatNumber" min="1" max="{{ $surah['jumlah_ayat'] }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <p class="mt-1 text-sm text-gray-500">Masukkan nomor ayat antara 1 - {{ $surah['jumlah_ayat'] }}</p>
        </div>
        <div class="flex justify-end">
            <button type="button" class="mr-2 bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300" id="cancelJumpModal">
                Batal
            </button>
            <button type="button" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700" id="confirmJumpModal">
                Cari
            </button>
        </div>
    </div>
</div>

<!-- Audio Player for Ayat -->
<audio id="ayat-player" class="hidden"></audio>

<script>
    // Notification System
    function showNotification(type, title, message, duration = 3000) {
        const toast = document.getElementById('notification-toast');
        const titleEl = document.getElementById('notification-title');
        const messageEl = document.getElementById('notification-message');
        const iconEl = document.getElementById('notification-icon');

        titleEl.textContent = title;
        messageEl.textContent = message;

        // Set border color based on type
        toast.querySelector('div').className = toast.querySelector('div').className.replace(/border-\w+-\d+/, '');

        // Set icon and colors based on type
        if (type === 'success') {
            toast.querySelector('div').classList.add('border-emerald-500');
            iconEl.className = 'mr-3 text-emerald-500';
            iconEl.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `;
        } else if (type === 'error') {
            toast.querySelector('div').classList.add('border-red-500');
            iconEl.className = 'mr-3 text-red-500';
            iconEl.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `;
        } else if (type === 'info') {
            toast.querySelector('div').classList.add('border-blue-500');
            iconEl.className = 'mr-3 text-blue-500';
            iconEl.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `;
        }

        // Show notification
        toast.classList.remove('translate-x-full');
        toast.classList.add('translate-x-0');

        // Hide after duration
        if (duration) {
            setTimeout(hideNotification, duration);
        }
    }

    function hideNotification() {
        const toast = document.getElementById('notification-toast');
        toast.classList.remove('translate-x-0');
        toast.classList.add('translate-x-full');
    }

    // Toggle Terjemahan
    document.getElementById('toggleTerjemahan').addEventListener('change', function() {
        const terjemahanContainers = document.querySelectorAll('.terjemahan-container');
        terjemahanContainers.forEach(container => {
            if (this.checked) {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        });

        showNotification('info', 'Pengaturan', this.checked ? 'Terjemahan ditampilkan' : 'Terjemahan disembunyikan');
    });

    // Modal Functionality
    const modal = document.getElementById('bookmarkModal');
    const closeModal = document.getElementById('closeModal');
    const confirmModal = document.getElementById('confirmModal');
    const modalContent = document.getElementById('modalContent');
    const modalTitle = document.getElementById('modalTitle');

    function showModal(title, content) {
        modalTitle.textContent = title;
        modalContent.innerHTML = content;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hideModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    closeModal.addEventListener('click', hideModal);
    confirmModal.addEventListener('click', hideModal);

    // Click outside to close
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideModal();
        }
    });

    // Bookmark Functionality
    document.querySelectorAll('.bookmark-btn').forEach(button => {
        button.addEventListener('click', function() {
            const surah = this.dataset.surah;
            const ayat = this.dataset.ayat;
            const suratName = this.dataset.suratName;

            fetch("{{ route('quran.bookmark') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    surah_number: surah,
                    ayat_number: ayat
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    showNotification('success', 'Bookmark Berhasil', `Surah ${suratName} ayat ${ayat} berhasil ditambahkan ke bookmark`);
                } else {
                    showNotification('error', 'Terjadi Kesalahan', 'Gagal menambahkan bookmark');
                    console.log(data.errors);
                }
            });
        });
    });

    // Share Button Functionality
    document.querySelectorAll('.share-btn').forEach(button => {
        button.addEventListener('click', function() {
            const surah = this.dataset.surah;
            const ayat = this.dataset.ayat;
            const suratName = this.dataset.suratName;

            // Create share URL (modify as needed to match your site URLs)
            const shareUrl = `${window.location.origin}/quran/${surah}?ayat=${ayat}`;

            if (navigator.share) {
                navigator.share({
                    title: `${suratName} ayat ${ayat}`,
                    text: `Baca Surah ${suratName} ayat ${ayat}`,
                    url: shareUrl
                })
                .then(() => showNotification('success', 'Bagikan', 'Berhasil membagikan ayat'))
                .catch(error => console.log('Error sharing:', error));
            } else {
                // Fallback - copy to clipboard
                navigator.clipboard.writeText(shareUrl)
                    .then(() => {
                        showNotification('success', 'Link Disalin', 'URL ayat telah disalin ke clipboard');
                    })
                    .catch(err => {
                        showNotification('error', 'Gagal Menyalin', 'Tidak dapat menyalin URL ke clipboard');
                    });
            }
        });
    });

    // Jump to Ayat Functionality
    const jumpToAyatModal = document.getElementById('jumpToAyatModal');
    const jumpToAyatBtn = document.getElementById('jumpToAyat');
    const closeJumpModal = document.getElementById('closeJumpModal');
    const cancelJumpModal = document.getElementById('cancelJumpModal');
    const confirmJumpModal = document.getElementById('confirmJumpModal');
    const ayatNumberInput = document.getElementById('ayatNumber');

    jumpToAyatBtn.addEventListener('click', function() {
        jumpToAyatModal.classList.remove('hidden');
        ayatNumberInput.focus();
    });

    function closeJumpToAyatModal() {
        jumpToAyatModal.classList.add('hidden');
    }

    closeJumpModal.addEventListener('click', closeJumpToAyatModal);
    cancelJumpModal.addEventListener('click', closeJumpToAyatModal);

    jumpToAyatModal.addEventListener('click', function(e) {
        if (e.target === jumpToAyatModal) {
            closeJumpToAyatModal();
        }
    });

   // Continuing from where the script was cut off...

confirmJumpModal.addEventListener('click', function() {
    const ayatNumber = parseInt(ayatNumberInput.value);
    const maxAyat = parseInt(document.querySelector('input#ayatNumber').getAttribute('max'));

    if (ayatNumber && ayatNumber > 0 && ayatNumber <= maxAyat) {
        const targetElement = document.getElementById(`ayat-${ayatNumber}`);
        if (targetElement) {
            closeJumpToAyatModal();

            // Scroll to the target ayat with a smooth effect
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: 'smooth'
            });

            // Highlight the ayat briefly
            targetElement.classList.add('ring-2', 'ring-emerald-500', 'ring-opacity-50');
            setTimeout(() => {
                targetElement.classList.remove('ring-2', 'ring-emerald-500', 'ring-opacity-50');
            }, 2000);
        }
    } else {
        showNotification('error', 'Nomor Ayat Tidak Valid', `Silakan masukkan nomor ayat antara 1 dan ${maxAyat}`);
    }
});

// Audio player functionality
const ayatPlayer = document.getElementById('ayat-player');
let currentPlayingBtn = null;
let currentAyatNumber = null;
let continuousPlay = false;

// Continuous play toggle
document.getElementById('toggleContinuousPlay').addEventListener('change', function() {
    continuousPlay = this.checked;
    showNotification('info', 'Pengaturan', continuousPlay ? 'Putar berurutan diaktifkan' : 'Putar berurutan dinonaktifkan');
});

// Handle audio playing for each ayat
document.querySelectorAll('.play-ayat-btn').forEach(button => {
    button.addEventListener('click', function() {
        const audioSrc = this.dataset.audio;
        const ayatNumber = parseInt(this.dataset.ayat);

        if (!audioSrc) {
            showNotification('error', 'Audio Tidak Tersedia', 'Audio untuk ayat ini tidak tersedia');
            return;
        }

        // If already playing this ayat, pause it
        if (currentPlayingBtn === this && !ayatPlayer.paused) {
            ayatPlayer.pause();
            resetPlayButton(this);
            hideProgressBar(ayatNumber);
            return;
        }

        // If playing a different ayat, reset the previous one
        if (currentPlayingBtn && currentPlayingBtn !== this) {
            resetPlayButton(currentPlayingBtn);
            if (currentAyatNumber) {
                hideProgressBar(currentAyatNumber);
            }
        }

        // Set current playing button and ayat number
        currentPlayingBtn = this;
        currentAyatNumber = ayatNumber;

        // Update button to pause icon
        this.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        `;

        // Show progress bar
        showProgressBar(ayatNumber);

        // Play audio
        ayatPlayer.src = audioSrc;
        ayatPlayer.play();
    });
});

// Audio player event listeners
ayatPlayer.addEventListener('ended', function() {
    if (currentPlayingBtn) {
        resetPlayButton(currentPlayingBtn);
        hideProgressBar(currentAyatNumber);

        // If continuous play is enabled, play the next ayat
        if (continuousPlay && currentAyatNumber) {
            const nextAyatNumber = currentAyatNumber + 1;
            const nextButton = document.querySelector(`.play-ayat-btn[data-ayat="${nextAyatNumber}"]`);
            if (nextButton) {
                setTimeout(() => {
                    nextButton.click();
                }, 500);
            }
        }
    }
});

ayatPlayer.addEventListener('timeupdate', function() {
    if (currentAyatNumber) {
        updateProgressBar(currentAyatNumber);
    }
});

function resetPlayButton(button) {
    if (button) {
        button.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        `;
    }
}

function showProgressBar(ayatNumber) {
    const ayatElement = document.getElementById(`ayat-${ayatNumber}`);
    if (ayatElement) {
        const progressContainer = ayatElement.querySelector('.audio-progress-container');
        if (progressContainer) {
            progressContainer.classList.remove('hidden');
        }
    }
}

function hideProgressBar(ayatNumber) {
    const ayatElement = document.getElementById(`ayat-${ayatNumber}`);
    if (ayatElement) {
        const progressContainer = ayatElement.querySelector('.audio-progress-container');
        if (progressContainer) {
            progressContainer.classList.add('hidden');
        }
    }
}

function updateProgressBar(ayatNumber) {
    const ayatElement = document.getElementById(`ayat-${ayatNumber}`);
    if (ayatElement) {
        const progressBar = ayatElement.querySelector('.audio-progress-bar');
        if (progressBar) {
            const progress = (ayatPlayer.currentTime / ayatPlayer.duration) * 100;
            progressBar.style.width = `${progress}%`;
        }
    }
}

// Back to Top Button
const backToTopButton = document.getElementById('backToTop');

window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
        backToTopButton.classList.remove('opacity-0', 'invisible');
        backToTopButton.classList.add('opacity-100', 'visible');
    } else {
        backToTopButton.classList.remove('opacity-100', 'visible');
        backToTopButton.classList.add('opacity-0', 'invisible');
    }
});

backToTopButton.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Check for ayat parameter in URL and scroll to it if present
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const ayatParam = urlParams.get('ayat');

    if (ayatParam) {
        const ayatNumber = parseInt(ayatParam);
        const targetElement = document.getElementById(`ayat-${ayatNumber}`);

        if (targetElement) {
            // Give some time for the page to fully load
            setTimeout(() => {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });

                // Highlight the ayat briefly
                targetElement.classList.add('ring-2', 'ring-emerald-500', 'ring-opacity-50');
                setTimeout(() => {
                    targetElement.classList.remove('ring-2', 'ring-emerald-500', 'ring-opacity-50');
                }, 2000);
            }, 500);
        }
    }
});

// Handle keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Jump to ayat modal (Alt+J)
    if (e.altKey && e.key === 'j') {
        e.preventDefault();
        jumpToAyatBtn.click();
    }

    // Toggle translation (Alt+T)
    if (e.altKey && e.key === 't') {
        e.preventDefault();
        const translationToggle = document.getElementById('toggleTerjemahan');
        translationToggle.checked = !translationToggle.checked;
        translationToggle.dispatchEvent(new Event('change'));
    }

    // Toggle continuous play (Alt+C)
    if (e.altKey && e.key === 'c') {
        e.preventDefault();
        const continuousPlayToggle = document.getElementById('toggleContinuousPlay');
        continuousPlayToggle.checked = !continuousPlayToggle.checked;
        continuousPlayToggle.dispatchEvent(new Event('change'));
    }
});

// Preload next and previous surah data for faster navigation
if (document.readyState === 'complete' || document.readyState === 'interactive') {
    preloadAdjacentSurahs();
} else {
    document.addEventListener('DOMContentLoaded', preloadAdjacentSurahs);
}

function preloadAdjacentSurahs() {
    const currentSurahNumber = {{ $surah['nomor'] ?? 'null' }};

    if (currentSurahNumber) {
        // Preload next surah if exists
        if (currentSurahNumber < 114) {
            const nextSurahLink = document.createElement('link');
            nextSurahLink.rel = 'prefetch';
            nextSurahLink.href = `/quran/${currentSurahNumber + 1}`;
            document.head.appendChild(nextSurahLink);
        }

        // Preload previous surah if exists
        if (currentSurahNumber > 1) {
            const prevSurahLink = document.createElement('link');
            prevSurahLink.rel = 'prefetch';
            prevSurahLink.href = `/quran/${currentSurahNumber - 1}`;
            document.head.appendChild(prevSurahLink);
        }
    }
}
</script>
