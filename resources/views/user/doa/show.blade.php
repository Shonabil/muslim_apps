@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-emerald-50 to-white min-h-screen py-10">
    <!-- Header dengan ornamen -->
    <div class="relative pt-4 pb-6">
        <div class="absolute inset-0 flex justify-center">
            <div class="w-full max-w-5xl h-24 bg-contain bg-center bg-no-repeat opacity-10"
                 style="background-image: url('/images/islamic-ornament.png')">
            </div>
        </div>
        <div class="relative z-10 text-center">
            <h1 class="text-4xl font-bold text-emerald-800 font-arab mb-2">{{ $doa->judul }}</h1>
            <h2 class="text-lg text-emerald-600">Detail Doa Pilihan</h2>
            <div class="flex justify-center mt-4">
                <div class="h-1 w-24 bg-emerald-600 rounded"></div>
            </div>
        </div>
    </div>

    <!-- Konten Doa -->
    <div class="max-w-3xl mx-auto bg-white border border-emerald-100 rounded-xl shadow-md px-6 py-8 mt-6">
        <div class="mb-6">
            <p class="text-3xl text-right font-arab leading-relaxed text-gray-800">{{ $doa->arab }}</p>
        </div>

        @if($doa->latin)
            <p class="italic text-gray-600 mb-4">{{ $doa->latin }}</p>
        @endif

        <p class="text-gray-700 text-lg">{{ $doa->terjemahan }}</p>

        <!-- Tombol kembali -->
        <div class="mt-10 flex justify-end">
            <a href="{{ route('user.doa.index') }}"
               class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition focus:outline-none focus:ring-2 focus:ring-emerald-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .font-arab {
        font-family: 'Scheherazade New', 'Amiri', serif;
    }
</style>
@endpush
