<?php

namespace App\Http\Controllers;

use App\Models\PegawaiTugas;
use App\Models\Tapel;
use App\Models\Semester;
use App\Models\Pendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Pastikan ini ada untuk logging

class PegawaiTugasController extends Controller
{
    /**
     * Menampilkan daftar semua tugas pegawai (pokok dan tambahan) per semester.
     * Secara otomatis memilih Tahun Pelajaran dan Semester yang aktif.
     */
    public function index(Request $request)
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

        $pendidiksWithTasks = collect();

        if ($selectedTapel && $selectedSemester) {
            // Eager load relasi 'tugas' untuk mengurangi query N+1
            $pendidiks = Pendidik::where('status', 'Aktif') // Hanya tampilkan pendidik yang aktif
                                 ->orderBy('nama_lengkap')
                                 ->with(['tugas' => function($query) use ($selectedTapel, $selectedSemester) {
                                     $query->where('tapel_id', $selectedTapel->id)
                                           ->where('semester_id', $selectedSemester->id);
                                 }])
                                 ->get();

            foreach ($pendidiks as $pendidik) {
                // 1. Ambil atau buat objek untuk TUGAS POKOK (tipe = 1, jenis_id = 1)
                $tugasPokok = $pendidik->tugas->where('tipe', 1)->where('jenis_id', 1)->first();

                if (!$tugasPokok) {
                    // Jika tugas pokok belum ada di DB, buat objek baru (tidak disimpan dulu)
                    $tugasPokok = new PegawaiTugas([
                        'pegawai_id' => $pendidik->id,
                        'tapel_id' => $selectedTapel->id,
                        'semester_id' => $selectedSemester->id,
                        'tipe' => 1,
                        'tanggal' => Carbon::now()->format('Y-m-d'),
                        'tmt' => Carbon::now()->format('Y-m-d'), // Default TMT
                        'nomor_sk' => null,
                        'file_sk' => null,
                        'jumlah_jam' => $pendidik->jumlah_jam ?? 0, // Ambil default jumlah_jam dari Pendidik
                        'keterangan' => null,
                        'jenis_id' => 1, // Default jenis_id untuk tugas pokok
                    ]);
                }

                // 2. Hitung TUGAS TAMBAHAN (tipe = 2)
                $tugasTambahanCount = $pendidik->tugas->where('tipe', 2)->count();

                // Lampirkan objek tugas pokok dan hitungan tugas tambahan ke objek pendidik
                $pendidik->tugas_pokok = $tugasPokok;
                $pendidik->tugas_tambahan_count = $tugasTambahanCount;

                $pendidiksWithTasks->push($pendidik);
            }
        }

