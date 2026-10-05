<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;

class PesanKontakController extends Controller
{
    public function index()
    {
        $pesan = PesanKontak::latest()->get();
        return view('admin.kontak.index', compact('pesan'));
    }

    public function show($id)
    {
        $pesan = PesanKontak::findOrFail($id);
        if (!$pesan->is_read) {
            $pesan->update(['is_read' => true]);
        }
        return view('admin.kontak.show', compact('pesan'));
    }

    public function destroy($id)
    {
        $pesan = PesanKontak::findOrFail($id);
        $pesan->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }
}
