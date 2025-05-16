@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
<div class="flex flex-col sm:flex-row justify-between items-center p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-emerald-100">
    <!-- Judul dan Deskripsi -->
    <div class="mb-4 sm:mb-0 text-center sm:text-left">
        <h5 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Dzikir</h5>
        <p class="text-sm text-gray-500 mt-1">Kelola koleksi dzikir dengan mudah dan efisien</p>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex flex-col sm:flex-row gap-4">
        <!-- Ke User -->
        <a href="{{ route('user.dzikir.index') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-lg flex items-center transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M9.707 4.293a1 1 0 010 1.414L6.414 9H16a1 1 0 110 2H6.414l3.293 3.293a1 1 0 01-1.414 1.414l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 0z"
                      clip-rule="evenodd" />
            </svg>
            <span class="font-medium">Ke User</span>
        </a>

        <!-- Tambah Dzikir -->
        <a href="{{ route('admin.dzikir.create') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-lg flex items-center transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                      clip-rule="evenodd" />
            </svg>
            <span class="font-medium">Tambah Dzikir</span>
        </a>
    </div>
</div>



    <!-- Dzikir Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($dzikirs as $dzikir)
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 transform hover:scale-102">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <h2 class="text-xl font-semibold text-gray-800 overflow-hidden text-ellipsis" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            {{ $dzikir->title }}
                        </h2>
                        <div class="dropdown relative">
                            <button class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-3 mb-4 border-t border-gray-100 pt-3">
                        <p class="text-gray-600 text-sm overflow-hidden text-ellipsis" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                            {{ Str::limit($dzikir->content, 150) }}
                        </p>
                    </div>

                    <div class="flex items-center text-xs text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Diperbarui {{ $dzikir->updated_at->diffForHumans() }}</span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <a href="{{ route('admin.dzikir.edit', $dzikir->id) }}"
                           class="flex items-center justify-center w-1/2 bg-amber-50 text-amber-600 px-3 py-2 rounded-lg hover:bg-amber-100 transition duration-200 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('admin.dzikir.destroy', $dzikir->id) }}" method="POST" class="w-1/2" onsubmit="return confirm('Yakin ingin menghapus dzikir ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full flex items-center justify-center bg-red-50 text-red-600 px-3 py-2 rounded-lg hover:bg-red-100 transition duration-200 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-xl p-12 text-center shadow-md">
                <div class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada data dzikir.</p>
                    <p class="text-gray-400 mb-6">Silakan tambahkan dzikir baru untuk memulai.</p>
                    <a href="{{ route('admin.dzikir.create') }}"
                       class="bg-gradient-to-r from-emerald-600 to-green-700 text-white px-6 py-3 rounded-lg hover:shadow-lg transition duration-300 font-medium inline-flex items-center transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Dzikir Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($dzikirs->count() > 0)
    <div class="mt-8">
        {{ $dzikirs->links() }}
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    /* Custom pagination styling with emerald colors */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 2.5rem;
        min-width: 2.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .pagination .page-item.active .page-link {
        background-color: #10b981;
        color: white;
    }

    .pagination .page-item .page-link:hover:not(.active) {
        background-color: #d1fae5;
        color: #047857;
    }

    .pagination .page-item.disabled .page-link {
        color: #9ca3af;
        cursor: not-allowed;
    }
</style>
@endpush
