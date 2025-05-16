@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Page Header with Improved Design -->
        <div class="mb-10 border-b border-gray-200 pb-5">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Daftar Pengguna</h2>
                <p class="mt-2 text-sm text-gray-600">Kelola daftar pengguna sistem</p>
            </div>
        </div>

        <!-- Enhanced Alert Messages -->
        @if (session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6 animate-fade-in-down border-l-4 border-green-400 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button"
                                onclick="this.parentElement.parentElement.parentElement.parentElement.style.display='none'"
                                class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(session('error'))
            <div class="rounded-md bg-red-50 p-4 mb-6 animate-fade-in-down border-l-4 border-red-400 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button"
                                onclick="this.parentElement.parentElement.parentElement.parentElement.style.display='none'"
                                class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Filter & Search with Card Layout -->
        <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-5">
                <h3 class="text-sm font-medium text-gray-700 mb-4">Filter & Pencarian</h3>
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="flex flex-col sm:flex-row gap-4 md:w-2/3">
                        <div class="relative w-full sm:w-1/2">
                            <label for="role-filter" class="block text-xs font-medium text-gray-700 mb-1">Role</label>
                            <select id="role-filter"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                <option value="">Semua Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="relative w-full sm:w-1/2">
                            <label for="sort-by" class="block text-xs font-medium text-gray-700 mb-1">Urutan</label>
                            <select id="sort-by"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                <option value="name">Urutkan: Nama</option>
                                <option value="email">Urutkan: Email</option>
                                <option value="newest">Urutkan: Terbaru</option>
                            </select>
                        </div>
                    </div>
                    <div class="relative flex-grow md:w-1/3">
                        <label for="search" class="block text-xs font-medium text-gray-700 mb-1">Pencarian</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="search" placeholder="Cari pengguna..."
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Improved Table with Better Spacing -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Bergabung
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-gradient-to-r from-green-400 to-emerald-500 flex items-center justify-center text-white shadow-sm">
                                                <span class="font-medium text-lg">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                            @if (isset($user->username))
                                                <div class="text-xs text-gray-500">
                                                    {{ '@' . $user->username }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($user->role == 'admin')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                            Admin
                                        </span>
                                    @elseif($user->role == 'manager')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Manager
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-lime-100 text-lime-800">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ isset($user->created_at) ? $user->created_at->format('d M Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 rounded-md p-2 transition-colors duration-150 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <!-- Modal for Deleting User -->
                                        <div x-data="{ open: false, userId: null }">
                                            <!-- Button to Trigger the Modal -->
                                            <form x-data
                                                @submit.prevent="open = true; userId = $el.getAttribute('data-user-id')">
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 rounded-md p-2 transition-colors duration-150 shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Modal -->
                                            <div x-show="open" x-transition @click.away="open = false"
                                                class="fixed inset-0 z-50 bg-gray-500 bg-opacity-75 flex justify-center items-center">
                                                <div class="bg-white rounded-lg overflow-hidden shadow-lg w-full max-w-sm">
                                                    <div class="px-6 py-4">
                                                        <h3 class="text-lg font-semibold text-gray-800">Konfirmasi
                                                            Penghapusan</h3>
                                                        <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin
                                                            menghapus pengguna ini?</p>
                                                    </div>
                                                    <div class="flex justify-between p-4 bg-gray-50">
                                                        <button @click="open = false"
                                                            class="text-gray-700 hover:text-gray-900 font-medium px-4 py-2 rounded-md">Batal</button>
                                                        <form method="POST"
                                                            action="{{ route('admin.user.destroy', $user->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-600 text-white hover:bg-red-700 font-medium px-4 py-2 rounded-md">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Enhanced Pagination -->
        <div class="mt-8">
            @if (method_exists($users, 'links'))
                <div class="bg-white p-4 shadow-sm rounded-lg border border-gray-200">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Add Alpine.js for interactive elements -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom JS for filtering and search with improved performance -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const roleFilter = document.getElementById('role-filter');
            const sortBy = document.getElementById('sort-by');
            const tableRows = document.querySelectorAll('tbody tr');

            // Debounce function to limit how often the filter runs
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

            // Enhanced search implementation with debounce
            searchInput.addEventListener('input', debounce(filterTable, 300));
            roleFilter.addEventListener('change', filterTable);
            sortBy.addEventListener('change', sortTable);

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const roleValue = roleFilter.value.toLowerCase();
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const role = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

                    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                    const matchesRole = roleValue === '' || role.includes(roleValue);

                    if (matchesSearch && matchesRole) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // You could add an empty state message if no results found
                if (visibleCount === 0 && (searchTerm !== '' || roleValue !== '')) {
                    // No results found logic could be added here
                    console.log('No results found');
                }
            }

            function sortTable() {
                const sortValue = sortBy.value;
                const tbody = document.querySelector('tbody');
                const rows = Array.from(tableRows);

                rows.sort((a, b) => {
                    let aValue, bValue;

                    if (sortValue === 'name') {
                        aValue = a.querySelector('td:nth-child(2)').textContent.trim();
                        bValue = b.querySelector('td:nth-child(2)').textContent.trim();
                    } else if (sortValue === 'email') {
                        aValue = a.querySelector('td:nth-child(3)').textContent.trim();
                        bValue = b.querySelector('td:nth-child(3)').textContent.trim();
                    } else if (sortValue === 'newest') {
                        // Assuming the date is in the fifth column
                        aValue = new Date(a.querySelector('td:nth-child(5)').textContent.trim());
                        bValue = new Date(b.querySelector('td:nth-child(5)').textContent.trim());
                        return bValue - aValue; // Newest first
                    }

                    return aValue.localeCompare(bValue);
                });

                // Re-append rows in new order with a small delay for visual feedback
                rows.forEach((row, index) => {
                    setTimeout(() => {
                        tbody.appendChild(row);
                    }, index * 10); // Small staggered delay for smoother visual
                });
            }
        });
    </script>
@endsection
