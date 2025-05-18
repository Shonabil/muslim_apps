@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Header dengan judul dan tombol tambah yang lebih modern -->
            <div
                class="flex flex-col sm:flex-row justify-between items-center p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-emerald-100">

                <div class="mb-4 sm:mb-0 text-center sm:text-left">
                    <h5 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Artikel</h5>
                    <p class="text-sm text-gray-500 mt-1">Kelola semua konten artikel website</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('admin.article.create') }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-lg flex items-center justify-center transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Tambah Artikel</span>
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm mb-6 animate-fade-in-down"
                        role="alert">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="font-medium">Berhasil!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="absolute top-4 right-4" onclick="this.parentElement.remove()">
                            <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endif


                <div class="overflow-x-auto relative">
                    <table class="min-w-full bg-white rounded-xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                                    NO</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                                    JUDUL</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                                    PENULIS</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">
                                    TANGGAL</th>
                                <th scope="col"
                                    class="px-6 py-4 text-center text-xs font-medium uppercase tracking-wider">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($articles as $index => $article)
                                <tr class="hover:bg-emerald-50 transition-colors duration-150">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="text-gray-500 text-sm">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="font-semibold text-gray-800">{{ $article->title }}</div>
                                        <!-- Status Badge -->
                                        <div class="mt-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Published
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-r from-emerald-500 to-emerald-600 text-white flex items-center justify-center mr-3 text-sm font-medium shadow-sm">
                                                {{ substr($article->user->name, 0, 1) }}
                                            </div>
                                            <div class="text-sm font-medium text-gray-800">{{ $article->user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm text-gray-700">{{ $article->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.article.edit', $article) }}"
                                                class="border border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white px-3 py-1.5 rounded-md transition-all duration-200 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.article.destroy', $article) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-md transition-all duration-200 flex items-center"
                                                    onclick="confirmDelete(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center py-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="mt-4 text-lg font-medium text-gray-600">Belum ada artikel yang
                                                ditambahkan</p>
                                            <p class="mt-1 text-sm text-gray-500">Mulai buat konten pertama Anda untuk
                                                ditampilkan di website</p>
                                            <a href="{{ route('admin.article.create') }}"
                                                class="mt-6 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg flex items-center transition-all duration-200 shadow-sm hover:shadow transform hover:-translate-y-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Tambah Artikel Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Tombol tambah artikel floating dengan animasi hover -->
                <div class="fixed bottom-8 right-8 group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-green-600 rounded-full blur opacity-0 group-hover:opacity-75 transition duration-300">
                    </div>
                    <a href="{{ route('admin.article.create') }}"
                        class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-r from-emerald-600 to-green-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <!-- Improved Pagination -->
                @if (isset($articles) && method_exists($articles, 'links'))
                    <div class="mt-6 bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal konfirmasi hapus yang lebih modern -->
    <div id="delete-modal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden backdrop-blur-sm">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4 shadow-2xl transform transition-all duration-300">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 mb-4">
                    <svg class="h-12 w-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Konfirmasi Hapus</h3>
                <p class="text-gray-500 mt-2">Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat
                    dibatalkan.</p>
            </div>
            <div class="mt-6 flex justify-center space-x-3">
                <button type="button" id="cancel-delete"
                    class="px-5 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg transition-colors duration-200 font-medium">
                    Batal
                </button>
                <button type="button" id="confirm-delete"
                    class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 font-medium">
                    Hapus Artikel
                </button>
            </div>
        </div>
    </div>

    <script>
        // Script untuk modal konfirmasi hapus
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const statusFilter = document.getElementById('status-filter');
            const sortBy = document.getElementById('sort-by');
            const tableRows = document.querySelectorAll('tbody tr');
            const deleteModal = document.getElementById('delete-modal');
            const cancelDelete = document.getElementById('cancel-delete');
            const confirmDelete = document.getElementById('confirm-delete');
            let formToSubmit = null;

            // Filter & Sort Functions
            if (searchInput) {
                searchInput.addEventListener('input', debounce(filterTable, 300));
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', filterTable);
            }

            if (sortBy) {
                sortBy.addEventListener('change', sortTable);
            }

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        func.apply(context, args);
                    }, wait);
                };
            }

            function filterTable() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
                const statusValue = statusFilter ? statusFilter.value.toLowerCase() : '';

                tableRows.forEach(row => {
                    // Skip the empty state row
                    if (row.cells.length === 1) return;

                    const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const badge = row.querySelector('.inline-flex');
                    const status = badge ? badge.textContent.trim().toLowerCase() : '';

                    const matchesSearch = title.includes(searchTerm);
                    const matchesStatus = !statusValue || status.includes(statusValue);

                    row.style.display = matchesSearch && matchesStatus ? '' : 'none';
                });
            }

            function sortTable() {
                if (!sortBy) return;

                const sortValue = sortBy.value;
                const tbody = document.querySelector('tbody');
                if (!tbody) return;

                const rows = Array.from(tableRows).filter(row => row.cells.length > 1); // Skip empty state row

                rows.sort((a, b) => {
                    let aValue, bValue;

                    if (sortValue === 'title') {
                        aValue = a.querySelector('td:nth-child(2)').textContent.trim();
                        bValue = b.querySelector('td:nth-child(2)').textContent.trim();
                        return aValue.localeCompare(bValue);
                    } else if (sortValue === 'newest') {
                        aValue = new Date(a.querySelector('td:nth-child(4)').textContent.trim());
                        bValue = new Date(b.querySelector('td:nth-child(4)').textContent.trim());
                        return bValue - aValue; // Newest first
                    } else if (sortValue === 'oldest') {
                        aValue = new Date(a.querySelector('td:nth-child(4)').textContent.trim());
                        bValue = new Date(b.querySelector('td:nth-child(4)').textContent.trim());
                        return aValue - bValue; // Oldest first
                    }

                    return 0;
                });

                // Re-append rows in new order
                rows.forEach(row => tbody.appendChild(row));
            }

            // Delete confirmation modal functionality
            window.confirmDelete = function(button) {
                formToSubmit = button.closest('form');
                deleteModal.classList.remove('hidden');

                // Add animation class
                const modalContent = deleteModal.querySelector('div.bg-white');
                modalContent.classList.add('animate-fade-in-up');
            };

            cancelDelete.addEventListener('click', function() {
                const modalContent = deleteModal.querySelector('div.bg-white');
                modalContent.classList.add('animate-fade-out-down');

                setTimeout(() => {
                    deleteModal.classList.add('hidden');
                    modalContent.classList.remove('animate-fade-out-down');
                    formToSubmit = null;
                }, 300);
            });

            confirmDelete.addEventListener('click', function() {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
                deleteModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    cancelDelete.click();
                }
            });

            // Add keydown event for ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                    cancelDelete.click();
                }
            });

            // Dismiss alert after a few seconds
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });

        // Add this to your CSS or style tag
        document.head.insertAdjacentHTML('beforeend', `
<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.3s ease-out forwards;
    }

    .animate-fade-out-down {
        animation: fadeOutDown 0.3s ease-in forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeOutDown {
        from {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
        to {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }
    }
</style>
`);
    </script>
@endsection
