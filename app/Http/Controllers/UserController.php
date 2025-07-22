<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mengakses pengguna yang sedang login
use Illuminate\Support\Facades\Storage; // Untuk mengelola penyimpanan file
use Illuminate\Validation\Rule; // Untuk validasi unik email saat update

class UserController extends Controller
{
    /**
     * Menampilkan dashboard pengguna (sesuai yang sudah ada).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.dashboard'); // View ini akan dibuat di langkah selanjutnya
    }

    /**
     * Menampilkan form profil pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('user.profile', compact('user')); // Melemparkan data user ke view 'user.profile'
    }

    /**
     * Memperbarui data profil pengguna yang sedang login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Mengambil pengguna yang sedang login

        // 1. Validasi Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Validasi email unik, kecuali untuk email pengguna saat ini
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            // Validasi untuk foto profil
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
        ]);

        // 2. Handle Upload Foto Profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada dan bukan foto default
            if ($user->profile_photo_path && Storage::disk('public')->exists('profile-photos/' . $user->profile_photo_path)) {
                Storage::disk('public')->delete('profile-photos/' . $user->profile_photo_path);
            }

            // Simpan foto baru ke direktori 'public/profile-photos'
            // store() akan mengembalikan path relatif dari root disk (misal: 'public/profile-photos/namafile.jpg')
            $path = $request->file('profile_photo')->store('profile-photos', 'public');

            // Simpan hanya path relatif yang bisa diakses publik (tanpa 'public/') ke database
            $validatedData['profile_photo_path'] = $path;
        }

        // 3. Update Data Pengguna
        $user->update($validatedData);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}