<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: #bad4ffff;
        color: #e6edf3;
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
    }

    /* SIDEBAR */
    .sidebar {
        width: 250px;
        height: 100vh;
        background: #161b22;
        position: fixed;
        top: 0;
        left: 0;
        color: #fff;
        padding-top: 20px;
        transition: all 0.3s ease;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
    }

    .sidebar h4 {
        text-align: center;
        margin-bottom: 40px;
        color: #00b4d8;
    }

    .sidebar a {
        color: #c9d1d9;
        text-decoration: none;
        display: block;
        padding: 12px 25px;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: #21262d;
        border-left: 4px solid #00b4d8;
        color: #fff;
    }

    /* Toggle Sidebar */
    .sidebar.hide {
        left: -250px;
    }

    /* NAVBAR ATAS */
    .navbar-custom {
        background: #161b22;
        height: 60px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        position: fixed;
        top: 0;
        left: 250px;
        right: 0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .navbar-custom.full {
        left: 0;
    }

    .toggle-btn {
        background: none;
        border: none;
        color: #00d5ffff;
        font-size: 24px;
        cursor: pointer;
    }

    /* CONTENT */
    .content {
        margin-left: 250px;
        padding: 100px 40px 40px 40px;
        transition: all 0.3s ease;
    }

    .content.full {
        margin-left: 0;
    }

    h2 {
        color: #000000ff;
        font-weight: 600;
    }

    .card {
        background: #feffffff;
        border: 1px solid #30363d;
        border-radius: 10px;
    }

    .table {
        color: #e6edf3;
        border-color: #000000ff;
    }

    .table thead {
        background: #21262d;
        color: #00b4d8;
    }

    .table tbody tr:hover {
        background: #1e2329;
    }

    .btn {
        border-radius: 6px;
    }

    .btn-success {
        background: #00b4d8;
        border: none;
    }

    .btn-success:hover {
        background: #0096c7;
    }

    .table img {
        width: 90px;
        border-radius: 10px;
    }

    .footer-custom {
        background: #161b22;
        color: #c9d1d9;
        position: fixed;
        bottom: 0;
        left: 250px;
        /* default sama sidebar */
        right: 0;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease;
    }

    .footer-custom.full {
        left: 0;
    }
</style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar" id="sidebar">
        <h4>Tech Admin</h4>
        <a href="{{ route('products.index') }}"class=""><i class="fas fa-box"></i> Products</a>
        <a href="{{ route('suppliers.index') }}" ><i class="fas fa-truck"></i> Suppliers</a>
        <a href="{{ route('categories.index') }}"><i class="fas fa-tags"></i> Categories</a>
        <a href="{{ route('transaksis.index') }}"class="active"><i class="fas fa-sack-dollar"></i> Transactions</a>
    </div>

    
    {{-- NAVBAR --}}
    <div class="navbar-custom" id="navbar">
        <button class="toggle-btn" id="toggle-btn"><i class="fas fa-bars"></i></button>
        <span class="ms-3 fw-semibold">Admin Dashboard</span>
    </div>

     {{-- CONTENT --}}
<div class="content" id="content">
    <h2 class="mb-3">Data Transactions</h2>

    <div class="card shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('transaksis.create') }}" class="btn btn-success mb-3">+ Add Transaction</a>
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Nama Kasir</th>
                    <th>Email Pembeli</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jumlah Item</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-left">
                @forelse ($transaksis as $index => $transaksi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>TRX-0{{ $transaksi->id }}</td>
                        <td>{{ $transaksi->nama_kasir }}</td>
                        <td>{{ $transaksi->email_pembeli ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</td>
                        <td>{{ $transaksi->details->count() }}</td>
                        <td>
                            <a href="{{ route('transaksis.show', $transaksi->id) }}" class="btn btn-sm btn-primary me-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" class="d-inline" id="form-delete" data-title="Transaksi ID TRX-{{ $transaksi->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $transaksis->links() }}
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer-custom text-center py-3">
    <p class="mb-0">&copy; {{ date('Y') }} Tech Admin | Built with
        <i class="fa-solid fa-heart text-danger"></i> By Josevan,Aditya Sutanto,Steven Credentia,Halim Kurniawan
    </p>
<!-- FOOTER -->

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script>
    // ✅ flash message dengan SweetAlert
    @if(session()->has('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    // ✅ konfirmasi hapus
    document.querySelectorAll('#form-delete').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const productTitle = form.getAttribute('data-title');
            Swal.fire({
                title: `Yakin hapus "${productTitle}"?`,
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // ✅ toggle sidebar + footer
    const sidebar = document.getElementById('sidebar');
    const navbar = document.getElementById('navbar');
    const content = document.querySelector('.content');
    const footer = document.querySelector('.footer-custom');

    document.getElementById('toggle-btn').addEventListener('click', () => {
        sidebar.classList.toggle('hide');
        navbar.classList.toggle('full');
        content.classList.toggle('full');
        footer.classList.toggle('full');
    });
</script>

</body>

</html>
