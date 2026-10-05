<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStrukturController extends Controller
{
    /**
     * Form tambah jabatan.
     */
    public function create()
    {
        $urutanDefault = (StrukturOrganisasi::max('urutan') ?? 0) + 1;

        return view('admin.struktur.create', compact('urutanDefault'));
    }

    /**
     * Simpan jabatan baru.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.profil.index')->with('success', 'Struktur organisasi berhasil ditambahkan!');
    }

    /**
     * Form edit jabatan.
     */
    public function edit(StrukturOrganisasi $struktur)
    {
        return view('admin.struktur.edit', compact('struktur'));
    }

    /**
     * Simpan perubahan jabatan.
     */
    public function update(Request $request, StrukturOrganisasi $struktur)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        } elseif ($request->boolean('hapus_foto')) {
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }
            $data['foto'] = null;
        }

        $struktur->update($data);

        return redirect()->route('admin.profil.index')->with('success', 'Struktur organisasi berhasil diperbarui!');
    }

    /**
     * Hapus jabatan beserta fotonya.
     */
    public function destroy(StrukturOrganisasi $struktur)
    {
        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('admin.profil.index')->with('success', 'Struktur organisasi berhasil dihapus!');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan'  => 'required|integer|min:1',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }
}