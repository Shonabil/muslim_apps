<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Stack for Additional Styles -->
    @stack('styles')

    <!-- Tambahan Style untuk Toast -->
    <style>
        #quran-toast {
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-b from-emerald-50 to-white min-h-screen">
    <div>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow w-full">
                <div class="w-full">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="w-full">
            @yield('content')
        </main>
    </div>

    <!-- Toast Reminder Quran -->
    <div id="quran-toast"
        class="fixed bottom-5 right-5 bg-emerald-600 text-white px-4 py-3 rounded shadow-lg hidden z-50">
        📖 Waktunya membaca Al-Qur'an sebentar yuk!
    </div>

    <!-- Audio Notifikasi -->
    <audio id="quran-audio" src="/sound/sound.chime.mp3" preload="auto"></audio>

    <!-- Stack for Additional Scripts -->
    @stack('scripts')

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"></script>

    <!-- Boxicons CDN -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script>
       function showQuranReminderToast() {
    const toast = document.getElementById('quran-toast');
    const audio = document.getElementById('quran-audio');

    toast.classList.remove('hidden');
    
    audio.play()
        .then(() => console.log('Audio played successfully'))
        .catch(e => {
            console.error('Error playing audio:', e);
            // Cek path audio
            console.log('Trying to load audio from:', audio.src);
            // Force reload audio element
            audio.load();
        });

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 6000); 
}

        // Panggil setiap 10 detik (10000 ms)
        setInterval(showQuranReminderToast, 10000);
    </script>
</body>

</html>
