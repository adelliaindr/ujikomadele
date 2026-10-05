<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    /**
     * Menampilkan halaman detail profil sekolah & struktur organisasi.
     */
    public function index()
    {
        $profile = Profile::first();
        $struktur = StrukturOrganisasi::orderBy('urutan', 'asc')->get();

        return view('admin.profil.index', compact('profile', 'struktur'));
    }

    /**
     * Menampilkan form edit profil sekolah.
     */
    public function edit()
    {
        $profile = Profile::first();

        return view('admin.profil.edit', compact('profile'));
    }

    /**
     * Menyimpan perubahan profil sekolah.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'sambutan'     => 'nullable|string',
            'visi'         => 'nullable|string',
            'misi'         => 'nullable|string',
            'sejarah'      => 'nullable|string',
        ]);

        $profile = Profile::first();

        if (!$profile) {
            $profile = new Profile();
        }

        $profile->nama_sekolah = $request->nama_sekolah;
        $profile->sambutan     = $request->sambutan;
        $profile->visi         = $request->visi;
        $profile->misi         = $request->misi;
        $profile->sejarah      = $request->sejarah;
        $profile->save();

        return redirect()->route('admin.profil.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}