<?php

namespace App\Http\Controllers;

use App\Models\Hpt;
use App\Models\Petani;
use App\Models\KategoriHpt;
use App\Models\BlokLahan;
use Illuminate\Http\Request;

class HptController extends Controller
{
    public function index()
    {
        $hpt = Hpt::with(['petani', 'kategori', 'blok'])->get();
        return view('hpt.index', compact('hpt'));
    }

    public function create()
    {
        $petani = Petani::all();
        $kategori = KategoriHpt::all();
        $blok = BlokLahan::all();

        return view('hpt.create', compact('petani', 'kategori', 'blok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_petani' => 'required',
            'id_kategori' => 'required',
            'id_blok' => 'required',
            'jumlah_hpt' => 'required',
            'tanggal_pemasukan' => 'required',
        ]);

        Hpt::create([
            'id_petani' => $request->id_petani,
            'id_kategori' => $request->id_kategori,
            'id_blok' => $request->id_blok,
            'jumlah_hpt' => $request->jumlah_hpt,
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
        ]);

        return redirect('/hpt')->with('success', 'Data berhasil ditambahkan');
        
    }


    public function edit($id)
    {
        $hpt = Hpt::findOrFail($id);
        return view('hpt.edit', compact('hpt'));
    }

    public function update(Request $request, string $id)
    {
        $hpt = Hpt::findOrFail($id);
        $hpt->update($request->all());
        return redirect()->route('hpt.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Hpt::destroy($id);
        return redirect()->route('hpt.index')->with('success', 'Data berhasil dihapus');
    }
}