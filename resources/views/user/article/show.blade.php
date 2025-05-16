@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-emerald-50 to-emerald-100 min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-6 bg-white rounded-2xl shadow-lg p-8">
        <div class="mb-6">
            <h1 class="text-4xl font-extrabold text-emerald-800 mb-4">{{ $article->title }}</h1>
            <p class="text-sm text-emerald-600">
                Diposting pada {{ $article->created_at->format('d M Y') }}
            </p>
        </div>

        <div class="article-content text-gray-700">
            {!! \Illuminate\Support\Str::markdown($article->content) !!}
        </div>

        <div class="mt-10">
            <a href="{{ route('user.article.index') }}"
               class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                Kembali ke Artikel
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Comprehensive styling for Markdown content */
    .article-content {
        font-size: 1.125rem;
        line-height: 1.75;
        color: #374151;
    }

    .article-content > * + * {
        margin-top: 1.5em;
    }

    .article-content h1 {
        font-size: 2.25rem;
        font-weight: 800;
        color: #065f46;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .article-content h2 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #065f46;
        margin-top: 2rem;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .article-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #065f46;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
    }

    .article-content h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #065f46;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .article-content p {
        margin-bottom: 1.25rem;
    }

    .article-content a {
        color: #059669;
        text-decoration: underline;
        text-underline-offset: 2px;
        transition: color 0.2s;
    }

    .article-content a:hover {
        color: #047857;
    }

    .article-content strong {
        font-weight: 700;
    }

    .article-content em {
        font-style: italic;
    }

    .article-content ul,
    .article-content ol {
        padding-left: 2rem;
        margin-bottom: 1.25rem;
    }

    .article-content ul {
        list-style-type: disc;
    }

    .article-content ol {
        list-style-type: decimal;
    }

    .article-content li {
        margin-bottom: 0.5rem;
    }

    .article-content li > ul,
    .article-content li > ol {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .article-content blockquote {
        border-left: 4px solid #10b981;
        padding: 0.5rem 0 0.5rem 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #4b5563;
        background-color: #f0fdf4;
        border-radius: 0 0.25rem 0.25rem 0;
    }

    .article-content blockquote p:last-child {
        margin-bottom: 0;
    }

    .article-content code {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: 0.9em;
        background-color: #f3f4f6;
        padding: 0.2em 0.4em;
        border-radius: 0.25rem;
    }

    .article-content pre {
        background-color: #f3f4f6;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1.5rem 0;
    }

    .article-content pre code {
        background-color: transparent;
        padding: 0;
        font-size: 0.9em;
        color: #1f2937;
        line-height: 1.6;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }

    .article-content hr {
        border: 0;
        height: 1px;
        background-color: #e5e7eb;
        margin: 2rem 0;
    }

    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
        overflow: hidden;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .article-content thead {
        background-color: #f0fdf4;
    }

    .article-content th {
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #065f46;
        border-bottom: 1px solid #d1d5db;
    }

    .article-content td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .article-content tbody tr:last-child td {
        border-bottom: none;
    }

    .article-content tbody tr:hover {
        background-color: #f9fafb;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .article-content {
            font-size: 1rem;
        }

        .article-content h1 {
            font-size: 1.875rem;
        }

        .article-content h2 {
            font-size: 1.5rem;
        }

        .article-content h3 {
            font-size: 1.25rem;
        }

        .article-content h4 {
            font-size: 1.125rem;
        }
    }
</style>
@endpush
