<?php

namespace App\Http\Controllers;

use App\Models\Pendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendidikController extends Controller
{
    public function index()
    {
        // Ambil hanya pendidik dengan status 'Aktif' dan tipe 'Pendidik'
        $pendidiks = Pendidik::where('status', 'Aktif')
                             ->where('tipe_pegawai', 'Pendidik') // Filter hanya untuk tipe 'Pendidik'
                             ->orderBy('nama_lengkap', 'asc')
                             ->get();

        return view('kepegawaian.pendidik.index', compact('pendidiks'));
    }

    public function inactivePendidiks()
    {
        // Ambil semua pegawai dengan status 'Tidak Aktif', baik Pendidik maupun Tenaga Kependidikan
        $pendidiks = Pendidik::where('status', 'Tidak Aktif') // Filter hanya berdasarkan status 'Tidak Aktif'
                             ->orderBy('nama_lengkap', 'asc')
                             ->get();

        return view('kepegawaian.pendidik.inactive_index', compact('pendidiks'));
    }

    /**
     * Menampilkan daftar tenaga kependidikan aktif.
     * Data yang diambil adalah semua pendidik yang tipe_pegawai-nya BUKAN 'Pendidik' dan berstatus 'Aktif'.
     *
     * @return \Illuminate\Http\Response
     */
    public function tenagaKependidikanIndex()
    {
        // Ambil tenaga kependidikan yang aktif (tipe_pegawai BUKAN 'Pendidik' dan status 'Aktif')
        $tenagaKependidikan = Pendidik::where('tipe_pegawai', '!=', 'Pendidik')
                                      ->where('status', 'Aktif')
                                      ->orderBy('nama_lengkap', 'asc')
                                      ->get();

        return view('kepegawaian.tenaga_kependidikan.index', compact('tenagaKependidikan'));
    }

    /**
     * Menampilkan daftar tenaga kependidikan tidak aktif.
     * Data yang diambil adalah semua pendidik yang tipe_pegawai-nya BUKAN 'Pendidik' dan berstatus 'Tidak Aktif'.
     *
     * @return \Illuminate\Http\Response
     */
    public function inactiveTenagaKependidikan()
    {
        // Ambil tenaga kependidikan yang tidak aktif (tipe_pegawai BUKAN 'Pendidik' dan status 'Tidak Aktif')
        $tenagaKependidikan = Pendidik::where('tipe_pegawai', '!=', 'Pendidik')
                                      ->where('status', 'Tidak Aktif')
                                      ->orderBy('nama_lengkap', 'asc')
                                      ->get();

        return view('kepegawaian.tenaga_kependidikan.inactive_index', compact('tenagaKependidikan'));
    }

    public function create()
    {
        $pendidik = new Pendidik();
        return view('kepegawaian.pendidik.form', compact('pendidik'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:1',
            'nik_niy_npsn' => 'nullable|string|max:255|unique:pendidiks,nik_niy_npsn',
            'nuptk' => 'nullable|string|max:255|unique:pendidiks,nuptk',
            'nip' => 'nullable|string|max:255|unique:pendidiks,nip',
            'npwp' => 'nullable|string|max:255',
            'kewarganegaraan' => 'nullable|string|max:10',
            'agama' => 'nullable|string|max:50',
            'nama_ibu_kandung' => 'nullable|string|max:255',
            'status_pernikahan' => 'nullable|string|max:50',
            'nama_suami_istri' => 'nullable|string|max:255',
            'jumlah_anak' => 'nullable|integer',
            'alamat' => 'nullable|string',
            'kecamatan' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:255',
            'tandatangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jumlah_jam' => 'nullable|integer',
            'tipe_pegawai' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('public/pendidik_photos');
        }
        if ($request->hasFile('tandatangan')) {
            $validatedData['tandatangan'] = $request->file('tandatangan')->store('public/pendidik_signatures');
        }

        Pendidik::create($validatedData);

        // Redirect berdasarkan tipe_pegawai yang baru ditambahkan
        if ($validatedData['tipe_pegawai'] == 'Pendidik') {
            return redirect()->route('kepegawaian.pendidik.index')
                             ->with('success', 'Data Pendidik berhasil ditambahkan.');
        } else {
            return redirect()->route('kepegawaian.tenaga_kependidikan.index')
                             ->with('success', 'Data Tenaga Kependidikan berhasil ditambahkan.');
        }
    }

    public function show(Pendidik $pendidik)
    {
        return view('kepegawaian.pendidik.show', compact('pendidik'));
    }

    public function edit(Pendidik $pendidik)
    {
        return view('kepegawaian.pendidik.form', compact('pendidik'));
    }

    public function update(Request $request, Pendidik $pendidik)
    {
        $validatedData = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:1',
            'nik_niy_npsn' => 'nullable|string|max:255|unique:pendidiks,nik_niy_npsn,' . $pendidik->id,
            'nuptk' => 'nullable|string|max:255|unique:pendidiks,nuptk,' . $pendidik->id,
            'nip' => 'nullable|string|max:255|unique:pendidiks,nip,' . $pendidik->id,
            'npwp' => 'nullable|string|max:255',
            'kewarganegaraan' => 'nullable|string|max:10',
            'agama' => 'nullable|string|max:50',
            'nama_ibu_kandung' => 'nullable|string|max:255',
            'status_pernikahan' => 'nullable|string|max:50',
            'nama_suami_istri' => 'nullable|string|max:255',
            'jumlah_anak' => 'nullable|integer',
            'alamat' => 'nullable|string',
            'kecamatan' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:255',
            'tandatangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jumlah_jam' => 'nullable|integer',
            'tipe_pegawai' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('foto')) {
            if ($pendidik->foto) {
                Storage::delete($pendidik->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('public/pendidik_photos');
        }
        if ($request->hasFile('tandatangan')) {
            if ($pendidik->tandatangan) {
                Storage::delete($pendidik->tandatangan);
            }
            $validatedData['tandatangan'] = $request->file('tandatangan')->store('public/pendidik_signatures');
        }

        $pendidik->update($validatedData);

        // Redirect berdasarkan tipe_pegawai setelah update
        if ($pendidik->tipe_pegawai == 'Pendidik') {
            if ($pendidik->status === 'Tidak Aktif') {
                return redirect()->route('kepegawaian.pendidik.inactive')
                                 ->with('success', 'Data Pendidik berhasil diperbarui dan status menjadi Tidak Aktif.');
            }
            return redirect()->route('kepegawaian.pendidik.index')
                             ->with('success', 'Data Pendidik berhasil diperbarui.');
        } else {
            // Untuk tenaga kependidikan, selalu kembali ke daftar tenaga kependidikan aktif
            // Jika statusnya 'Tidak Aktif', akan otomatis masuk ke daftar tidak aktif
            return redirect()->route('kepegawaian.tenaga_kependidikan.index')
                             ->with('success', 'Data Tenaga Kependidikan berhasil diperbarui.');
        }
    }

    public function deactivate(Pendidik $pendidik)
    {
        $pendidik->update(['status' => 'Tidak Aktif']);

        // Redirect berdasarkan tipe_pegawai
        if ($pendidik->tipe_pegawai == 'Pendidik') {
            return redirect()->route('kepegawaian.pendidik.index')
                             ->with('success', 'Status Pendidik berhasil diubah menjadi Tidak Aktif.');
        } else {
            // Jika tenaga kependidikan, redirect ke daftar tenaga kependidikan tidak aktif
            return redirect()->route('kepegawaian.tenaga_kependidikan.inactive')
                             ->with('success', 'Status Tenaga Kependidikan berhasil diubah menjadi Tidak Aktif.');
        }
    }

    public function activate(Pendidik $pendidik)
    {
        $pendidik->update(['status' => 'Aktif']);

        // Redirect berdasarkan tipe_pegawai
        if ($pendidik->tipe_pegawai == 'Pendidik') {
            return redirect()->route('kepegawaian.pendidik.inactive')
                             ->with('success', 'Status Pendidik berhasil diubah menjadi Aktif.');
        } else {
            // Jika tenaga kependidikan, redirect ke daftar tenaga kependidikan aktif
            return redirect()->route('kepegawaian.tenaga_kependidikan.index')
                             ->with('success', 'Status Tenaga Kependidikan berhasil diubah menjadi Aktif.');
        }
    }

    public function destroy(Pendidik $pendidik)
    {
        // Simpan tipe_pegawai sebelum dihapus untuk redirect yang benar
        $tipePegawai = $pendidik->tipe_pegawai;

        if ($pendidik->foto) {
            Storage::delete($pendidik->foto);
        }
        if ($pendidik->tandatangan) {
            Storage::delete($pendidik->tandatangan);
        }

        $pendidik->delete();

        // Redirect berdasarkan tipe_pegawai yang dihapus
        if ($tipePegawai == 'Pendidik') {
            return back()->with('success', 'Data Pendidik berhasil dihapus.');
        } else {
            return back()->with('success', 'Data Tenaga Kependidikan berhasil dihapus.');
        }
    }
}
