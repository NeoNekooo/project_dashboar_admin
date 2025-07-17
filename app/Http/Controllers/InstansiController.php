<?php

namespace App\Http\Controllers;

use App\Models\Instansi; // Ubah ini dari Institution menjadi Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstansiController extends Controller
{
    /**
     * Menampilkan form profil instansi dengan data yang ada.
     */
    public function index()
    {
        $instansi = Instansi::firstOrCreate([]); // Ubah ini
        return view('instansi.profile', compact('instansi')); // Ubah ini
    }

    /**
     * Memperbarui atau menyimpan data profil instansi.
     */
    public function update(Request $request)
    {
        $instansi = Instansi::firstOrCreate([]); // Ubah ini

        $validatedData = $request->validate([
            'nama_instansi' => 'nullable|string|max:255',
            'bidang_studi' => 'nullable|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'tahun_berdiri' => 'nullable|integer|digits:4',
            'status' => 'nullable|string|max:255',
            'nss' => 'nullable|string|max:255',
            'kode' => 'nullable|string|max:255',
            'npsn' => 'nullable|string|max:255',
            'nama_kepala_aktif' => 'nullable|string|max:255',
            'luas' => 'nullable|string|max:255',
            'nip_kepala_aktif' => 'nullable|string|max:255',
            'moto' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alamat' => 'nullable|string',
            'telpon' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'rss' => 'nullable|url|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'situs' => 'nullable|url|max:255',
            'google_plus' => 'nullable|url|max:255',
            'provinsi' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'dribble' => 'nullable|url|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'x' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'map' => 'nullable|string',
        ]);

        // Proses upload Logo
        if ($request->hasFile('logo')) {
            if ($instansi->logo && Storage::disk('public')->exists($instansi->logo)) {
                Storage::disk('public')->delete($instansi->logo);
            }
            $logoPath = $request->file('logo')->store('uploads/instansis/logo', 'public'); // Ubah path folder
            $validatedData['logo'] = $logoPath;
        }

        // Proses upload Icon
        if ($request->hasFile('icon')) {
            if ($instansi->icon && Storage::disk('public')->exists($instansi->icon)) {
                Storage::disk('public')->delete($instansi->icon);
            }
            $iconPath = $request->file('icon')->store('uploads/instansis/icon', 'public'); // Ubah path folder
            $validatedData['icon'] = $iconPath;
        }

        $instansi->update($validatedData); // Ubah ini

        return redirect()->back()->with('success', 'Profil instansi berhasil diperbarui!');
    }
}