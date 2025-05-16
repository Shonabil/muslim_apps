@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="relative bg-gradient-to-r from-emerald-600 to-emerald-500 px-8 py-8 text-white">
                <h2 class="text-2xl font-bold mb-1 relative z-10">Profil Saya</h2>
                <p class="text-sm text-emerald-100 opacity-90 relative z-10">Informasi akun dan detail pribadi Anda</p>
                <div class="absolute -bottom-5 left-0 right-0 h-10 bg-white rounded-t-full"></div>
            </div>

            <div class="px-8 py-8">
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <span class="block text-sm font-semibold text-gray-500 mb-2">Nama</span>
                    <div class="text-gray-800 font-medium">{{ Auth::user()->name }}</div>
                </div>

                <div class="mb-6 pb-6 border-b border-gray-100">
                    <span class="block text-sm font-semibold text-gray-500 mb-2">Email</span>
                    <div class="text-gray-800 font-medium">{{ Auth::user()->email }}</div>
                </div>

                <div class="mb-6">
                    <span class="block text-sm font-semibold text-gray-500 mb-2">Tanggal Bergabung</span>
                    <div class="text-gray-800 font-medium">{{ Auth::user()->created_at->format('d-m-Y') }}</div>
                </div>
            </div>

            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-300 text-white font-medium rounded-lg transition duration-150 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
