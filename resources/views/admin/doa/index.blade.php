@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-emerald-100 mb-10">
        <div class="mb-4 sm:mb-0 text-center sm:text-left">
            <h1 class="text-3xl font-bold text-emerald-800 tracking-tight">Manajemen Doa</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola koleksi doa dengan mudah dan efisien</p>
        </div>

         <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('admin.doa.create') }}"
               class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-lg flex items-center transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                          clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Tambah Doa</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Doa Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($doas as $doa)
            <div class="bg-white rounded-xl shadow-md border border-emerald-200 overflow-hidden hover:shadow-lg transition duration-300 transform hover:scale-[1.02]">
                <div class="p-6 flex flex-col justify-between h-full">
                    <div>
                        <h2 class="text-xl font-semibold text-emerald-800 mb-3 truncate" title="{{ $doa->judul }}">{{ $doa->judul }}</h2>
                        <p class="text-3xl font-arab leading-relaxed text-gray-800 mb-3 text-right select-text">{{ $doa->arab }}</p>
                        <p class="text-sm italic text-gray-600 mb-1 truncate" title="{{ $doa->latin }}">{{ $doa->latin }}</p>
                        <p class="text-sm text-gray-700 line-clamp-4">{{ $doa->terjemahan }}</p>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('admin.doa.edit', $doa->id) }}"
                           class="flex-1 bg-amber-50 text-amber-600 px-4 py-2 rounded-lg hover:bg-amber-100 transition font-medium text-center">
                            Edit
                        </a>

                        <button type="button"
                                class="flex-1 bg-red-50 text-red-600 px-4 py-2 rounded-lg hover:bg-red-100 transition font-medium"
                                onclick="openDeleteModal('{{ $doa->id }}', '{{ $doa->judul }}')">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-xl p-12 text-center shadow-md">
                <div class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada data doa.</p>
                    <p class="text-gray-400 mb-6">Silakan tambahkan doa baru untuk memulai.</p>
                    <a href="{{ route('admin.doa.create') }}"
                       class="bg-gradient-to-r from-emerald-600 to-green-700 text-white px-6 py-3 rounded-lg hover:shadow-lg transition duration-300 font-medium inline-flex items-center transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Doa Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($doas->count() > 0)
        <div class="mt-8">
            {{ $doas->links() }}
        </div>
    @endif
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop with opacity -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" id="modal-backdrop"></div>

    <!-- Modal panel -->
    <div class="bg-white rounded-lg max-w-md w-full mx-4 overflow-hidden shadow-xl transform transition-all">
        <!-- Modal header -->
        <div class="bg-red-50 px-6 py-4 border-b border-red-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-red-800 flex items-center" id="modal-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Konfirmasi Hapus
                </h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeDeleteModal()">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal content -->
        <div class="px-6 py-4">
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                    <p class="text-gray-700">Apakah Anda yakin ingin menghapus doa:</p>
                    <p class="font-semibold text-red-600 mt-1" id="doaTitle"></p>
                    <p class="text-sm text-gray-500 mt-2">Tindakan ini tidak dapat dibatalkan dan semua data terkait akan dihapus secara permanen.</p>
                </div>
            </div>
        </div>

        <!-- Modal actions -->
        <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
            <button type="button"
                    class="w-full sm:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                    onclick="closeDeleteModal()">
                Batal
            </button>

            <form id="deleteForm" method="POST" class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .font-arab {
        font-family: 'Scheherazade New', 'Amiri', serif;
    }

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

    /* Modal animation */
    #deleteModal {
        transition: opacity 0.3s ease;
    }

    #deleteModal.active {
        opacity: 1;
    }

    #deleteModal:not(.active) {
        opacity: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    function openDeleteModal(id, title) {
        // Set the title in the modal
        document.getElementById('doaTitle').textContent = title;

        // Set the form action correctly
        const form = document.getElementById('deleteForm');
        form.action = "{{ url('admin/doa') }}/" + id;

        // Show the modal with animation
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('active');
        }, 10);

        // Add event listener to close modal when clicking outside
        document.getElementById('modal-backdrop').addEventListener('click', closeDeleteModal);
    }

    function closeDeleteModal() {
        // Hide the modal with animation
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('active');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endpush
