@extends('layouts.dashboard')

@section('title', 'Master Data Jenis HPT - BBPTUHPT')

@php
    // mode: create / edit / show
    $mode = 'create';

    if (isset($jenis_hpt) && request()->routeIs('master.jenis.edit')) $mode = 'edit';
    if (isset($jenis_hpt) && request()->routeIs('master.jenis.show')) $mode = 'show';

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

    {{-- Breadcrumb --}}
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
        <span class="text-base font-semibold text-[#628141]">Master Data</span>
    </nav>

    {{-- Title --}}
    <div class="mb-6">
        <h1 class="text-[32px] font-medium text-black leading-tight mb-0">Master Data</h1>
        <p class="text-xl text-gray-400">Kelola data jenis HPT.</p>
    </div>

    <div class="grid grid-cols-2 gap-6 mt-10">

        {{-- FORM --}}
        <div class="border border-gray-300 rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">
                    @if ($mode === 'edit') Edit Jenis HPT
                    @elseif ($mode === 'show') Detail Jenis HPT
                    @else Tambah Jenis HPT
                    @endif
                </h2>

                @if ($mode !== 'create')
                    <a href="{{ route('master.jenis.index') }}" class="text-sm font-semibold text-[#628141] hover:underline">
                        Batal
                    </a>
                @endif
            </div>

            @if ($mode === 'edit')
                <form action="{{ route('master.jenis.update', $jenis_hpt) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
            @elseif ($mode === 'show')
                <form action="#" method="POST" class="space-y-6">
            @else
                <form action="{{ route('master.jenis.store') }}" method="POST" class="space-y-6">
                    @csrf
            @endif

                <div class="flex flex-col gap-1">
                    <label class="text-base font-semibold text-gray-800">Nama Jenis</label>
                    <input
                        type="text"
                        name="nama_jenis"
                        value="{{ old('nama_jenis', $jenis_hpt->nama_jenis ?? '') }}"
                        placeholder="Contoh: Rumput Gajah"
                        @if($isReadOnly) readonly @endif
                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl
                               focus:outline-none focus:ring-2 focus:ring-[#8BAE66] text-base
                               {{ $isReadOnly ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                    />
                </div>

                @if ($mode !== 'show')
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-[#8BAE66] text-white font-semibold text-base px-8 py-3 rounded-xl hover:bg-[#7a9d5a] transition-colors"
                    >
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                        </svg>
                        {{ $mode === 'edit' ? 'Update data' : 'Simpan data' }}
                    </button>
                @endif

            </form>
        </div>

        {{-- TABLE --}}
        <div class="border border-gray-300 rounded-xl p-6">
            <h2 class="text-2xl font-bold mb-6">Kelola Jenis HPT</h2>

            <div class="overflow-hidden rounded-lg border border-gray-200">
                <table class="w-full">
                    <thead class="bg-[#8BAE66]">
                        <tr>
                            <th class="px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Jenis</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($jenisHpts as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-4 text-xs text-gray-800">{{ $row->nama_jenis }}</td>
                                <td class="px-3 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('master.jenis.edit', $row) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                            </svg>
                                        </a>

                                        <a href="{{ route('master.jenis.show', $row) }}" class="text-gray-600 hover:text-gray-800" title="Lihat">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </a>

                                        <button type="button"
                                            class="text-red-600 hover:text-red-800"
                                            title="Hapus"
                                            onclick="openDeleteModal('{{ addslashes($row->nama_jenis) }}', '{{ route('master.jenis.destroy', $row) }}')"
                                        >
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-3 py-6 text-center text-sm text-gray-500">
                                    Belum ada data jenis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @include('partials.delete-modal')
@endsection

@push('scripts')
<script>
    function openDeleteModal(name, actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const nameEl = document.getElementById('deleteName');

        form.action = actionUrl;
        nameEl.textContent = name || 'data ini';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endpush
