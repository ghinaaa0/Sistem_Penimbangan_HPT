@extends('layouts.dashboard')

@section('title', 'Form Penggajian Harian - BBPTUHPT Baturraden')

@php
    $mode = 'create';
    if (isset($penggajian) && request()->routeIs('penggajian.edit')) $mode = 'edit';
    if (isset($penggajian) && request()->routeIs('penggajian.show')) $mode = 'show';
    $isReadOnly = $mode === 'show';
@endphp

@section('content')
    {{-- ALERT --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800">{{ session('error') }}</div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-3 mb-8">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            <span class="text-base text-gray-600">Beranda</span>
        </div>
        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
        </svg>
        <span class="text-base text-gray-600">Penggajian</span>
        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
        </svg>
        <span class="text-base font-semibold text-[#628141]">Data Upah Harian</span>
    </nav>

    <!-- Card Container (mengganti modal) -->
    <div class="bg-white border border-gray-300 rounded-2xl w-full max-w-[1383px] mx-auto">
        <div class="p-12">
            <!-- Page Title -->
            <div class="flex items-center justify-between mb-12">
                <h1 class="text-3xl font-semibold mb-8">
                    {{ $mode === 'edit' ? 'Edit' : ($mode === 'show' ? 'Detail' : 'Tambah') }} Upah Harian
                </h1>

                <a href="{{ route('penggajian.index') }}"
                   class="text-sm font-semibold text-[#628141] hover:underline">
                    Kembali
                </a>
            </div>

            <!-- Form -->
            @if ($mode === 'edit')
            <form method="POST" action="{{ route('penggajian.update', $penggajian) }}">
                @method('PUT')
            @elseif ($mode === 'show')
            <form>
            @else
            <form method="POST" action="{{ route('penggajian.store') }}">
            @endif
            @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Nama (Pilih Petani) -->
                    <div class="space-y-3">
                        <label class="text-2xl font-normal text-black">Nama</label>
                        <div class="relative">
                            <select
                                @if($isReadOnly) disabled @endif
                                name="id_petani"
                                class="w-full bg-[#F5F5F5] rounded-2xl px-6 py-6 text-xl text-[#211E1E] appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#628141]"
                                required
                            >
                                <option value="">Pilih petani</option>
                                @foreach ($petanis as $p)
                                    <option value="{{ $p->id_petani }}" {{ old('id_petani', $penggajian->id_petani ?? '') == $p->id_petani ? 'selected' : '' }}>

                                        {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="absolute right-6 top-1/2 -translate-y-1/2 w-6 h-6 pointer-events-none" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="space-y-3">
                        <label class="text-2xl font-normal text-black">Tanggal</label>
                        <div class="bg-[#F5F5F5] rounded-[10px] px-6 py-6">
                            <input
                                type="date"
                                name="tanggal_gaji"
                                value="{{ old('tanggal_gaji', isset($penggajian) ? $penggajian->tanggal_gaji->format('Y-m-d') : '') }}"
                                @if($isReadOnly) readonly @endif
                                class="w-full bg-transparent text-xl text-black focus:outline-none"
                                required
                            >
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-3">
                        <label class="text-2xl font-normal text-black">Status</label>
                        <div class="relative">
                            <select
                                name="status"
                                @if($isReadOnly) readonly @endif
                                class="w-full bg-[#F5F5F5] rounded-2xl px-6 py-6 text-xl text-[#211E1E] appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#628141]"
                                required
                            >
                                <option value="BELUM"
                                    {{ old('status', $penggajian->status ?? 'BELUM') === 'BELUM' ? 'selected' : '' }}>
                                    Belum Dibayar
                                </option>

                                <option value="DIBAYAR"
                                    {{ old('status', $penggajian->status ?? '') === 'DIBAYAR' ? 'selected' : '' }}>
                                    Dibayar
                                </option>

                            </select>
                            <svg class="absolute right-6 top-1/2 -translate-y-1/2 w-6 h-6 pointer-events-none" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Total Gajian -->
                    <div class="space-y-3">
                        <label class="text-2xl font-normal text-black">Total Gajian</label>
                        <div class="bg-[#F5F5F5] rounded-[10px] px-6 py-6">
                            <input
                                type="number"
                                name="total_amount"
                                value="{{ old('total_amount', $penggajian->total_amount ?? '') }}"
                                @if($isReadOnly) readonly @endif
                                class="w-full bg-transparent text-xl text-black focus:outline-none"
                                placeholder="Contoh: 870000"
                                min="0"
                                required
                            >
                        </div>
                        <p class="text-xs text-gray-500">Isi angka saja (tanpa Rp / titik).</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end items-center gap-[52px] pt-8">
                    <a
                        href="{{ route('penggajian.index') }}"
                        class="w-[214px] h-[68px] bg-[#C5C5C5] hover:bg-[#b0b0b0] text-white text-2xl font-normal rounded-lg transition-colors flex items-center justify-center"
                    >
                        Batal
                    </a>

                    @if ($mode !== 'show')
                    <button
                        type="submit"
                        class="w-[214px] h-[68px] bg-[#628141] hover:bg-[#537036] text-white text-2xl font-normal rounded-lg transition-colors"
                    >
                         {{ $mode === 'edit' ? 'Update' : 'Simpan' }}
                    </button>
                     @endif
                </div>
            </form>
        </div>
    </div>
@endsection
