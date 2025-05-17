@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg mt-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Doa</h2>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.doa.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="judul" class="block font-semibold text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" id="judul" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" value="{{ old('judul') }}" required>
        </div>

        <div>
            <label for="arab" class="block font-semibold text-gray-700 mb-1">Teks Arab</label>
            <textarea name="arab" id="arab" rows="3" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" required>{{ old('arab') }}</textarea>
        </div>

        <div>
            <label for="latin" class="block font-semibold text-gray-700 mb-1">Transliterasi Latin</label>
            <textarea name="latin" id="latin" rows="3" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" required>{{ old('latin') }}</textarea>
        </div>

        <div>
            <label for="terjemahan" class="block font-semibold text-gray-700 mb-1">Terjemahan</label>
            <textarea name="terjemahan" id="terjemahan" rows="3" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" required>{{ old('terjemahan') }}</textarea>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.doa.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded hover:bg-emerald-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    /* Custom styling for Arabic text input */
    #arab {
        font-family: 'Scheherazade New', 'Amiri', serif;
        font-size: 1.25rem;
        direction: rtl;
    }

    /* Add subtle emerald styling to form elements on hover */
    input:hover, textarea:hover {
        border-color: #10b981;
    }

    /* Add transition effects */
    input, textarea, button {
        transition: all 0.2s ease-in-out;
    }

    /* Add subtle background to focused elements */
    input:focus, textarea:focus {
        background-color: #f8fdfb;
    }
</style>
@endpush
