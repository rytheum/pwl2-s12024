@extends('layouts.main')

@section('title', 'Edit Transaction')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h3 class="fw-bold text-dark mb-4">📝 Edit Transaction</h3>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST" id="editTransaksiForm">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kasir -->
                        <div class="mb-3">
                            <label for="nama_kasir" class="form-label fw-semibold">Nama Kasir</label>
                            <input type="text" name="nama_kasir" id="nama_kasir"
                                class="form-control @error('nama_kasir') is-invalid @enderror"
                                value="{{ old('nama_kasir', $transaksi->nama_kasir) }}" required>
                        </div>

                        <!-- Email Pembeli -->
                        <div class="mb-3">
                            <label for="email_pembeli" class="form-label fw-semibold">Email Pembeli</label>
                            <input type="email" name="email_pembeli" id="email_pembeli"
                                class="form-control @error('email_pembeli') is-invalid @enderror"
                                value="{{ old('email_pembeli', $transaksi->email_pembeli) }}" required>
                        </div>

                        <!-- Tanggal Transaksi -->
                        <div class="mb-3">
                            <label for="tanggal_transaksi" class="form-label fw-semibold">Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                                value="{{ old('tanggal_transaksi', \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d')) }}" required>
                        </div>

                        <hr class="my-4">

                        <!-- Produk & Jumlah -->
                        <div id="produk-list">
                            <label class="form-label fw-semibold">Daftar Produk Dibeli</label>

                            @foreach($transaksi->details as $index => $detail)
                            <div class="row align-items-center mb-3 produk-item">
                                <div class="col-md-6">
                                    <select name="product_id[]" class="form-select" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $product->id == $detail->id_product ? 'selected' : '' }}>
                                                {{ $product->title }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <input type="number" name="jumlah_pembelian[]" class="form-control"
                                        placeholder="Jumlah"
                                        value="{{ old('jumlah_pembelian.' . $index, $detail->jumlah_pembelian) }}" required>
                                </div>

                                <div class="col-md-2 text-center">
                                    <button type="button" class="btn btn-danger remove-produk">Hapus</button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-3 text-end">
                            <button type="button" id="add-produk" class="btn btn-outline-primary btn-sm">+ Tambah Produk</button>
                        </div>

                        <hr class="my-4">

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">💾 Simpan</button>
                            <a href="{{ route('transaksis.index') }}" class="btn btn-secondary px-4">⬅️ Kembali</a>
                        </div>
                    </form>

                    <!-- Template Produk Baru -->
                    <template id="produk-template">
                        <div class="row align-items-center mb-3 produk-item">
                            <div class="col-md-6">
                                <select name="product_id[]" class="form-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->title }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <input type="number" name="jumlah_pembelian[]" class="form-control"
                                    placeholder="Jumlah" min="1" required>
                            </div>

                            <div class="col-md-2 text-center">
                                <button type="button" class="btn btn-danger remove-produk">Hapus</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-produk');
    const produkList = document.getElementById('produk-list');
    const template = document.getElementById('produk-template');

    addBtn.addEventListener('click', function () {
        const clone = template.content.cloneNode(true);
        produkList.appendChild(clone);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-produk')) {
            e.target.closest('.produk-item').remove();
        }
    });
});
</script>
@endpush
