<?php

namespace App\Http\Controllers;

use App\Models\Tapel;
use Illuminate\Http\Request;

class TapelController extends Controller
{
    /**
     * Display a listing of the resource.
     * Mengambil semua Tahun Pelajaran dan yang aktif untuk ditampilkan di daftar.
     */
    public function index()
    {
        // Mengambil semua data Tahun Pelajaran, diurutkan berdasarkan tahun_pelajaran secara ascending
        $allTapel = Tapel::orderBy('tahun_pelajaran', 'asc')->get();
        // Mengambil Tahun Pelajaran yang statusnya aktif (is_active = true)
        $activeTapel = Tapel::where('is_active', true)->first();

        // Mengirim koleksi $allTapel (untuk daftar tabel) dan $activeTapel (untuk penanda/informasi tahun aktif) ke view
        return view('akademik.tapel.index', compact('allTapel', 'activeTapel'));
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan Tahun Pelajaran baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari request
        $request->validate([
            'tahun_pelajaran' => 'required|string|max:9|unique:tapel,tahun_pelajaran', // Perbaikan: Gunakan nama tabel 'tapel' bukan 'tapel'
            'keterangan' => 'nullable|string',
            // 'is_active' tidak perlu divalidasi di sini jika defaultnya false atau diatur di toggleActive
        ]);

        // Membuat record Tahun Pelajaran baru di database
        Tapel::create($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('akademik.tapel.index')
                            ->with('success', 'Tahun Pelajaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit untuk Tahun Pelajaran tertentu.
     */
    public function edit(Tapel $tapel) // Route Model Binding: $tapel otomatis terisi dengan instance Tapel
    {
        // Mengambil semua Tahun Pelajaran untuk daftar tabel (sama seperti di index)
        $allTapel = Tapel::orderBy('tahun_pelajaran', 'asc')->get();
        // Mengambil Tahun Pelajaran yang aktif (sama seperti di index)
        $activeTapel = Tapel::where('is_active', true)->first();

        // Mengirim $allTapel (koleksi), $tapel (instance yang akan diedit), dan $activeTapel ke view
        // View 'akademik.tapel.index' digunakan juga untuk edit, yang berarti form edit muncul di halaman yang sama dengan daftar.
        return view('akademik.tapel.index', compact('allTapel', 'tapel', 'activeTapel'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui data Tahun Pelajaran di database.
     */
    public function update(Request $request, Tapel $tapel)
    {
        // Validasi data yang masuk untuk update
        $request->validate([
            // 'unique:tapel,tahun_pelajaran,' . $tapel->id: Memastikan tahun_pelajaran unik, kecuali untuk record yang sedang diedit
            'tahun_pelajaran' => 'required|string|max:9|unique:tapel,tahun_pelajaran,' . $tapel->id, // Perbaikan: Gunakan nama tabel 'tapel'
            'keterangan' => 'nullable|string',
        ]);

        // Memperbarui record Tahun Pelajaran di database
        $tapel->update($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('akademik.tapel.index')
                            ->with('success', 'Tahun Pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus Tahun Pelajaran dari database.
     */
    public function destroy(Tapel $tapel)
    {
        // Pencegahan: Tidak bisa menghapus Tahun Pelajaran yang sedang aktif
        if ($tapel->is_active) {
            return redirect()->route('akademik.tapel.index')
                             ->with('error', 'Tidak bisa menghapus tahun pelajaran yang aktif.');
        }

        // Menghapus record Tahun Pelajaran
        $tapel->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('akademik.tapel.index')
                            ->with('success', 'Tahun Pelajaran berhasil dihapus.');
    }

    /**
     * Toggle the active status of a Tahun Pelajaran.
     * Mengaktifkan Tahun Pelajaran tertentu dan menonaktifkan yang lainnya.
     */
    public function toggleActive(Tapel $tapel)
    {
        // Menonaktifkan semua Tahun Pelajaran lain yang sedang aktif
        Tapel::where('is_active', true)->update(['is_active' => false]);
        // Mengaktifkan Tahun Pelajaran yang dipilih
        $tapel->update(['is_active' => true]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('akademik.tapel.index')
                            ->with('success', 'Tahun Pelajaran berhasil diaktifkan.');
    }
}