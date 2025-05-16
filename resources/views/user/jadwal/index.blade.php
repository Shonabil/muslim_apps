@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container py-4 m-auto">
    <div class="jadwal-shalat-container">
        <div class="jadwal-header">
            <h2>
                <span dir="rtl" lang="ar">مواقيت الصلاة</span><br>
                Jadwal Shalat
            </h2>
            <p>Temukan waktu shalat di kota Anda hari ini dan setiap hari</p>
        </div>

        <div class="form-container ">
            <form method="GET" action="{{ route('jadwal.index') }}" id="jadwalForm">
                <div class="form-group">
                    <div class="input-group">
                        <label for="kodeKota">
                            <i class="fas fa-map-marker-alt mr-1"></i> Kota
                        </label>
                        <div class="city-search-wrapper w-full">
                            <select name="kodeKota" id="kodeKota" class="select2-kota w-full">
                                @foreach ($kota as $data_kota)
                                    <option value="{{ $data_kota['id'] }}" {{ $kodeKota == $data_kota['id'] ? 'selected' : '' }}>
                                        {{ $data_kota['lokasi'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="tahun">
                            <i class="far fa-calendar mr-1"></i> Tahun
                        </label>
                        <select name="tahun" id="tahun">
                            @for ($y = 2024; $y <= 2026; $y++)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="bulan">
                            <i class="far fa-calendar-alt mr-1"></i> Bulan
                        </label>
                        <select name="bulan" id="bulan">
                            @php
                                $nama_bulan = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                            @endphp
                            @for ($b = 1; $b <= 12; $b++)
                                <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                                    {{ $nama_bulan[$b] }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="tanggal">
                            <i class="far fa-calendar-check mr-1"></i> Tanggal
                        </label>
                        <select name="tanggal" id="tanggal">
                            @for ($d = 1; $d <= 31; $d++)
                                <option value="{{ $d }}" {{ $tanggal == $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-jadwal" id="btnJadwal">
                        <div class="loading-spinner" id="btnSpinner"></div>
                        <i class="fas fa-search" id="btnIcon"></i>
                        <span id="btnText">Tampilkan Jadwal</span>
                    </button>
                </div>
            </form>
        </div>

        @if ($jadwal_shalat)
            <div class="jadwal-result">
                <div class="jadwal-result-header">
                    <h3>{{ $jadwal_shalat['lokasi'] }}</h3>
                    <p>{{ $jadwal_shalat['jadwal']['tanggal'] }}</p>
                </div>

                <div class="prayer-times">
                    @php
                        $currentTime = date('H:i');
                        $prayerTimes = [
                            ['name' => 'Imsak', 'time' => $jadwal_shalat['jadwal']['imsak'], 'icon' => 'fa-moon'],
                            ['name' => 'Subuh', 'time' => $jadwal_shalat['jadwal']['subuh'], 'icon' => 'fa-cloud-sun'],
                            ['name' => 'Dzuhur', 'time' => $jadwal_shalat['jadwal']['dzuhur'], 'icon' => 'fa-sun'],
                            ['name' => 'Ashar', 'time' => $jadwal_shalat['jadwal']['ashar'], 'icon' => 'fa-cloud-sun'],
                            ['name' => 'Maghrib', 'time' => $jadwal_shalat['jadwal']['maghrib'], 'icon' => 'fa-cloud-moon'],
                            ['name' => 'Isya', 'time' => $jadwal_shalat['jadwal']['isya'], 'icon' => 'fa-moon']
                        ];

                        // Find the next prayer time
                        $nextPrayer = null;
                        $currentTimestamp = strtotime($currentTime);

                        foreach ($prayerTimes as $index => $prayer) {
                            $prayerTimestamp = strtotime($prayer['time']);

                            if ($currentTimestamp < $prayerTimestamp) {
                                $nextPrayer = $index;
                                break;
                            }
                        }

                        // If no next prayer found (after last prayer), set to first prayer of next day
                        if ($nextPrayer === null) {
                            $nextPrayer = 0;
                        }
                    @endphp

                    @foreach ($prayerTimes as $index => $prayer)
                        <div class="prayer-item {{ $index === $nextPrayer ? 'next-prayer' : '' }}">
                            <div class="prayer-name">
                                <div class="prayer-icon">
                                    <i class="fas {{ $prayer['icon'] }}"></i>
                                </div>
                                {{ $prayer['name'] }}
                            </div>
                            <div class="prayer-time">
                                {{ $prayer['time'] }}
                                @if ($index === $nextPrayer)
                                    <span class="next-prayer-badge">Selanjutnya</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Add Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnJadwal = document.getElementById('btnJadwal');
        const btnSpinner = document.getElementById('btnSpinner');
        const btnIcon = document.getElementById('btnIcon');
        const btnText = document.getElementById('btnText');
        const jadwalForm = document.getElementById('jadwalForm');

        // Initialize Select2 for city dropdown with improved settings
        $(document).ready(function() {
            $('.select2-kota').select2({
                placeholder: 'Cari kota...',
                allowClear: true,
                width: '100%',
                dropdownParent: $('.city-search-wrapper'),
                containerCssClass: 'city-select2-container',
                minimumInputLength: 1,
                language: {
                    inputTooShort: function() {
                        return "Ketik minimal 1 karakter untuk mencari";
                    },
                    noResults: function() {
                        return "Kota tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            // Re-focus search field when dropdown is opened
            $('.select2-kota').on('select2:open', function() {
                setTimeout(function() {
                    $('.select2-search__field').focus();
                }, 100);
            });
        });

        btnJadwal.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('btn-ripple');

            // Position the ripple where user clicked
            const rect = btnJadwal.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';

            btnJadwal.appendChild(ripple);

            // Add pulse animation
            btnJadwal.classList.add('clicked');

            // Show loading spinner
            btnSpinner.style.display = 'block';
            btnIcon.style.display = 'none';
            btnText.textContent = 'Memuat...';

            // Remove ripple element after animation completes
            setTimeout(() => {
                ripple.remove();
                btnJadwal.classList.remove('clicked');
            }, 600);

            // Let the form submit naturally after small delay to show animation
            // We don't prevent the default form submission
        });

        // Additional city search functionality
        $('.select2-kota').on('change', function() {
            const selectedCity = $(this).val();
            console.log('Selected city ID:', selectedCity);
            // You can add additional logic here if needed
        });
    });
</script>
@endsection

@push('styles')
<style>

/* Font styles */
@import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary-color: #0d8749;
    --primary-dark: #086937;
    --primary-light: #e9f7f0;
    --accent-color: #ffc107;
    --text-color: #2d2d2d;
    --light-text: #6c757d;
    --border-color: #e7f3ee;
    --white: #ffffff;
    --light-bg: #f8fcfa;
}

.select2-container--default .select2-selection--single {
    display: flex !important;
    align-items: center !important;
    height: 44px !important;
    padding-left: 12px;
}

.select2-container--default .select2-selection__rendered {
    padding: 0 !important;
    margin: 0 !important;
    color: #2a9ba5;
    width: 100%;
}


.select2-container--default .select2-selection__arrow {
    height: 44px !important;
    right: 10px;
}

.jadwal-shalat-container {
    font-family: 'Poppins', sans-serif;
    color: var(--text-color);
    background-color: var(--light-bg);
    padding: 2rem 1rem;
    border-radius: 12px;
}

.jadwal-header {
    text-align: center;
    margin-bottom: 2rem;
    position: relative;
}

.jadwal-header h2 {
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    font-size: 2rem;
}

.jadwal-header p {
    color: var(--light-text);
    font-size: 0.9rem;
}

.jadwal-header::after {
    content: "";
    display: block;
    width: 60px;
    height: 4px;
    background: var(--primary-color);
    margin: 1rem auto 0;
    border-radius: 2px;
}

.form-container {
    background-color: var(--white);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(13, 135, 73, 0.1);
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.input-group {
    flex: 1;
    min-width: 150px;
}

.input-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--primary-color);
    font-size: 0.9rem;
}

.input-group select,
.select2-container .select2-selection--single {
    width: 100%;
    height: 50px;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: var(--white);
    color: var(--text-color);
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.input-group select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%230d8749' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1rem;
}

.input-group select:focus,
.select2-container .select2-selection--single:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(13, 135, 73, 0.1);
}

.select2-container {
    width: 100% !important;

}

.select2-container .select2-selection--single {
    display: flex;
    align-items: center;
}

.select2-container .select2-selection--single .select2-selection__rendered {
    color: var(--text-color);
    line-height: normal;
    padding-left: 0;
    padding-right: 20px;
    display: flex;
    align-items: center;
}

.select2-container .select2-selection--single .select2-selection__arrow {
    height: 50px;
    width: 30px;
    right: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.select2-container .select2-selection--single .select2-selection__arrow b {
    border-color: var(--primary-color) transparent transparent;
    border-width: 6px 4px 0;
}

.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent var(--primary-color);
    border-width: 0 4px 6px;
}

.select2-search--dropdown {
    padding: 10px;
}

.select2-dropdown {
    border: 1px solid var(--border-color);
    border-radius: 0 0 8px 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    margin-top: -1px;
}

.select2-results__option {
    padding: 10px 12px;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.select2-results__option--highlighted {
    background-color: var(--primary-light) !important;
    color: var(--primary-color) !important;
}

.select2-container--default .select2-results__option--selected {
    background-color: var(--primary-color);
    color: white;
}

.select2-search--dropdown .select2-search__field {
    border: 1px solid var(--border-color);
    border-radius: 6px;
    padding: 10px 12px;
    font-size: 0.9rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.select2-search--dropdown .select2-search__field:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(13, 135, 73, 0.1);
}

.select2-container--default .select2-selection__placeholder {
    color: var(--light-text);
}

.select2-container--default .select2-selection__clear {
    color: var(--light-text);
    font-size: 18px;
    margin-right: 10px;
}

/* Search icon for city selector */
.city-search-wrapper {
    position: relative;
}

.city-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    z-index: 2;
    pointer-events: none;
}

.city-select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 30px !important;
}

.btn-jadwal {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
}

.btn-jadwal:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 135, 73, 0.2);
}

