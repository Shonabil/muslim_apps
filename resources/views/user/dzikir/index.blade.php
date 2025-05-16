@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-emerald-50 to-white min-h-screen">
    <!-- Header dengan ornamen Islam -->
    <div class="relative pt-8 pb-4">
        <div class="absolute inset-0 flex justify-center">
            <div class="w-full max-w-5xl h-24 bg-contain bg-center bg-no-repeat opacity-10"
                 style="background-image: url('/images/islamic-ornament.png')">
            </div>
        </div>
        <div class="relative z-10">
            <h1 class="text-4xl font-bold text-emerald-800 mb-2 text-center font-arabic"> مجموعة من الأذكار</h1>
            <h2 class="text-2xl text-emerald-600 text-center">Kumpulan Dzikir</h2>
            <div class="flex justify-center mt-4">
                <div class="h-1 w-36 bg-emerald-600 rounded"></div>
            </div>
        </div>
    </div>

    <!-- Search bar -->
    <div class="max-w-md mx-auto px-4 mb-8">
        <div class="relative">
            <input type="text" placeholder="Cari dzikir..."
                   class="w-full pl-4 pr-10 py-3 rounded-full border-2 border-emerald-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
            <button class="absolute right-3 top-3 text-emerald-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Kartu-kartu Dzikir -->
    <div class="max-w-6xl mx-auto px-6 mb-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($dzikirs as $dzikir)
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                    <!-- Header kartu dengan warna gradien -->
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-700 p-4">
                        <h2 class="text-xl font-semibold text-white">{{ $dzikir->title }}</h2>
                    </div>

                    <!-- Konten dzikir dengan styl Arab -->
                    <div class="p-6">
                        @if($dzikir->arabic)
                            <p class="text-right text-xl mb-3 font-arabic leading-loose text-gray-800">{{ $dzikir->arabic }}</p>
                            <div class="h-px bg-gray-200 my-3"></div>
                        @endif

                        <p class="text-gray-600 mb-4">{{ Str::limit($dzikir->content, 100) }}</p>

                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('user.dzikir.show', $dzikir->id) }}"
                               class="text-white bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded-lg transition flex items-center">
                                <span>Baca Selengkapnya</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>

                            <button class="text-emerald-600 hover:text-emerald-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16">
                    <div class="inline-block p-4 rounded-full bg-emerald-100 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <p class="text-xl text-gray-500">Belum ada dzikir yang tersedia.</p>
                    <p class="text-gray-400 mt-2">Silakan kembali nanti untuk melihat konten dzikir.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Navigasi pagination dengan styling khusus - hanya tampil jika ada data -->
    @if(count($dzikirs) > 0)
        <div class="flex justify-center mb-12">
            <nav>
                <ul class="flex space-x-2">
                    <li>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-emerald-200 text-emerald-600 hover:bg-emerald-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li><a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-emerald-600 text-white">1</a></li>
                    <li><a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-emerald-600 border border-emerald-200 hover:bg-emerald-50">2</a></li>
                    <li><a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-emerald-600 border border-emerald-200 hover:bg-emerald-50">3</a></li>
                    <li>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-emerald-200 text-emerald-600 hover:bg-emerald-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    @endif

    <!-- Footer ornamen Islam -->
    <div class="w-full h-16 bg-contain bg-center bg-no-repeat opacity-10 mx-auto"
         style="background-image: url('/images/islamic-footer-ornament.png')">
    </div>
</div>
@endsection

@push('styles')
<style>
    .font-arabic {
        font-family: 'Scheherazade New', 'Amiri', serif;
    }
</style>
@endpush
