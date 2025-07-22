<?php

namespace App\Http\Controllers;

use App\Models\Tapel;
use Illuminate\Http\Request;

class TapelController extends Controller
{
    public function index()
    {
        // Ubah nama variabel koleksi dari $tapel menjadi $allTapel
        $allTapel = Tapel::orderBy('tahun_pelajaran', 'asc')->get();
        $activeTapel = Tapel::where('is_active', true)->first();

        // Kirim $allTapel (koleksi) dan $activeTapel (single model/null) ke view
        return view('akademik.tapel.index', compact('allTapel', 'activeTapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_pelajaran' => 'required|string|max:9|unique:tapel,tahun_pelajaran',
            'keterangan' => 'nullable|string',
        ]);

        Tapel::create($request->all());

        return redirect()->route('akademik.tapel.index')
                         ->with('success', 'Tahun Pelajaran berhasil ditambahkan.');
    }

    public function edit(Tapel $tapel) // $tapel di sini adalah single model instance dari Route Model Binding
    {
        // $allTapel adalah koleksi semua tahun pelajaran untuk daftar tabel
        $allTapel = Tapel::orderBy('tahun_pelajaran', 'asc')->get();
        $activeTapel = Tapel::where('is_active', true)->first();

        // Kirim $allTapel (koleksi), $tapel (single model untuk form edit), dan $activeTapel ke view
        return view('akademik.tapel.index', compact('allTapel', 'tapel', 'activeTapel'));
    }

    public function update(Request $request, Tapel $tapel)
    {
        $request->validate([
            'tahun_pelajaran' => 'required|string|max:9|unique:tapel,tahun_pelajaran,' . $tapel->id,
            'keterangan' => 'nullable|string',
        ]);

        $tapel->update($request->all());

        return redirect()->route('akademik.tapel.index')
                         ->with('success', 'Tahun Pelajaran berhasil diperbarui.');
    }

    public function destroy(Tapel $tapel)
    {
        if ($tapel->is_active) {
            return redirect()->route('akademik.tapel.index')
                             ->with('error', 'Tidak bisa menghapus tahun pelajaran yang aktif.');
        }

        $tapel->delete();

        return redirect()->route('akademik.tapel.index')
                         ->with('success', 'Tahun Pelajaran berhasil dihapus.');
    }

    public function toggleActive(Tapel $tapel)
    {
        Tapel::where('is_active', true)->update(['is_active' => false]);
        $tapel->update(['is_active' => true]);

        return redirect()->route('akademik.tapel.index')
                         ->with('success', 'Tahun Pelajaran berhasil diaktifkan.');
    }
}