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
                <h3>Edit Transaction</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Form Edit Transaksi -->
                        <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nama Kasir -->
                            <div class="mb-3">
                                <label for="nama_kasir" class="form-label">Nama Kasir</label>
                                <input type="text" name="nama_kasir" id="nama_kasir" class="form-control"
                                    value="{{ old('nama_kasir', $transaksi->nama_kasir) }}" required>
                            </div>

                            <!-- Email Pembeli -->
                            <div class="mb-3">
                                <label for="email_pembeli" class="form-label">Email Pembeli</label>
                                <input type="email" name="email_pembeli" id="email_pembeli" class="form-control"
                                    value="{{ old('email_pembeli', $transaksi->email_pembeli) }}" required>
                            </div>

                            <!-- Tanggal Transaksi -->
                            <div class="mb-3">
                                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"
                                    value="{{ old('tanggal_transaksi', \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d\TH:i')) }}" required>
                            </div>

                            <hr class="my-4">

                            <!-- Produk & Jumlah -->
                            <div id="produk-list">
                                <label class="form-label">Pilih Produk & Jumlah</label>

                                @foreach($transaksi->details as $index => $detail)
                                <div class="row align-items-center mb-3 produk-item">
                                    <div class="col-md-6">
                                        <select name="product_id[]" class="form-select" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ $product->id == $detail->id_product ? 'selected' : '' }}>
                                                    {{ $product->title }}
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
                                <button type="button" id="add-produk" class="btn btn-secondary">+ Tambah Produk</button>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                                <a href="{{ route('transaksis.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>

                        <!-- Template untuk tambah produk baru -->
                        <template id="produk-template">
                            <div class="row align-items-center mb-3 produk-item">
                                <div class="col-md-6">
                                    <select name="product_id[]" class="form-select" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="jumlah_pembelian[]" class="form-control" placeholder="Jumlah" required>
                                </div>
                                <div class="col-md-2 text-center">
                                    <button type="button" class="btn btn-danger remove-produk">Hapus</button>
                                </div>
                            </div>
                        </template>

                        <!-- Script dynamic add/remove -->
                        <script>
                        document.getElementById('add-produk').addEventListener('click', function() {
                            const template = document.getElementById('produk-template').content.cloneNode(true);
                            document.getElementById('produk-list').appendChild(template);
                        });

                        document.addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-produk')) {
                                e.target.closest('.produk-item').remove();
                            }
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
    <script>

</body>
</html>