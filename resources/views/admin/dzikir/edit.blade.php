@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-0 bg-white shadow-xl rounded-2xl mt-8 overflow-hidden">
    <!-- Header with gradient background -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-700 p-6 sm:p-8">
        <h2 class="text-3xl font-extrabold text-white mb-2">Edit Dzikir</h2>
        <p class="text-blue-100 text-sm">Perbarui konten dzikir dengan informasi terbaru</p>
    </div>

    <div class="p-6 sm:p-8">
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg animate-pulse">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold">Terdapat beberapa kesalahan:</span>
                </div>
                <ul class="list-disc pl-10 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dzikir.update', $dzikir->id) }}" method="POST" class="space-y-7">
            @csrf
            @method('PUT')
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Informasi Dasar</h3>
                </div>
                <div class="p-6">
                    <div>
                        <label for="title" class="block font-medium text-gray-700 mb-2">Judul Dzikir</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $dzikir->title) }}"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300"
                            required
                            placeholder="Masukkan judul dzikir"
                        >
                    </div>

                    <div class="mt-5">
                        <label for="content" class="block font-medium text-gray-700 mb-2">Deskripsi / Konten Dzikir</label>
                        <textarea
                            name="content"
                            id="content"
                            rows="4"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300"
                            required
                            placeholder="Masukkan konten lengkap dzikir"
                        >{{ old('content', $dzikir->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Card for Arabic text and translations -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Teks & Terjemahan</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label for="arabic_text" class="block font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                </svg>
                                Teks Arab
                            </span>
                        </label>
                        <div class="relative">
                            <textarea
                                name="arabic_text"
                                id="arabic_text"
                                rows="3"
                                dir="rtl"
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 text-right text-lg"
                                placeholder="أدخل النص العربي هنا"
                            >{{ old('arabic_text', $dzikir->arabic_text) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="latin_translation" class="block font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                </svg>
                                Transliterasi Latin
                            </span>
                        </label>
                        <textarea
                            name="latin_translation"
                            id="latin_translation"
                            rows="2"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan transliterasi latin"
                        >{{ old('latin_translation', $dzikir->latin_translation) }}</textarea>
                    </div>

                    <div>
                        <label for="translation" class="block font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                </svg>
                                Terjemahan Bahasa Indonesia
                            </span>
                        </label>
                        <textarea
                            name="translation"
                            id="translation"
                            rows="2"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300"
                            placeholder="Masukkan terjemahan bahasa Indonesia"
                        >{{ old('translation', $dzikir->translation) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Action buttons with better styling -->
            <div class="flex justify-between pt-5">
                <a href="{{ route('admin.dzikir.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <div class="space-x-3">

                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-lg hover:from-green-700 hover:to-emerald-800 transition duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Update Dzikir
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Add some custom styles for better Arabic text display */
    #arabic_text {
        font-family: 'Traditional Arabic', 'Scheherazade New', 'Noto Sans Arabic', sans-serif;
        font-size: 1.5rem;
        line-height: 2.25rem;
    }
</style>
@endsection