.btn-jadwal.clicked {
    animation: buttonPulse 0.5s ease;
}

.btn-jadwal .btn-ripple {
    position: absolute;
    width: 100px;
    height: 100px;
    background-color: rgba(255, 255, 255, 0.7);
    border-radius: 50%;
    transform: scale(0);
    animation: ripple 0.6s linear;
    opacity: 1;
}

@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

@keyframes buttonPulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(0.97);
    }
    100% {
        transform: scale(1);
    }
}

/* Loading indicator */
.btn-jadwal .loading-spinner {
    display: none;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.8s linear infinite;
    margin-right: 8px;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.jadwal-result {
    background-color: var(--white);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(13, 135, 73, 0.1);
}

.jadwal-result-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 1.5rem;
    text-align: center;
}

.jadwal-result-header h3 {
    margin: 0;
    font-weight: 600;
    font-size: 1.25rem;
}

.jadwal-result-header p {
    margin: 0.5rem 0 0;
    font-size: 0.9rem;
    opacity: 0.9;
}

.prayer-times {
    padding: 0.5rem;
}

.prayer-item {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.prayer-item:last-child {
    border-bottom: none;
}

.prayer-item:hover {
    background-color: var(--primary-light);
}

.prayer-name {
    flex: 1;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.prayer-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-radius: 50%;
}

.prayer-time {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 1.1rem;
}

.prayer-item.active {
    background-color: var(--primary-light);
}

.prayer-item.active .prayer-icon {
    background-color: var(--primary-color);
    color: white;
}

.prayer-item.active .prayer-time {
    color: var(--primary-dark);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .input-group {
        flex: 1 0 100%;
    }
}

</style>
@endpush
