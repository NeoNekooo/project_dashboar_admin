<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tapel;
use App\Models\Semester;
use App\Models\Pendidik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Pastikan ini diimpor
use Illuminate\Support\Facades\Log;

class DaftarKelasController extends Controller
{
    /**
     * Menampilkan daftar semua kelas.
     * Mengambil Tahun Pelajaran dan Semester yang aktif.
     */
    public function index()
    {
        // Ambil Tahun Pelajaran dan Semester yang aktif
        $selectedTapel = Tapel::where('is_active', true)->first();
        $selectedSemester = Semester::where('is_active', true)->first();

        // Jika tidak ada yang aktif, ambil yang terbaru sebagai fallback
        if (!$selectedTapel) {
            $selectedTapel = Tapel::orderBy('id', 'desc')->first();
        }
        if (!$selectedSemester) {
            $selectedSemester = Semester::orderBy('id', 'desc')->first();
        }

        $kelas = collect();
        $pendidiks = collect(); // Untuk dropdown Wali Kelas
        $tingkatKelasOptions = ['X', 'XI', 'XII']; // Opsi Tingkat Kelas
        $paketKeahlianOptions = ['AKL', 'PPLG', 'DKV', 'MPLB', 'TJKT', 'TO']; // Opsi Paket Keahlian dari gambar

        if ($selectedTapel && $selectedSemester) {
            $kelas = Kelas::where('tapel_id', $selectedTapel->id)
                          ->where('semester_id', $selectedSemester->id)
                          ->with('waliKelas') // Eager load wali kelas
                          ->orderBy('tingkat_kelas')
                          ->orderBy('paket_keahlian')
                          ->orderBy('rombel_grup')
                          ->get();

            // Ambil semua pendidik aktif untuk dropdown wali kelas
            $pendidiks = Pendidik::where('status', 'Aktif')->orderBy('nama_lengkap')->get();
        }

        return view('daftar_kelas.index', compact(
            'kelas',
            'selectedTapel',
            'selectedSemester',
            'pendidiks',
            'tingkatKelasOptions',
            'paketKeahlianOptions'
        ));
    }

    /**
     * Menyimpan kelas baru ke database.
     */
    public function store(Request $request)
    {
        $selectedTapel = Tapel::where('is_active', true)->first();
        $selectedSemester = Semester::where('is_active', true)->first();

        if (!$selectedTapel || !$selectedSemester) {
            return redirect()->back()->withErrors(['message' => 'Tidak ada Tahun Pelajaran atau Semester yang aktif ditemukan.']);
        }

        // Aturan validasi unik di sini (sisi aplikasi)
        $request->validate([
            'tingkat_kelas' => ['required', 'string', Rule::in(['X', 'XI', 'XII'])],
            'paket_keahlian' => ['required', 'string', Rule::in(['AKL', 'PPLG', 'DKV', 'MPLB', 'TJKT', 'TO'])],
            'rombel_grup' => [
                'required',
                'string',
                'max:255',
                // Validasi unique di sini
                Rule::unique('kelas')->where(function ($query) use ($request, $selectedTapel, $selectedSemester) {
                    return $query->where('tapel_id', $selectedTapel->id)
                                 ->where('semester_id', $selectedSemester->id)
                                 ->where('tingkat_kelas', $request->tingkat_kelas)
                                 ->where('paket_keahlian', $request->paket_keahlian)
                                 ->where('rombel_grup', $request->rombel_grup);
                }),
            ],
            'wali_kelas_id' => 'nullable|exists:pendidiks,id',
        ], [
            'rombel_grup.unique' => 'Kombinasi Kelas, Paket Keahlian, dan Rombel/Grup ini sudah ada untuk Tahun Pelajaran dan Semester aktif.'
        ]);

        Kelas::create([
            'tapel_id' => $selectedTapel->id,
            'semester_id' => $selectedSemester->id,
            'tingkat_kelas' => $request->tingkat_kelas,
            'paket_keahlian' => $request->paket_keahlian,
            'rombel_grup' => $request->rombel_grup,
            'wali_kelas_id' => $request->wali_kelas_id,
        ]);

        return redirect()->route('daftar_kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Menghapus kelas dari database.
     */
    public function destroy(Kelas $daftar_kela)
    {
        try {
            $daftar_kela->delete();
            return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus kelas: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Gagal menghapus kelas. Terjadi kesalahan.']);
        }
    }

    /**
     * Memperbarui wali kelas via AJAX.
     */
    public function updateWaliKelas(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'wali_kelas_id' => 'nullable|exists:pendidiks,id',
        ]);

        $kelas = Kelas::find($request->kelas_id);
        if (!$kelas) {
            return response()->json(['success' => false, 'message' => 'Kelas tidak ditemukan.'], 404);
        }

        $kelas->wali_kelas_id = $request->wali_kelas_id;
        $kelas->save();

        return response()->json(['success' => true, 'message' => 'Wali Kelas berhasil diperbarui.']);
    }
}
