<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #bad4ffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h3 {
            color: #000000ff;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .card {
            border-radius: 15px;
            background: #fff;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.08);
        }
        .form-label {
            color: #2c3e50;
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-warning {
            color: #fff;
            background-color: #f39c12;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #d68910;
        }
        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #565e64;
        }
    </style>
</head>

<body>
     <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <h3>Add New Transaction</h3>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="transaksiForm" action="{{ route('transaksis.store') }}" method="POST">
                            @csrf

                            <!-- Nama Kasir -->
                            <div class="form-group mb-3">
                                <label for="nama_kasir">Nama Kasir</label>
                                <input type="text" class="form-control @error('nama_kasir') is-invalid @enderror" name="nama_kasir" placeholder="Masukkan Nama Kasir">
                            </div>

                            <!-- Email Pembeli -->
                            <div class="form-group mb-3">
                                <label for="email_pembeli">Email Pembeli</label>
                                <input type="email" class="form-control @error('email_pembeli') is-invalid @enderror" name="email_pembeli" placeholder="Masukkan Email Pembeli">
                            </div>

                            <!-- Tanggal Transaksi -->
                            <div class="form-group mb-4">
                                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror" name="tanggal_transaksi">
                            </div>

                            <hr>

                            <h5 class="mb-3 text-primary">Daftar Produk Dibeli</h5>
                            <div id="product-container">
                                <div class="product-group">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-8">
                                            <label for="product_id[]">Pilih Produk</label>
                                            <select name="product_id[]" class="form-select">
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->title }} - Rp {{ number_format($product->price, 0, ',', '.') }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="jumlah_pembelian[]">Jumlah</label>
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
                                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-warning me-3 px-4">🔄 Reset</button>
                                <a href="{{ route('transaksis.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
    <script>

        function resetForm() {
            document.getElementById('transaksiForm').reset();
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');
            }
        }
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let index = 1;
        const container = document.getElementById('product-container');
        const tambahBtn = document.getElementById('addProduct');

        tambahBtn.addEventListener('click', () => {
            const item = document.querySelector('.product-group').cloneNode(true);
            item.querySelectorAll('select, input').forEach((el) => {
                // Reset value inputan
                if (el.tagName === 'INPUT') el.value = '';
                if (el.tagName === 'SELECT') el.selectedIndex = 0;
            });
            container.appendChild(item);
            index++;
        });

        container.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-product') && container.children.length > 1) {
                e.target.closest('.product-group').remove();
            }
        });
    });
    </script>
</body>
</html>