        return view('pegawai_tugas.index', compact(
            'pendidiksWithTasks',
            'selectedTapel', // Hanya mengirim yang aktif/terpilih
            'selectedSemester' // Hanya mengirim yang aktif/terpilih
        ));
    }

    /**
     * Metode untuk auto-update satu field via AJAX.
     * Ini akan digunakan untuk mengupdate Tugas Pokok.
     */
    public function updateSingleField(Request $request)
    {
        Log::info('Incoming updateSingleField request:', $request->all());

        $request->validate([
            'id' => 'nullable|exists:pegawai_tugas,id', // ID tugas_pokok
            'pegawai_id' => 'required|exists:pendidiks,id',
            'tapel_id' => 'required|exists:tapel,id', // Validasi sesuai nama tabel Anda
            'semester_id' => 'required|exists:semesters,id',
            'tipe' => 'required|in:1,2', // Tipe tugas (1 untuk pokok, 2 untuk tambahan)
            'jenis_id' => 'required|numeric|min:1', // Jenis ID tugas
            'field' => 'required|string|in:jumlah_jam,nomor_sk,tmt,keterangan,tanggal', // Field yang diizinkan untuk diupdate
            'value' => 'nullable',
            'tanggal' => 'nullable|date', // Diperlukan untuk pembuatan baru
            'tmt_default' => 'nullable|date', // Diperlukan untuk pembuatan baru
        ]);

        $pegawaiTugas = null;

        if ($request->filled('id')) {
            // Jika ID disediakan, cari dan perbarui record yang sudah ada
            $pegawaiTugas = PegawaiTugas::find($request->id);
            if ($pegawaiTugas) {
                $pegawaiTugas->{$request->field} = $request->value;
                $pegawaiTugas->save();
                Log::info("Tugas dengan ID {$request->id} berhasil diperbarui. Field: {$request->field}, Value: {$request->value}");
            } else {
                Log::warning("Tugas dengan ID {$request->id} tidak ditemukan saat update.");
                return response()->json([
                    'success' => false,
                    'message' => 'Tugas tidak ditemukan.'
                ], 404);
            }
        } else {
            // Jika tidak ada ID (ini adalah tugas baru), coba temukan atau buat record baru
            $attributes = [
                'pegawai_id' => $request->pegawai_id,
                'tapel_id' => $request->tapel_id,
                'semester_id' => $request->semester_id,
                'tipe' => $request->tipe,
                'jenis_id' => $request->jenis_id,
            ];

            $values = [
                'tanggal' => $request->tanggal ?? Carbon::now()->format('Y-m-d'),
                'tmt' => $request->tmt_default ?? Carbon::now()->format('Y-m-d'), // Menggunakan tmt_default dari frontend
                $request->field => $request->value, // Field spesifik yang sedang diupdate
            ];

            $pegawaiTugas = PegawaiTugas::updateOrCreate($attributes, $values);
            Log::info("Tugas baru dibuat atau diperbarui (ID: {$pegawaiTugas->id})", ['attributes' => $attributes, 'values' => $values]);
        }

        if ($pegawaiTugas) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'id' => $pegawaiTugas->id // Kembalikan ID, terutama jika record baru dibuat
            ]);
        }

        Log::error('Gagal memperbarui atau membuat data tugas pegawai.', ['request' => $request->all()]);
        return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui atau membuat data.'
        ], 500);
    }

    // --- Metode CRUD Individual (untuk mengelola file_sk dan detail yang tidak di edit massal) ---
    // Metode ini akan digunakan saat mengklik tombol "Edit" di kolom Aksi

    public function create()
    {
        $tapels = Tapel::all();
        $semesters = Semester::all();
        $pendidiks = Pendidik::orderBy('nama_lengkap')->get();
        return view('pegawai_tugas.create', compact('tapels', 'semesters', 'pendidiks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tapel_id' => 'required|exists:tapel,id', // Validasi sesuai nama tabel Anda
            'semester_id' => 'required|exists:semesters,id',
            'pegawai_id' => 'required|exists:pendidiks,id',
            'jenis_id' => 'required|numeric|min:1',
            'tipe' => 'required|in:1,2',
            'tanggal' => 'required|date',
            'tmt' => 'required|date',
            'nomor_sk' => 'nullable|string|max:255',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'jumlah_jam' => 'nullable|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $filePath = null;
        if ($request->hasFile('file_sk')) {
            $filePath = $request->file('file_sk')->store('public/sk_files');
            $filePath = Storage::url($filePath);
        }

        PegawaiTugas::create([
            'tapel_id' => $request->tapel_id,
            'semester_id' => $request->semester_id,
            'pegawai_id' => $request->pegawai_id,
            'jenis_id' => $request->jenis_id,
            'tipe' => $request->tipe,
            'tanggal' => $request->tanggal,
            'tmt' => $request->tmt,
            'nomor_sk' => $request->nomor_sk,
            'file_sk' => $filePath,
            'jumlah_jam' => $request->jumlah_jam,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pegawai_tugas.index', [
            'tapel_id' => $request->tapel_id,
            'semester_id' => $request->semester_id
        ])->with('success', 'Data tugas berhasil ditambahkan.');
    }

    public function edit(PegawaiTugas $pegawaiTuga)
    {
        $tapels = Tapel::all();
        $semesters = Semester::all();
        $pendidiks = Pendidik::orderBy('nama_lengkap')->get();
        return view('pegawai_tugas.edit', compact('pegawaiTuga', 'tapels', 'semesters', 'pendidiks'));
    }

    public function update(Request $request, PegawaiTugas $pegawaiTuga)
    {
        $request->validate([
            'tapel_id' => 'required|exists:tapel,id', // Validasi sesuai nama tabel Anda
            'semester_id' => 'required|exists:semesters,id',
            'pegawai_id' => 'required|exists:pendidiks,id',
            'jenis_id' => 'required|numeric|min:1',
            'tipe' => 'required|in:1,2',
            'tanggal' => 'required|date',
            'tmt' => 'required|date',
            'nomor_sk' => 'nullable|string|max:255',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'jumlah_jam' => 'nullable|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except('file_sk');

        if ($request->hasFile('file_sk')) {
            if ($pegawaiTuga->file_sk) {
                $oldFilePath = str_replace('/storage', 'public', $pegawaiTuga->file_sk);
                Storage::delete($oldFilePath);
            }
            $filePath = $request->file('file_sk')->store('public/sk_files');
            $data['file_sk'] = Storage::url($filePath);
        }

        $pegawaiTuga->update($data);

        return redirect()->route('pegawai_tugas.index', [
            'tapel_id' => $request->tapel_id,
            'semester_id' => $request->semester_id
        ])->with('success', 'Data tugas berhasil diperbarui.');
    }

    public function destroy(PegawaiTugas $pegawaiTuga)
    {
        if ($pegawaiTuga->file_sk) {
            $oldFilePath = str_replace('/storage', 'public', $pegawaiTuga->file_sk);
            Storage::delete($oldFilePath);
        }

        $pegawaiTuga->delete();

        return redirect()->back()->with('success', 'Data tugas berhasil dihapus.');
    }
}
