<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $petanis = Petani::latest()->get();
        return view('master-data.petani', compact('petanis'));
    }

    public function show(Petani $petani)
    {
        $petanis = Petani::latest()->get();
        return view('master-data.petani', compact('petanis', 'petani'));
    }

    public function edit(Petani $petani)
    {
        $petanis = Petani::latest()->get();
        return view('master-data.petani', compact('petanis', 'petani'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama'   => 'required|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'no_hp'  => 'required|numeric|digits_between:12,15',
            ],
            [
                'nama.required' => 'Nama petani wajib diisi',
                'no_hp.required' => 'Nomor HP wajib diisi',
                'no_hp.numeric' => 'Nomor HP harus berupa angka',
                'no_hp.digits_between' => 'Nomor HP minimal 12 angka',
            ]
        );

        Petani::create($request->only('nama', 'alamat', 'no_hp'));
        return back()->with('success', 'Data petani berhasil ditambahkan');
    }

    public function update(Request $request, Petani $petani)
    {
        $request->validate(
            [
                'nama'   => 'required|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'no_hp'  => 'required|numeric|digits_between:12,15',
            ],
            [
                'nama.required' => 'Nama petani wajib diisi',
                'no_hp.required' => 'Nomor HP wajib diisi',
                'no_hp.numeric' => 'Nomor HP harus berupa angka',
                'no_hp.digits_between' => 'Nomor HP minimal 12 angka',
            ]
        );

        $petani->update($request->only('nama', 'alamat', 'no_hp'));
        return redirect()->route('master.petani.index')->with('success', 'Data petani berhasil diupdate');
    }

    public function destroy(Petani $petani)
    {
        try {
            $petani->delete();
            return back()->with('success', 'Data petani berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal menghapus data petani');
        }
    }
}
