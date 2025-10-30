<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualan';

    protected $fillable = [
        'nama_kasir',
        'email_pembeli',
        'tanggal_transaksi',
    ];


    public function details()
    {
        return $this->hasMany(DetailTransakiPenjualan::class, 'id_transaksi_penjualan');
    }

    public function get_transaksi_penjualan_detail()
    {
        $sql = $this->select(
            "transaksi_penjualan.*",
            "detail_transaksi_penjualan.*",
            "products.title",
            "products.price",
            "category_product.product_category_name as product_category_name",
            DB::raw("(jumlah_pembelian * price) as total_harga")
        )
            ->join("detail_transaksi_penjualan", "detail_transaksi_penjualan.id_transaksi_penjualan", "=", "transaksi_penjualan.id")
            ->join("products", "detail_transaksi_penjualan.id_product", "=", "products.id")
            ->join("category_product", "category_product.id", "=", "products.product_category_id");

        return $sql;
    }

}