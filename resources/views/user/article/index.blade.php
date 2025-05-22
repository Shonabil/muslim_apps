@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-emerald-50 to-white min-h-screen">
    <!-- Header Ornamen -->
    <div class="relative pt-8 pb-4">
        <div class="absolute inset-0 flex justify-center">
            <div class="w-full max-w-5xl h-24 bg-contain bg-center bg-no-repeat opacity-10"
                style="background-image: url('/images/islamic-ornament.png')">
            </div>
        </div>
        <div class="relative z-10 text-center">
            <h1 class="text-4xl font-bold text-emerald-800 mb-2 font-arabic">مقالات إسلامية</h1>
            <h2 class="text-2xl text-emerald-600">Artikel Islami Terbaru</h2>
            <div class="flex justify-center mt-4">
                <div class="h-1 w-36 bg-emerald-600 rounded"></div>
            </div>
        </div>
    </div>

    <!-- Form Pencarian -->
    <div class="max-w-md mx-auto px-4 mb-8">
        <div class="relative">
            <form action="{{ route('user.article.index') }}" method="GET" class="w-full">
                <input type="text"
                       name="search"
                       placeholder="Cari artikel..."
                       value="{{ old('search', $search ?? '') }}"
                       class="w-full pl-4 pr-10 py-3 rounded-full border-2 border-emerald-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                <button type="submit" class="absolute right-3 top-3 text-emerald-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <!-- Daftar Artikel -->
    <div class="max-w-6xl mx-auto px-6 mt-10 mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($articles as $article)
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-700 p-4 text-white">
                        <h2 class="text-lg font-semibold">{{ $article->title ?? 'Tanpa Judul' }}</h2>
                        <span class="text-sm opacity-80">{{ $article->created_at->format('d M Y') }}</span>
                    </div>

                    <!-- Konten -->
                    <div class="p-5">
                        <div class="text-gray-600 text-sm leading-relaxed mb-5 article-content">
                            {!! Str::markdown(Str::limit(strip_tags($article->content), 150)) !!}
                        </div>
                        <a href="{{ route('user.article.show', $article->id) }}"
                            class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white text-sm px-4 py-2 rounded-lg transition">
                            📖 Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @empty
                <!-- Jika Tidak Ada Artikel -->
                <div class="col-span-3 text-center py-16">
                    <div class="inline-block p-4 rounded-full bg-emerald-100 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M6.938 20h10.124c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L4.34 17c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <p class="text-xl text-gray-500">Belum ada artikel yang tersedia.</p>
                    <p class="text-gray-400 mt-2">Silakan kembali lagi nanti.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .font-arabic {
        font-family: 'Scheherazade New', 'Amiri', serif;
    }

    .article-content {
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    .article-content p {
        margin-bottom: 0.75rem;
    }

    .article-content h1, .article-content h2, .article-content h3, .article-content h4 {
        font-weight: 600;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
        color: #065f46;
    }

    .article-content ul, .article-content ol {
        padding-left: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .article-content li {
        margin-bottom: 0.25rem;
    }

    .article-content a {
        color: #059669;
        text-decoration: underline;
    }

    .article-content blockquote {
        border-left: 3px solid #10b981;
        padding-left: 0.75rem;
        font-style: italic;
        margin: 0.75rem 0;
        color: #4b5563;
    }

    .article-content code {
        background-color: #f3f4f6;
        padding: 0.125rem 0.25rem;
        border-radius: 0.25rem;
        font-family: monospace;
        font-size: 0.875rem;
    }

    .article-content pre {
        background-color: #f3f4f6;
        padding: 0.75rem;
        border-radius: 0.25rem;
        overflow-x: auto;
        margin-bottom: 0.75rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.25rem;
        margin: 0.75rem 0;
    }

    .article-content hr {
        border: 0;
        border-top: 1px solid #e5e7eb;
        margin: 1rem 0;
    }

    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0.75rem;
    }

    .article-content th, .article-content td {
        border: 1px solid #e5e7eb;
        padding: 0.5rem;
    }

    .article-content th {
        background-color: #f9fafb;
    }
</style>
@endpush
