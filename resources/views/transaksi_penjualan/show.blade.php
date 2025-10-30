<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi Penjualan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 700px;
            margin: 30px auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .content {
            padding: 25px 30px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .content th,
        .content td {
            padding: 10px;
            text-align: left;
        }

        .content thead {
            background-color: #007bff;
            color: white;
        }

        .content tbody tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
            font-size: 1.1rem;
            text-align: right;
        }

        .footer {
            background-color: #f0f4f8;
            color: #555;
            text-align: center;
            padding: 15px;
            font-size: 0.9rem;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Detail Transaksi Penjualan</h2>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $data[0]->email_pembeli }}</strong>,</p>
            <p>Berikut detail transaksi Anda:</p>

            <table>
                <tr>
                    <td><strong>ID Transaksi:</strong></td>
                    <td>TRX-0{{ $data[0]->id }}</td>
                </tr>
                <tr>
                    <td><strong>Nama Kasir:</strong></td>
                    <td>{{ $data[0]->nama_kasir }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Transaksi:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($data[0]->created_at)->format('d M Y, H:i:s') }}</td>
                </tr>
            </table>

            <h3 style="margin-top: 25px;">🧾 Rincian Produk</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->jumlah_pembelian }}</td>
                            <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                Total Tagihan: Rp{{ number_format($total_harga['transaksi'], 0, ',', '.') }}
            </div>

            <p style="margin-top: 25px;">Terima kasih telah melakukan transaksi dengan kami 🙏</p>
        </div>

        <div class="footer">
            <p>Pesan ini dikirim secara otomatis oleh sistem kami.</p>
            <p>&copy; {{ date('Y') }} Toko Anda. All rights reserved.</p>
        </div>
    </div>
</body>

</html>