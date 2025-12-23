<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Petani;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajians = Penggajian::with('petani')
            ->latest()
            ->get();

        return view('penggajian.index', compact('penggajians'));
    }

    public function create()
    {
        $petanis = Petani::orderBy('nama')->get();
        return view('penggajian.form', compact('petanis'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id_petani'     => 'required|exists:petani,id_petani',
                'tanggal_gaji'  => 'required|date',
                'status'        => 'required|in:DIBAYAR,BELUM',
                'total_amount'  => 'required|numeric|min:0',
            ],
            [
                'id_petani.required'    => 'Petani wajib dipilih.',
                'tanggal_gaji.required' => 'Tanggal gaji wajib diisi.',
                'total_amount.required' => 'Total gaji wajib diisi.',
                'total_amount.numeric'  => 'Total gaji harus berupa angka.',
            ]
        );

        Penggajian::create($request->all());

        return redirect()
            ->route('penggajian.index')
            ->with('success', 'Data upah harian berhasil disimpan.');
    }

    public function show(Penggajian $penggajian)
    {
        $petanis = Petani::orderBy('nama')->get();
        return view('penggajian.form', compact('petanis', 'penggajian'));
    }

    public function edit(Penggajian $penggajian)
    {
        $petanis = Petani::orderBy('nama')->get();
        return view('penggajian.form', compact('petanis', 'penggajian'));
    }

    public function update(Request $request, Penggajian $penggajian)
    {
        $request->validate(
            [
                'id_petani'     => 'required|exists:petani,id_petani',
                'tanggal_gaji'  => 'required|date',
                'status'        => 'required|in:DIBAYAR,BELUM',
                'total_amount'  => 'required|numeric|min:0',
            ]
        );

        $penggajian->update($request->all());

        return redirect()
            ->route('penggajian.index')
            ->with('success', 'Data upah harian berhasil diperbarui.');
    }

    public function destroy(Penggajian $penggajian)
    {
        $penggajian->delete();
        return back()->with('success', 'Data upah harian berhasil dihapus.');
    }
}
