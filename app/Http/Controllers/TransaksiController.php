<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        $order = Order::all();

        return view('pages.transaksi.index', compact('order'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'nama_customer' => 'required|string|max:255',
        ]);

        $order = Order::create($data);

        return redirect()->route('transaksi.create', $order->id);
    }

    public function create($id)
    {
        $order = Order::findOrFail($id);
        $produk = Produk::all();

        return view('pages.transaksi.create', compact('order', 'produk'));
    }

    public function getOrder($id)
    {
        $order = OrderDetail::where('order_id', $id)->get()->count();

        return response()->json($order, 200);
    }

    public function addItem(Request $request, $id)
    {
        $produk = Produk::findOrFail($request->produk_id);

        $order_details = OrderDetail::create([
            'order_id' => $id,
            'produk_id' => $produk->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->jumlah * $produk->harga,
        ]);

        if ($order_details) {
            return response()->json([$order_details, 200, 'message'=> 'Berhasil menambahkan item']);
        }

        return response()->json(['error' => 'Gagal menambahkan item'], 500);
    }

    public function getOrderDetail($id)
    {
        $order = OrderDetail::where('order_id', $id)->with('produk', 'order')->get();

        if ($order) {
            return response()->json($order, 200);
        } else if ($order == null) {
            return response()->json(['error' => 'Gagal mengambil data'], 500);
        } else {
            abort(401, 'Silahkan login terlebih dahulu');
        }
    }

    public function deleteItem(Request $request, $id)
    {
        $order = OrderDetail::findOrFail($id);

        if ($order->delete()) {
            return response()->json([$order, 200, 'message'=> 'Berhasil menghapus item']);
        }

        return response()->json(['error' => 'Gagal menghapus item'], 500);
    }

    public function checkout($id)
    {
        $order = Order::findOrFail($id);
        $orderDetail = OrderDetail::where('order_id', $id)->get();

        $total = $orderDetail->sum('total_harga');

        $order->update([
            'total_harga' => $total,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Berhasil checkout');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderDetail = OrderDetail::where('order_id', $id)->with('produk', 'order')->get();

        return view('pages.transaksi.detail', compact('orderDetail', 'order'));
    }
}
