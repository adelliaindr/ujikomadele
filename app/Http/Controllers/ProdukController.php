<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::latest();

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $produk = $query->paginate(9);

        return view('produk.index', compact('produk'));
    }

    public function show($slug)
    {
        $item = Produk::where('slug', $slug)->firstOrFail();
        $related = Produk::where('kategori', $item->kategori)
            ->where('id', '!=', $item->id)
            ->take(3)
            ->get();

        return view('produk.show', compact('item', 'related'));
    }
}
