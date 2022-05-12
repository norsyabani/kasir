<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $produk = Produk::all();

        return view('pages.produk.index', compact('kategori', 'produk'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'harga' => 'required',
            'ketersediaan' => 'required|boolean',
        ]);

        $data['harga'] = str_replace(',', '', $data['harga']);
        $data['harga'] = str_replace('.', '', $data['harga']);

        Produk::create($data);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kategori_id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'ketersediaan' => 'required|boolean',
        ]);

        Produk::find($id)->update($data);

        return redirect()->back()->with('success', 'Produk berhasil diubah');
    }

    public function destroy($id)
    {
        Produk::find($id)->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
