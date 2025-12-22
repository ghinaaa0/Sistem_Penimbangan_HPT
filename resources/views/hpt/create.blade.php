<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Data HPT</title>
    <link rel="stylesheet" href="{{ asset('css/hpt.css') }}">
</head>
<body>

<!-- HEADER -->
<header class="topbar">
    <div class="logo">BBPTUHPT</div>
    <div class="search-box">
        <input type="text" placeholder="Cari">
    </div>
    <div class="user">
        <span>Nastiti Prabandari</span>
        <small>Admin</small>
    </div>
</header>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <ul>
            <li>Beranda</li>
            <li class="active">Input Data HPT</li>
            <li>Penggajian</li>
            <li>Grafik HPT</li>
            <li>Kontak Petani</li>
            <li>Rekap Petani</li>
            <li>Rekap Data Total</li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="content">
        <h2>Masukkan Data HPT</h2>
        @if ($errors->any())
            <div style="background:red;color:white;padding:10px">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form action="{{ route('hpt.store') }}" method="POST">
            @csrf

            <!-- UPLOAD -->
            <div class="upload-area">
                <div class="upload-icon">⬆</div>
                <p><strong>Pilih file</strong> atau seret & letakkan di sini</p>
                <small>JPEG, PNG, PDF, DOCX format sampai 100mb</small>
                <input type="file" name="file">
            </div>

            <!-- FORM GRID -->
            <div class="form-grid">
                <div>
                    <label>Nama petani</label>
                    <select name="id_petani" class="form-control">
                        <option value="">Nama Petani</option>
                        @foreach ($petani as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Kategori HPT</label>
                    <select name="id_kategori" class="form-control">
                        <option value="">Jenis Rumput</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Jumlah HPT (Ton)</label>
                    <input type="number" step="0.01" name="jumlah_hpt">
                </div>

                <div>
                    <label>Tanggal pemasukan</label>
                    <input type="date" name="tanggal_pemasukan">
                </div>

                <div>
                    <label>Keterangan tempat</label>
                    <select name="id_blok" class="form-control">
                        <option value="">Blok Lahan</option>
                        @foreach ($blok as $b)
                            <option value="{{ $b->id }}">
                                {{ $b->nama_blok }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="actions">
                <a href="/hpt" class="btn cancel">Batal</a>
                <button type="submit" class="btn save">Simpan</button>
            </div>
        </form>
    </main>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div>
        <strong>BBPTUHPT</strong>
        <p>Sistem yang memudahkan penimbangan dan pembayaran rumput.</p>
    </div>
    <div>
        <strong>Informasi</strong>
        <p>Baturaden, Banyumas, Jawa Tengah</p>
        <p>Email: bbptuhptbaturaden@gmail.com</p>
    </div>
</footer>

</body>
</html>
