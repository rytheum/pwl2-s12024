<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
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

        .card-body {
            padding: 25px;
        }

        .product-title {
            color: #212529;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .product-detail p {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .product-detail strong {
            color: #0d6efd;
        }

        img {
            width: 100%;
            border-radius: 12px;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border: none;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .btn-secondary:hover {
            background-color: #565e64;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- atur lebar card -->
                <h3 class="mb-4 text-center">📦 Detail Transaksi Penjualan</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body supplier-detail">

                        <!-- Informasi Transaksi -->
            <div class="mb-5">
                <h5 class="fw-bold mb-3" style="color: #7b5c2e;">Informasi Transaksi</h5>
                <table class="table table-borderless">
                    
                    <tr>
                        <td><strong>ID Transaksi:</strong></td>
                        <td>TRX-0{{ $transaksi->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Kasir:</strong></td>
                        <td>{{ $transaksi->nama_kasir }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Pembeli:</strong></td>
                        <td>{{ $transaksi->email_pembeli }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Transaksi:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i:s') }}</td>
                    </tr>
                </table>
            </div>
            <!-- Rincian Produk -->
                <h5 class="fw-bold mb-3" style="color: #7b5c2e;">Rincian Produk</h5>
                <table class="table table-bordered align-middle text-left">
                    <thead class="table-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($transaksi->details as $detail)
                            @php 
                                $hargaSatuan = $detail->product->price;
                                $subtotal = $detail->jumlah_pembelian * $hargaSatuan;
                                $grandTotal += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $detail->product->title }}</td>
                                <td>{{ $detail->jumlah_pembelian }}</td>
                                <td>Rp{{ number_format($hargaSatuan, 2, ',', '.') }}</td>
                                <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: #fff1c4;">
                            <th colspan="3" class="text-end">Grand Total</th>
                            <th>Rp{{ number_format($grandTotal, 0, ',', '.') }}</th>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-4 mb-4">
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('transaksis.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
                </div>
            </>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>