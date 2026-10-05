<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //Halaman Frontend Profil
    public function index()
{
    // updateOrCreate akan memperbarui data ID 1 jika sudah ada, atau membuatnya jika belum ada
    $profile = Profile::updateOrCreate(
        ['id' => 1],
        [
            'nama_sekolah' => 'SMKN 4 Bogor',
            'visi' => 'Terwujudnya Sekolah Menengah Kejuruan yang unggul, berkarakter, berwawasan lingkungan, dan menghasilkan lulusan yang kompeten serta berdaya saing global.',
            'misi' => [
                'Menyelenggarakan pembelajaran berbasis kompetensi dan teknologi informasi.',
                'Meningkatkan kerja sama industri (DUDI) nasional dan internasional.',
                'Membentuk karakter peserta didik yang disiplin, kreatif, dan berakhlak mulia.'
            ],
            'sejarah' => 'SMKN 4 Bogor didirikan untuk menjawab kebutuhan tenaga kerja terampil di bidang teknologi.',
        ]
    );

    $pengurus = StrukturOrganisasi::orderBy('urutan', 'asc')->get();

    return view('profil.index', compact('profile', 'pengurus'));
}

    // Halaman Admin / Dashboard Edit Profil
    public function edit()
    {
        $profile = Profile::firstOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'SMKN 4 Bogor',
                'visi' => 'Menjadi Sekolah Menengah Kejuruan unggulan berstandar nasional.',
                'misi' => ['Mewujudkan SDM berkualitas', 'Mengembangkan sarana prasarana modern'],
            ]
        );
        $pengurus = StrukturOrganisasi::orderBy('urutan', 'asc')->get();

        return view('admin.profil.edit', compact('profile', 'pengurus'));
    }

    // Update Visi, Misi & Sejarah
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'visi'         => 'required|string',
            'misi'         => 'required|array',
            'misi.*'       => 'required|string',
            'sejarah'      => 'nullable|string',
            'foto_sekolah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $profile = Profile::first();

        $data = [
            'nama_sekolah' => $request->nama_sekolah,
            'visi'         => $request->visi,
            'misi'         => array_values(array_filter($request->misi)), // Filter input kosong
            'sejarah'      => $request->sejarah,
        ];

        if ($request->hasFile('foto_sekolah')) {
            if ($profile->foto_sekolah) {
                Storage::delete('public/' . $profile->foto_sekolah);
            }
            $data['foto_sekolah'] = $request->file('foto_sekolah')->store('profil', 'public');
        }

        $profile->update($data);

        return back()->with('success', 'Profil sekolah berhasil diperbarui!');
    }

    // Store Anggota Struktur Organisasi
    public function storeStruktur(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan'  => 'required|integer',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('struktur', 'public');
        }

        StrukturOrganisasi::create([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'urutan'  => $request->urutan,
            'foto'    => $fotoPath,
        ]);

        return back()->with('success', 'Anggota struktur organisasi berhasil ditambahkan!');
    }

    // Destroy Anggota Struktur
    public function destroyStruktur(StrukturOrganisasi $struktur)
    {
        if ($struktur->foto) {
            Storage::delete('public/' . $struktur->foto);
        }
        $struktur->delete();

        return back()->with('success', 'Anggota struktur berhasil dihapus!');
    }
}
