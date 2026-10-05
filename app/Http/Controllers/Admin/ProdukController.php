<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
{
    return view('admin.produk.create');
}

public function edit(Produk $produk)
{
    return view('admin.produk.edit', compact('produk'));
}

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pembuat' => 'nullable|string|max:255',
            'link_demo' => 'nullable|url|max:255',
        ]);

        $fotoPath = $request->file('foto')->store('produk', 'public');

        Produk::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'pembuat' => $request->pembuat,
            'link_demo' => $request->link_demo,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Karya berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pembuat' => 'nullable|string|max:255',
            'link_demo' => 'nullable|url|max:255',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'pembuat' => $request->pembuat,
            'link_demo' => $request->link_demo,
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Karya berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk/Karya berhasil dihapus!');
    }
}
