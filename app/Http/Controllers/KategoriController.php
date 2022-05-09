<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        return view('pages.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        Kategori::create($data);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        Kategori::find($id)->update($data);

        return redirect()->back()->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
