@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-emerald-50 to-white min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-emerald-800 font-arabic mb-2">ذِكْر</h1>
            <h2 class="text-2xl text-gray-800 font-semibold">{{ $dzikir->title }}</h2>
            <div class="mt-3 w-24 h-1 bg-emerald-500 mx-auto rounded"></div>
        </div>

        <!-- Dzikir Content -->
        <div class="bg-white shadow-md rounded-xl p-8 border border-emerald-100">
            <!-- Arabic -->
            <div class="mb-6">
                <p class="text-right text-3xl leading-loose font-arabic text-gray-900 mb-4">
                    {{ $dzikir->arabic_text }}
                </p>
                <p class="text-lg text-gray-600 italic mb-2">({{ $dzikir->latin_translation }})</p>
                <p class="text-base text-gray-700">{{ $dzikir->translation }}</p>
            </div>

            <!-- Fadilah (jika ada) -->
            @if($dzikir->fadilah)
            <div class="bg-amber-50 border border-amber-100 p-4 rounded-lg mt-6">
                <p class="text-amber-800">
                    <span class="font-semibold">Fadilah:</span> {{ $dzikir->fadilah }}
                </p>
            </div>
            @endif
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-8 text-center">
            <a href="{{ route('user.dzikir.index') }}"
               class="inline-flex items-center bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 14.707a1 1 0 01-1.414 0L7 10.414l4.293-4.293a1 1 0 111.414 1.414L9.414 10l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar Dzikir
            </a>
        </div>
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
