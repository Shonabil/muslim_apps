@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <!-- Surah Header with Gradient -->
        <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-lg shadow-lg p-6 text-white mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $surah['nama_latin'] }}</h1>
                    <h2 class="text-xl font-arabic mb-3">{{ $surah['nama'] }}</h2>
                    <p class="text-green-100">{{ $surah['arti'] }}</p>
                </div>
                <div class="mt-4 md:mt-0 text-center">
                    <div class="bg-white bg-opacity-20 rounded-lg p-4 backdrop-filter backdrop-blur-sm">
                        <p class="font-medium">Surah ke-{{ $surah['nomor'] }}</p>
                        <p class="text-sm">{{ $surah['jumlah_ayat'] }} Ayat</p>
                        <p class="text-sm mt-1">{{ $surah['tempat_turun'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Controls -->
        <div class="flex justify-between mb-6">
            <a href="{{ url('/dashboard') }}" class="flex items-center text-green-700 hover:text-green-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 010 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar Surah
            </a>

            <div class="flex space-x-3">
                @if($surah['nomor'] > 1)
                    <a href="{{ url('/quran/' . ($surah['nomor'] - 1)) }}" class="text-green-700 hover:text-green-900 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Surah Sebelumnya
                    </a>
                @endif

                @if($surah['nomor'] < 114)
                    <a href="{{ url('/quran/' . ($surah['nomor'] + 1)) }}" class="text-green-700 hover:text-green-900 transition flex items-center">
                        Surah Berikutnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- Last Read Bookmark Banner - Show if it exists -->
        <div id="last-read-banner" class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg shadow-md hidden">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                    <div>
                        <h3 class="font-medium text-gray-800">Terakhir Dibaca</h3>
                        <p id="last-read-info" class="text-gray-600 text-sm"></p>
                    </div>
                </div>
                <div>
                    <button id="goto-last-read" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm transition">
                        Lanjutkan Membaca
                    </button>
                </div>
            </div>
        </div>

        <!-- Settings Controls -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow-md">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center">
                    <label for="font-size" class="text-gray-700 mr-2">Ukuran Font:</label>
                    <select id="font-size" class="rounded border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 text-sm">
                        <option value="text-lg">Normal</option>
                        <option value="text-xl">Besar</option>
                        <option value="text-2xl">Sangat Besar</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <label class="inline-flex items-center text-gray-700">
                        <input type="checkbox" id="toggle-translation" class="rounded border-gray-300 text-green-600 focus:border-green-500 focus:ring focus:ring-green-200" checked>
                        <span class="ml-2">Tampilkan Terjemahan</span>
                    </label>
                </div>

                <div class="flex items-center">
                    <label class="inline-flex items-center text-gray-700">
                        <input type="checkbox" id="toggle-audio" class="rounded border-gray-300 text-green-600 focus:border-green-500 focus:ring focus:ring-green-200" checked>
                        <span class="ml-2">Auto-Play Audio</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Play All Audio Button -->
        <div class="mb-6">
            <button id="play-all-button" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg shadow-md transition flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">Putar Audio Surah</span>
            </button>
        </div>

        <!-- Audio Player -->
        <div id="audio-player-container" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg p-3 hidden">
            <div class="container mx-auto max-w-4xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <button id="audio-play-pause" class="bg-green-600 text-white rounded-full p-2 mr-3 hover:bg-green-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <div class="text-gray-800 font-medium" id="audio-title">Sedang memutar: Surah <span></span> Ayat <span></span></div>
                    </div>
                    <div class="flex items-center flex-grow mx-4">
                        <div id="audio-current-time" class="text-gray-600 text-sm mr-2">0:00</div>
                        <div class="flex-grow bg-gray-200 rounded-full h-2 relative" id="audio-progress-container">
                            <div id="audio-progress" class="bg-green-600 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                        <div id="audio-duration" class="text-gray-600 text-sm ml-2">0:00</div>
                    </div>
                    <button id="audio-close" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Ayat List -->
        <div class="space-y-6" id="ayat-container">
            @foreach($surah['ayat'] as $ayat)
                <div class="bg-white rounded-lg shadow-md overflow-hidden ayat-card" id="ayat-{{ $ayat['nomor'] }}">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center justify-center w-10 h-10 bg-green-100 text-green-800 font-bold rounded-full">
                                {{ $ayat['nomor'] }}
                            </div>
                            <div class="flex space-x-2">
                                <button class="play-audio-btn text-white bg-green-600 hover:bg-green-700 transition p-2 rounded-full shadow-md" data-surah="{{ $surah['nomor'] }}" data-ayat="{{ $ayat['nomor'] }}">
                                    <box-icon type='solid' name='playlist'></box-icon>
                                </button>
                                <button class="text-gray-500 hover:text-green-700 transition bookmark-ayat" data-surah="{{ $surah['nomor'] }}" data-ayat="{{ $ayat['nomor'] }}" data-surah-name="{{ $surah['nama_latin'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="arabic-text text-right leading-loose mb-4 ayat-content" data-surah="{{ $surah['nomor'] }}" data-ayat="{{ $ayat['nomor'] }}">{{ $ayat['ar'] }}</div>

                        <div class="translation-text">
                            <p class="text-gray-700 leading-relaxed mb-2">{{ $ayat['idn'] }}</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-gray-500 text-xs">
                        <span>{{ $surah['nama_latin'] }} - Ayat {{ $ayat['nomor'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Back to Top Button -->
        <div class="fixed bottom-6 right-6">
            <button id="back-to-top" class="bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition transform hover:scale-105 opacity-0 invisible">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    .font-arabic {
        font-family: 'Arial', sans-serif;
    }

    .arabic-text {
        font-size: 28px;
        line-height: 1.8;
    }

    /* Added for highlighting current ayat when playing */
    .ayat-playing {
        background-color: rgba(16, 185, 129, 0.05);
        border-left: 4px solid #10b981;
    }

    /* Added for marking last read ayat */
    .last-read-mark {
        border-left: 4px solid #f59e0b;
        background-color: rgba(245, 158, 11, 0.05);
    }

    /* For filled bookmark icon */
    .bookmark-active svg {
        fill: #f59e0b;
        stroke: #f59e0b;
    }

    /* Adjust spacing for audio player */
    body.audio-player-active {
        padding-bottom: 72px;
    }

    /* Progress bar click interaction */
    #audio-progress-container {
        cursor: pointer;
    }

    /* Play button pulsing animation when playing */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }

    .play-audio-btn.playing {
        animation: pulse 2s infinite;
    }
</style>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Create audio element
    const audioElement = new Audio();
    let currentAyatElement = null;
    let currentAyatNumber = null;
    let currentSurahNumber = null;
    let isPlayingFullSurah = false;

    // Initialize last read bookmark
    checkForLastRead();

    // Font size control
    const fontSizeSelect = document.getElementById('font-size');
    const arabicTexts = document.querySelectorAll('.arabic-text');

    fontSizeSelect.addEventListener('change', function() {
        arabicTexts.forEach(text => {
            // Remove existing text size classes
            text.classList.remove('text-lg', 'text-xl', 'text-2xl');
            // Add selected class
            text.classList.add(this.value);
        });
    });

    // Translation toggle
    const translationToggle = document.getElementById('toggle-translation');
    const translationTexts = document.querySelectorAll('.translation-text');

    translationToggle.addEventListener('change', function() {
        translationTexts.forEach(text => {
            text.style.display = this.checked ? 'block' : 'none';
        });
    });

    // Back to top button
    const backToTopButton = document.getElementById('back-to-top');

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

    // Copy ayat functionality
    const copyButtons = document.querySelectorAll('.copy-ayat');

    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const ayatNumber = this.getAttribute('data-ayat');
            const ayatCard = document.getElementById('ayat-' + ayatNumber);
            const arabicText = ayatCard.querySelector('.arabic-text').textContent;
            const translationText = ayatCard.querySelector('.translation-text p').textContent;

            const textToCopy = `${arabicText}\n\n${translationText}\n\n(Surah ${ayatNumber})`;

            navigator.clipboard.writeText(textToCopy).then(() => {
                // Show success message
                const originalSvg = button.innerHTML;
                button.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                `;

                setTimeout(() => {
                    button.innerHTML = originalSvg;
                }, 2000);
            });
        });
    });

    // Share ayat functionality
    const shareButtons = document.querySelectorAll('.share-ayat');

    shareButtons.forEach(button => {
        button.addEventListener('click', function() {
            const ayatNumber = this.getAttribute('data-ayat');
            const ayatCard = document.getElementById('ayat-' + ayatNumber);
            const arabicText = ayatCard.querySelector('.arabic-text').textContent;
            const translationText = ayatCard.querySelector('.translation-text p').textContent;

            const surahName = '{{ $surah['nama_latin'] }}';

            const textToShare = `${arabicText}\n\n${translationText}\n\n(${surahName} ${ayatNumber})`;

            if (navigator.share) {
                navigator.share({
                    title: `${surahName} Ayat ${ayatNumber}`,
                    text: textToShare,
                    url: window.location.href + '#ayat-' + ayatNumber
                }).catch(err => console.error('Sharing failed:', err));
            } else {
                // Fallback to copying the text to clipboard
                navigator.clipboard.writeText(textToShare).then(() => {
                    const originalSvg = button.innerHTML;
                    button.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    `;

                    setTimeout(() => {
                        button.innerHTML = originalSvg;
                    }, 2000);
                });
            }
        });
    });

    // Audio Playback Functions
    const playButtons = document.querySelectorAll('.play-audio-btn');
    const audioPlayerContainer = document.getElementById('audio-player-container');
    const audioPlayPauseBtn = document.getElementById('audio-play-pause');
    const audioCloseBtn = document.getElementById('audio-close');
    const audioTitle = document.getElementById('audio-title');
    const audioProgress = document.getElementById('audio-progress');
    const audioCurrentTime = document.getElementById('audio-current-time');
    const audioDuration = document.getElementById('audio-duration');
    const autoPlayToggle = document.getElementById('toggle-audio');
    const progressContainer = document.getElementById('audio-progress-container');
    const playAllButton = document.getElementById('play-all-button');

    // Play All button functionality
    playAllButton.addEventListener('click', function() {
        isPlayingFullSurah = true;
        playAudio('{{ $surah['nomor'] }}', 1); // Start playing from the first ayat

        // Change button text to show it's playing
        this.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">Berhenti Memutar</span>
        `;

        // Change button function to stop playing
        this.removeEventListener('click', arguments.callee);
        this.addEventListener('click', function() {
            stopPlayingFullSurah();
        });
    });

    function stopPlayingFullSurah() {
        isPlayingFullSurah = false;
        audioElement.pause();
        updatePlayPauseButton();

        // Reset play all button
        playAllButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">Putar Audio Surah</span>
        `;

        // Reset event listener
        playAllButton.removeEventListener('click', arguments.callee);
        playAllButton.addEventListener('click', function() {
            isPlayingFullSurah = true;
            playAudio('{{ $surah['nomor'] }}', 1);

            this.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">Berhenti Memutar</span>
            `;

            this.removeEventListener('click', arguments.callee);
            this.addEventListener('click', stopPlayingFullSurah);
        });
    }

    // Progress bar interaction
    progressContainer.addEventListener('click', function(e) {
        const rect = this.getBoundingClientRect();
        const clickPosition = (e.clientX - rect.left) / rect.width;

        if (audioElement.duration) {
            audioElement.currentTime = audioElement.duration * clickPosition;
        }
    });

    // Arabic text click also plays audio
    const ayatContents = document.querySelectorAll('.ayat-content');
    ayatContents.forEach(content => {
        content.addEventListener('click', function() {
            const surahNumber = this.getAttribute('data-surah');
            const ayatNumber = this.getAttribute('data-ayat');
            playAudio(surahNumber, ayatNumber);
        });
    });

    // Play audio buttons
    playButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent bubbling to parent

            // Reset all play buttons
            playButtons.forEach(btn => {
                btn.classList.remove('playing');
            });

            // Add playing class to this button
            this.classList.add('playing');

            const surahNumber = this.getAttribute('data-surah');
            const ayatNumber = this.getAttribute('data-ayat');
            playAudio(surahNumber, ayatNumber);
        });
    });

    function playAudio(surahNumber, ayatNumber) {
        // Get URL for audio file from API
        // The API endpoint format is just an example - adjust to your actual API
        const audioUrl = `https://api.alquran.cloud/v1/ayah/${surahNumber}:${ayatNumber}/ar.alafasy`;

        // Update global tracking variables
        currentSurahNumber = surahNumber;
        currentAyatNumber = parseInt(ayatNumber);

        // Remove highlight from previous ayat
        if (currentAyatElement) {
            currentAyatElement.classList.remove('ayat-playing');
        }

        // Highlight current ayat
        currentAyatElement = document.getElementById('ayat-' + ayatNumber);
        currentAyatElement.classList.add('ayat-playing');

        // Scroll to the ayat if not already visible (unless playing full surah automatically)
        if (!isPlayingFullSurah) {
            currentAyatElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Show audio player
        audioPlayerContainer.classList.remove('hidden');
        document.body.classList.add('audio-player-active');

        // Update audio player title
        audioTitle.querySelector('span:first-child').textContent = '{{ $surah['nama_latin'] }}';
        audioTitle.querySelector('span:last-child').textContent = ayatNumber;

        // Fetch audio data
        fetch(audioUrl)
            .then(response => response.json())
            .then(data => {
                // Set audio source and play
                audioElement.src = data.data.audio;
                audioElement.play().catch(error => {
                    console.error("Audio playback failed:", error);
                });
            })
            .catch(error => {
                console.error("Error fetching audio:", error);
            });
    }

    // Audio Element Event Listeners
    audioElement.addEventListener('timeupdate', function() {
        // Update progress bar
        const percentage = (this.currentTime / this.duration) * 100;
        audioProgress.style.width = percentage + '%';

        // Update current time display
        audioCurrentTime.textContent = formatTime(this.currentTime);
    });

    audioElement.addEventListener('loadedmetadata', function() {
        // Update duration display
        audioDuration.textContent = formatTime(this.duration);
    });

    audioElement.addEventListener('ended', function() {
        // If playing full surah, move to next ayat
        if (isPlayingFullSurah && currentAyatNumber < {{ $surah['jumlah_ayat'] }}) {
            playAudio(currentSurahNumber, currentAyatNumber + 1);
        } else if (isPlayingFullSurah) {
            // End of surah reached
            stopPlayingFullSurah();
        } else if (autoPlayToggle.checked) {
            // Auto-play next verse if enabled
            if (currentAyatNumber < {{ $surah['jumlah_ayat'] }}) {
                playAudio(currentSurahNumber, currentAyatNumber + 1);
            }
        } else {
            // Reset play button
            updatePlayPauseButton();
        }
    });

    // Format time to MM:SS
    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }

    // Audio player controls
    audioPlayPauseBtn.addEventListener('click', function() {
        if (audioElement.paused) {
            audioElement.play();
        } else {
            audioElement.pause();
        }
        updatePlayPauseButton();
    });

    audioCloseBtn.addEventListener('click', function() {
        // Close audio player and stop playback
        audioElement.pause();
        audioPlayerContainer.classList.add('hidden');
        document.body.classList.remove('audio-player-active');

        // Reset play all button if it was active
        if (isPlayingFullSurah) {
            stopPlayingFullSurah();
        }

        // Remove playing highlights
        if (currentAyatElement) {
            currentAyatElement.classList.remove('ayat-playing');
        }

        // Reset all play buttons
        playButtons.forEach(btn => {
            btn.classList.remove('playing');
        });
    });

    function updatePlayPauseButton() {
        // Update play/pause button icon based on audio state
        if (audioElement.paused) {
            audioPlayPauseBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `;

            // Reset play button animations
            playButtons.forEach(btn => {
                btn.classList.remove('playing');
            });
        } else {
            audioPlayPauseBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `;

            // Highlight current ayat's play button
            if (currentAyatNumber) {
                const currentPlayBtn = document.querySelector(`.play-audio-btn[data-ayat="${currentAyatNumber}"]`);
                if (currentPlayBtn) {
                    currentPlayBtn.classList.add('playing');
                }
            }
        }
    }

    // ===============================================
    // DATABASE BOOKMARK FUNCTIONALITY - UPDATED CODE
    // ===============================================

    // Bookmark functionality with database storage
    const bookmarkButtons = document.querySelectorAll('.bookmark-ayat');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

    bookmarkButtons.forEach(button => {
        button.addEventListener('click', function() {
            const surahNumber = this.getAttribute('data-surah');
            const ayatNumber = this.getAttribute('data-ayat');
            const surahName = this.getAttribute('data-surah-name');

            // Save bookmark data to database via AJAX
            const bookmarkData = {
                surah_id: surahNumber,
                ayat: ayatNumber,
                surah_name: surahName,
                user_id: userId
            };

            // Send AJAX request to save bookmark
            fetch('/bookmarks/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(bookmarkData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI to show this ayat is bookmarked
                    bookmarkButtons.forEach(btn => btn.classList.remove('bookmark-active'));
                    this.classList.add('bookmark-active');

                    // Remove last-read-mark class from all ayat cards
                    document.querySelectorAll('.ayat-card').forEach(card => {
                        card.classList.remove('last-read-mark');
                    });

                    // Add last-read-mark class to current ayat card
                    const ayatCard = document.getElementById('ayat-' + ayatNumber);
                    ayatCard.classList.add('last-read-mark');

                    // Show a confirmation message
                    showToast('Ayat ditandai sebagai terakhir dibaca');

                    // Update last read banner
                    showLastReadBanner();
                } else {
                    showToast('Gagal menyimpan bookmark: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error saving bookmark:', error);
                showToast('Terjadi kesalahan saat menyimpan bookmark');
            });
        });
    });

    // Check for last read bookmark and update UI
    function checkForLastRead() {
        // Fetch the user's bookmark from the database via AJAX
        fetch('/bookmarks/get', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.bookmark) {
                const bookmarkData = data.bookmark;

                // If the bookmark is for the current surah, highlight it
                if (bookmarkData.surah_id == '{{ $surah['nomor'] }}') {
                    const bookmarkButton = document.querySelector(`.bookmark-ayat[data-ayat="${bookmarkData.ayat}"]`);
                    if (bookmarkButton) {
                        bookmarkButton.classList.add('bookmark-active');
                    }

                    const ayatCard = document.getElementById('ayat-' + bookmarkData.ayat);
                    if (ayatCard) {
                        ayatCard.classList.add('last-read-mark');
                    }

                    // Show last read banner
                    showLastReadBanner();
                }
            }
        })
        .catch(error => {
            console.error('Error fetching bookmark:', error);
        });
    }

    // Show last read banner with current bookmark info
    function showLastReadBanner() {
        // Fetch the user's bookmark from the database via AJAX
        fetch('/bookmarks/get', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.bookmark) {
                const bookmarkData = data.bookmark;

                // If the bookmark is for the current surah
                if (bookmarkData.surah_id == '{{ $surah['nomor'] }}') {
                    const banner = document.getElementById('last-read-banner');
                    const info = document.getElementById('last-read-info');
                    const gotoBtn = document.getElementById('goto-last-read');

                    // Format timestamp to readable date/time
                    const timestamp = new Date(bookmarkData.updated_at);
                    const formattedDate = timestamp.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    // Update banner info
                    info.textContent = `${bookmarkData.surah_name}, Ayat ${bookmarkData.ayat} - ${formattedDate}`;

                    // Show banner
                    banner.classList.remove('hidden');

                    // Set up goto button
                    gotoBtn.addEventListener('click', function() {
                        const ayatCard = document.getElementById('ayat-' + bookmarkData.ayat);
                        if (ayatCard) {
                            ayatCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error fetching bookmark for banner:', error);
        });
    }

    // Toast notification function
    function showToast(message) {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300 opacity-0';
        toast.textContent = message;

        // Add to DOM
        document.body.appendChild(toast);

        // Trigger animation
        setTimeout(() => toast.classList.remove('opacity-0'), 10);

        // Remove after delay
        setTimeout(() => {
            toast.classList.add('opacity-0');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }

    // Handle keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Right arrow key to go to next ayat
        if (e.key === 'ArrowRight' && currentAyatNumber < {{ $surah['jumlah_ayat'] }}) {
            playAudio(currentSurahNumber, currentAyatNumber + 1);
        }

        // Left arrow key to go to previous ayat
        if (e.key === 'ArrowLeft' && currentAyatNumber > 1) {
            playAudio(currentSurahNumber, currentAyatNumber - 1);
        }

        // Space bar to play/pause
        if (e.key === ' ' && e.target === document.body) {
            e.preventDefault(); // Prevent page scrolling
            if (audioElement.paused) {
                audioElement.play();
            } else {
                audioElement.pause();
            }
            updatePlayPauseButton();
        }
    });

    // Intersection Observer to mark ayat as visible
    const ayatObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const ayatId = entry.target.id;
                const ayatNumber = ayatId.split('-')[1];

                // Update current visible ayat for better UX
                if (!isPlayingFullSurah && !audioElement.playing) {
                    currentAyatNumber = parseInt(ayatNumber);
                    currentSurahNumber = '{{ $surah['nomor'] }}';
                }
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.ayat-card').forEach(card => {
        ayatObserver.observe(card);
    });

    if (navigator.share) {
        document.querySelectorAll('.copy-ayat').forEach(button => {
            const shareBtn = document.createElement('button');
            shareBtn.className = 'text-gray-500 hover:text-green-700 transition share-ayat ml-2';
            shareBtn.setAttribute('data-ayat', button.getAttribute('data-ayat'));
            shareBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
            `;
            button.parentNode.appendChild(shareBtn);
        });

        document.querySelectorAll('.share-ayat').forEach(button => {
            button.addEventListener('click', async function() {
                const ayatNumber = this.getAttribute('data-ayat');
                const ayatCard = document.getElementById('ayat-' + ayatNumber);
                const arabicText = ayatCard.querySelector('.arabic-text').textContent;
                const translationText = ayatCard.querySelector('.translation-text p').textContent;

                const surahName = '{{ $surah['nama_latin'] }}';

                try {
                    await navigator.share({
                        title: `${surahName} Ayat ${ayatNumber}`,
                        url: window.location.href + '#ayat-' + ayatNumber
                    });
                } catch (err) {
                    console.error('Share failed:', err);
                }
            });
        });
    }

    window.addEventListener('load', function() {
        const hash = window.location.hash;
        if (hash && hash.startsWith('#ayat-')) {
            const ayatNumber = hash.replace('#ayat-', '');
            const ayatCard = document.getElementById('ayat-' + ayatNumber);
            if (ayatCard) {
                setTimeout(() => {
                    ayatCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 500);
            }
        }
    });

    // End of DOM ready function
});
</script>
@endsection
