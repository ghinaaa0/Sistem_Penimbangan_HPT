@extends('layouts.dashboard')

@section('title', 'Upah Harian - BBPTUHPT Baturraden')

@section('content')
    {{-- ALERT --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800">{{ session('error') }}</div>
    @endif

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-3 mb-2">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            <span class="text-base text-gray-600">Beranda</span>
        </div>

        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
        </svg>

        <span class="text-base font-semibold text-[#628141]">Penggajian</span>
    </nav>

    <!-- Page Title -->
    <div class="mb-6">
        <h1 class="text-[32px] font-medium text-black leading-tight mb-0">Upah Harian</h1>
        <p class="text-xl text-gray-400">Kelola data pembayaran upah harian petani</p>
    </div>

    @php
        $totalPengeluaran = (int) ($penggajians->sum('total_amount') ?? 0);
        $totalData = $penggajians->count();
        $pendingCount = $penggajians->where('status', 'BELUM')->count();
        $tanggalTerakhir = optional($penggajians->first())->tanggal_gaji; // karena latest()
    @endphp

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Pengeluaran Dana -->
        <div class="bg-white border border-gray-300 rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-[51px] h-[48px] bg-gray-100 border border-gray-200 rounded-[10px] flex items-center justify-center">
                    <svg class="w-[33px] h-[33px]" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1.9.75 1.77 2.31 1.77 1.6 0 2.19-.83 2.19-1.53 0-1.06-1.02-1.38-2.56-1.73-2.16-.49-3.94-1.18-3.94-3.29 0-1.81 1.42-2.96 3.08-3.31V6h2.67v1.57c1.93.42 2.83 1.81 2.9 3.31h-1.96c-.03-.92-.56-1.8-2.24-1.8-1.44 0-2.04.68-2.04 1.48 0 .87.65 1.15 2.67 1.61 2.28.52 3.83 1.32 3.83 3.37 0 1.82-1.34 3.07-3.24 3.55z" fill="black"/>
                    </svg>
                </div>
                <div class="flex flex-col gap-1 min-w-0">
                    <span class="truncate text-sm text-gray-600" title="Pengeluaran Dana">
                        Pengeluaran Dana
                    </span>
                    <span class="truncate text-lg font-semibold" 
                        title="Rp {{ number_format($totalPengeluaran,0,',','.') }}">
                        Rp {{ number_format($totalPengeluaran,0,',','.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Total Data -->
        <div class="bg-white border border-gray-300 rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-[51px] h-[48px] bg-gray-100 border border-gray-200 rounded-[10px] flex items-center justify-center">
                    <svg class="w-[25px] h-[25px]" viewBox="0 0 24 24" fill="none">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="#E67E22"/>
                    </svg>
                </div>
                <div class="flex flex-col gap-1 min-w-0">
                    <span class="truncate text-sm text-gray-600">Total Data</span>
                    <span class="truncate text-lg font-semibold">{{ $totalData }}</span>
                </div>
            </div>
        </div>

        <!-- Tanggal Gaji Terakhir -->
        <div class="bg-white border border-gray-300 rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-[51px] h-[48px] bg-gray-100 border border-gray-200 rounded-[10px] flex items-center justify-center">
                    <svg class="w-[25px] h-[25px]" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke="#628141" stroke-width="1.5"/>
                        <line x1="3" y1="10" x2="21" y2="10" stroke="#628141" stroke-width="1.5"/>
                    </svg>
                </div>
                <div class="flex flex-col gap-1 min-w-0">
                    <span class="truncate text-sm text-gray-600">Tanggal Gaji</span>
                    <span class="truncate text-lg font-semibold"
                        title="{{ $tanggalTerakhir?->translatedFormat('d F Y') }}">
                        {{ $tanggalTerakhir?->translatedFormat('d F Y') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white border border-gray-300 rounded-xl p-5">
            <div class="flex items-center gap-3">
                <div class="w-[51px] h-[48px] bg-gray-100 border border-gray-200 rounded-[10px] flex items-center justify-center">
                    <svg class="w-[25px] h-[25px]" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="#628141" stroke-width="1.5"/>
                        <path d="M12 7v5l3 3" stroke="#628141" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="flex flex-col gap-1 min-w-0">
                    <span class="truncate text-sm text-gray-600">Pending</span>
                    <span class="truncate text-lg font-semibold">{{ $pendingCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="border border-gray-300 rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6">Kelola Data Upah Harian</h2>

        <!-- Search and Filters (UI only, belum fungsi) -->
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-6">
            <div class="w-full lg:w-auto">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Cari nama petani..."
                        class="w-full lg:w-[300px] h-10 pl-4 pr-10 border border-gray-300 rounded-2xl text-base focus:outline-none focus:ring-2 focus:ring-[#8BAE66]"
                    >
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <select class="h-10 px-4 pr-10 border border-gray-300 rounded-2xl text-base focus:outline-none focus:ring-2 focus:ring-[#8BAE66] cursor-pointer bg-white">
                    <option>Bulan (UI)</option>
                </select>

                <select class="h-10 px-4 pr-10 border border-gray-300 rounded-2xl text-base focus:outline-none focus:ring-2 focus:ring-[#8BAE66] cursor-pointer bg-white">
                    <option value="">Semua Status</option>
                    <option value="DIBAYAR">Dibayar</option>
                    <option value="BELUM">Belum Dibayar</option>
                </select>

                <!-- Gaji Orang Button -->
                <a href="{{ route('penggajian.create') }}"
                   class="flex items-center gap-2 h-10 px-4 bg-[#8BAE66] text-white rounded-2xl hover:bg-[#7a9d5a] transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    <span class="text-base font-medium">Gaji Orang</span>
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-hidden rounded-lg border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#8BAE66]">
                        <tr>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">No</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Total Gaji</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Status</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($penggajians as $i => $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-4 text-center text-xs text-gray-800">{{ $i + 1 }}</td>
                                <td class="px-3 py-4 text-left text-xs text-gray-800">
                                    {{ $row->petani?->nama ?? '-' }}
                                </td>
                                <td class="px-3 py-4 text-center text-xs text-gray-800">
                                    Rp {{ number_format((int)$row->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-3 py-4 text-center text-xs text-gray-800">
                                    {{ $row->tanggal_gaji?->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-3 py-4 text-center">
                                    @if ($row->status === 'DIBAYAR')
                                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">Dibayar</span>
                                    @else
                                        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium">Belum</span>
                                    @endif
                                </td>
                                <td class="px-3 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Lihat --}}
                                        <a href="{{ route('penggajian.show', $row) }}"
                                           class="text-gray-600 hover:text-gray-800 transition-colors"
                                           title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('penggajian.edit', $row) }}"
                                           class="text-blue-600 hover:text-blue-800 transition-colors"
                                           title="Edit">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <button type="button"
                                            onclick="openDeleteModal('{{ addslashes($row->petani?->nama ?? 'data ini') }}', '{{ route('penggajian.destroy', $row) }}')"
                                            class="text-red-600 hover:text-red-800 transition-colors"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-8 text-center text-sm text-gray-500">
                                    Belum ada data penggajian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    @include('partials.delete-modal')
@endsection

@push('scripts')
<script>
    function openDeleteModal(name, actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const nameEl = document.getElementById('deleteName');

        if (!modal || !form || !nameEl) return;

        form.action = actionUrl;
        nameEl.textContent = name || 'data ini';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endpush
