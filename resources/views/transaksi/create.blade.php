@extends('layouts.main')

@section('title', 'Add New Transaction')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h3 class="fw-bold mb-4 text-dark">🧾 Add New Transaction</h3>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form id="transaksiForm" action="{{ route('transaksis.store') }}" method="POST">
                        @csrf

                        {{-- Nama Kasir --}}
                        <div class="form-group mb-3">
                            <label for="nama_kasir" class="form-label">Nama Kasir</label>
                            <input type="text"
                                   name="nama_kasir"
                                   class="form-control @error('nama_kasir') is-invalid @enderror"
                                   placeholder="Masukkan Nama Kasir"
                                   value="{{ old('nama_kasir') }}">
                            @error('nama_kasir')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email Pembeli --}}
                        <div class="form-group mb-3">
                            <label for="email_pembeli" class="form-label">Email Pembeli</label>
                            <input type="email"
                                   name="email_pembeli"
                                   class="form-control @error('email_pembeli') is-invalid @enderror"
                                   placeholder="Masukkan Email Pembeli"
                                   value="{{ old('email_pembeli') }}">
                            @error('email_pembeli')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tanggal Transaksi --}}
                        <div class="form-group mb-4">
                            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                            <input type="date"
                                   name="tanggal_transaksi"
                                   class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                                   value="{{ old('tanggal_transaksi') }}">
                            @error('tanggal_transaksi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>
                        <h5 class="mb-3 text-primary">🛍️ Daftar Produk Dibeli</h5>

                        <div id="product-container">
                            <div class="product-group">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-8">
                                        <label for="product_id[]" class="form-label">Pilih Produk</label>
                                        <select name="product_id[]" class="form-select">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->title }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="jumlah_pembelian[]" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah_pembelian[]" placeholder="Jumlah" min="1">
                                    </div>

                                    <div class="col-md-1 text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-product">&times;</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="button" id="addProduct" class="btn btn-sm btn-outline-primary">+ Tambah Produk</button>
                        </div>

                        <hr class="mt-4 mb-4">

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary me-3 px-4">💾 Save</button>
                            <button type="button" id="resetBtn" class="btn btn-warning me-3 px-4">🔄 Reset</button>
                            <a href="{{ route('transaksis.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ✅ Tambah & Hapus Produk
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('product-container');
        const tambahBtn = document.getElementById('addProduct');

        tambahBtn.addEventListener('click', () => {
            const item = document.querySelector('.product-group').cloneNode(true);
            item.querySelectorAll('select, input').forEach((el) => {
                if (el.tagName === 'INPUT') el.value = '';
                if (el.tagName === 'SELECT') el.selectedIndex = 0;
            });
            container.appendChild(item);
        });

        container.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-product') && container.children.length > 1) {
                e.target.closest('.product-group').remove();
            }
        });

        // ✅ Reset Form
        document.getElementById('resetBtn').addEventListener('click', function() {
            document.getElementById('transaksiForm').reset();
        });
    });
</script>
@endpush
