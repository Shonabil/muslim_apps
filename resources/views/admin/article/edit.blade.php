@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Artikel</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi artikel Anda</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.article.update', $article) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                    required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Artikel</label>
                <textarea id="content" name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Metadata -->
            <div class="mb-6 bg-emerald-50 p-4 rounded-md border border-emerald-200 text-sm text-gray-600">
                <div class="flex justify-between mb-2">
                    <div>Dibuat: {{ $article->created_at->format('d M Y H:i') }}</div>
                    <div>Diperbarui: {{ $article->updated_at->format('d M Y H:i') }}</div>
                </div>
                @if($article->user)
                    <div>Penulis: {{ $article->user->name }}</div>
                @endif
            </div>

            <!-- Tombol -->
            <div class="flex justify-between pt-4 border-t border-gray-200">
                <a href="{{ route('admin.article.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Kembali
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Update Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
    <!-- EasyMDE CSS -->
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <style>
        /* Warna emerald untuk EasyMDE */
        .EasyMDEContainer {
            border: 1px solid #10b981;
            border-radius: 0.375rem;
        }

        .EasyMDEContainer .editor-toolbar {
            background-color: #ecfdf5;
            border-bottom: 1px solid #10b981;
        }

        .EasyMDEContainer .editor-toolbar button,
        .EasyMDEContainer .editor-toolbar a {
            color: #065f46 !important;
        }

        .EasyMDEContainer .editor-toolbar button:hover,
        .EasyMDEContainer .editor-toolbar a:hover {
            background-color: #d1fae5 !important;
            border-color: #10b981 !important;
        }

        .EasyMDEContainer .editor-toolbar button.active,
        .EasyMDEContainer .editor-toolbar a.active {
            background-color: #a7f3d0 !important;
            color: #047857 !important;
        }

        .EasyMDEContainer .CodeMirror {
            background-color: #ffffff;
            color: #111827;
        }

        .EasyMDEContainer .CodeMirror-focused {
            border: 1px solid #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new EasyMDE({
                element: document.getElementById("content"),
                spellChecker: false,
                status: false,
                autofocus: true,
                toolbar: [
                    "bold", "italic", "heading", "|",
                    "quote", "unordered-list", "ordered-list", "|",
                    "link", "image", "|",
                    "preview", "side-by-side", "fullscreen", "|",
                    "guide"
                ]
            });
        });
    </script>
@endpush
