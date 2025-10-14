<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenjualan;
use App\Models\DetailTransakiPenjualan;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiPenjualanController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiPenjualan::with('details')->latest()-> paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $products = Product::orderBy('title')->get();
        return view('transaksi.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi sederhana
    $request->validate([
        'nama_kasir' => 'required|string',
        'email_pembeli' => 'required|email',
        'tanggal_transaksi' => 'required|date',
        'product_id' => 'required|array',
        'jumlah_pembelian' => 'required|array',
    ]);

    // Simpan data utama transaksi
    $transaksi = TransaksiPenjualan::create([
        'nama_kasir' => $request->nama_kasir,
        'email_pembeli' => $request->email_pembeli,
        'tanggal_transaksi' => $request->tanggal_transaksi,
        'total_harga' => 0, // bisa dihitung setelah detail masuk
    ]);

    $total = 0;

    // Simpan setiap detail produk
    foreach ($request->product_id as $index => $productId) {
        $jumlah = $request->jumlah_pembelian[$index];
        $produk = Product::find($productId); // pastikan model Produk ada
        $subtotal = $produk->harga * $jumlah;
        $total += $subtotal;

        DetailTransakiPenjualan::create([
            'id_transaksi_penjualan' => $transaksi->id,
            'id_product' => $productId,
            'harga_satuan' => $produk->harga,
            'jumlah_pembelian' => $jumlah,
        ]);
    }

    // Update total harga di transaksi utama
    $transaksi->update(['total_harga' => $total]);

    return redirect()->route('transaksis.index')
                     ->with('success', 'Transaksi berhasil disimpan.');
    }

    public function show($id)
    {
        $transaksi = TransaksiPenjualan::with('details.product')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }
    
    public function edit($id)
    {
        $transaksi = TransaksiPenjualan::findOrFail($id);
        $products = Product::all();
        return view('transaksi.edit', compact('transaksi', 'products'));
    }

    public function update(Request $request, $id)
    {
    $transaksi = TransaksiPenjualan::findOrFail($id);

    // Validasi data
    $request->validate([
        'nama_kasir' => 'required|string',
        'email_pembeli' => 'required|email',
        'tanggal_transaksi' => 'required|date',
        'product_id' => 'required|array',
        'jumlah_pembelian' => 'required|array',
    ]);

    // Update transaksi utama
    $transaksi->update([
        'nama_kasir' => $request->nama_kasir,
        'email_pembeli' => $request->email_pembeli,
        'tanggal_transaksi' => $request->tanggal_transaksi,
    ]);

    // Hapus semua detail lama
    $transaksi->details()->delete();

    // Tambahkan detail baru
    $total = 0;
    foreach ($request->product_id as $index => $productId) {
        $produk = Product::find($productId);
        $jumlah = $request->jumlah_pembelian[$index];
        $subtotal = $produk->price * $jumlah;
        $total += $subtotal;

        DetailTransakiPenjualan::create([
            'id_transaksi_penjualan' => $transaksi->id,
            'id_product' => $productId,
            'harga_satuan' => $produk->price,
            'jumlah_pembelian' => $jumlah,
        ]);
    }

    // Update total harga
    $transaksi->update(['total_harga' => $total]);

    return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diperbarui.');
}

    public function destroy($id)
    {
        $transaksi = TransaksiPenjualan::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}