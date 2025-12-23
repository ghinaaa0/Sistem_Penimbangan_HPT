<?php

namespace App\Http\Controllers;

use App\Models\JenisHpt;
use Illuminate\Http\Request;

class JenisHptController extends Controller
{
    public function index()
    {
        $jenisHpts = JenisHpt::latest()->get();
        return view('master-data.jenis_hpt', compact('jenisHpts'));
    }

    public function show(JenisHpt $jenis_hpt)
    {
        $jenisHpts = JenisHpt::latest()->get();
        return view('master-data.jenis_hpt', compact('jenisHpts', 'jenis_hpt'));
    }

    public function edit(JenisHpt $jenis_hpt)
    {
        $jenisHpts = JenisHpt::latest()->get();
        return view('master-data.jenis_hpt', compact('jenisHpts', 'jenis_hpt'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_jenis' => 'required|string|max:255',
            ],
            [
                'nama_jenis.required' => 'Nama jenis HPT wajib diisi.',
            ]
        );

        JenisHpt::create($request->only('nama_jenis'));
        return back()->with('success', 'Jenis HPT berhasil ditambahkan.');
    }

    public function update(Request $request, JenisHpt $jenis_hpt)
    {
        $request->validate(
            ['nama_jenis' => 'required|string|max:255'],
            ['nama_jenis.required' => 'Nama jenis HPT wajib diisi.']
        );

        $jenis_hpt->update($request->only('nama_jenis'));
        return redirect()->route('master.jenis.index')->with('success', 'Jenis HPT berhasil diupdate.');
    }

    public function destroy(JenisHpt $jenis_hpt)
    {
        $jenis_hpt->delete();
        return back()->with('success', 'Jenis HPT berhasil dihapus.');
    }
}
