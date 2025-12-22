<h2>Data HPT</h2>

<a href="{{ route('hpt.create') }}">+ Tambah Data</a>
@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    @foreach($hpt as $h)
    <tr>
        <td>{{ $h->petani->nama ?? '-' }}</td>
        <td>{{ $h->kategori->nama_kategori ?? '-' }}</td>
        <td>{{ $h->jumlah_hpt }} Ton</td>
        <td>{{ $h->tanggal_pemasukan }}</td>
        <td>{{ $h->blok->nama_blok ?? '-' }}</td>
        <td>
            <a href="{{ route('hpt.edit', $h->id) }}">Edit</a>
            <form action="{{ route('hpt.destroy', $h->id) }}" method="POST">
                @csrf @method('DELETE')
                <button>Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
