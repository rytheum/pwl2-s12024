<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #0d1117;
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
            color: #00b4d8;
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
            color: #00b4d8;
            font-weight: 600;
        }

        .card {
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 10px;
        }

        .table {
            color: #e6edf3;
            border-color: #30363d;
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
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar" id="sidebar">
        <h4>Tech Admin</h4>
        <a href="{{ route('products.index') }}" class="active"><i class="bi bi-phone"></i> Products</a>
        <a href="{{ route('suppliers.index') }}"><i class="bi bi-truck"></i> Suppliers</a>
        <a href="#"><i class="bi bi-tags"></i> Categories</a>
        <a href="#"><i class="bi bi-cash-stack"></i> Transactions</a>
    </div>

    {{-- NAVBAR --}}
    <div class="navbar-custom" id="navbar">
        <button class="toggle-btn" id="toggle-btn"><i class="bi bi-list"></i></button>
        <span class="ms-3 fw-semibold">Admin Dashboard</span>
    </div>

    {{-- CONTENT --}}
    <div class="content" id="content">
        <h2 class="mb-4">Data Products</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-success mb-3">+ Add Product</a>
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Supplier</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td><img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->title }}"></td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->supplier_name }}</td>
                                <td>{{ $product->product_category_name }}</td>
                                <td>{{ "Rp" . number_format($product->price, 2, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td class="text-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline" id="form-delete" data-title="{{ $product->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No Products Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Toggle sidebar
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const navbar = document.getElementById('navbar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hide');
            content.classList.toggle('full');
            navbar.classList.toggle('full');
        });

        // SweetAlert Flash Message
        @if(session()->has('success'))
            Swal.fire({
                icon: "success",
                title: "SUCCESS",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "FAILED",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // SweetAlert Confirm Delete
        document.querySelectorAll('#form-delete').forEach(form => {
            form.addEventListener('submit', e => {
                e.preventDefault();
                const title = form.getAttribute('data-title');
                Swal.fire({
                    title: `Delete "${title}"?`,
                    text: "Data will be permanently deleted!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then(result => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
</body>

</html>
