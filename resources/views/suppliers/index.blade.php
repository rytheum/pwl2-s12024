<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            color: white;
            padding-top: 20px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: background 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .table img {
            width: 100px;
            height: auto;
            border-radius: 8px;
        }

        .card {
            border: none;
        }

        .btn {
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="{{ route('products.index') }}" >Products</a>
    <a href="{{ route('suppliers.index') }}" class = "active">Suppliers</a>
</div>

    {{-- Main Content --}}
    <div class="content">
        <h2 class="fw-bold mb-4">Data Products</h2>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('suppliers.create') }}" class="btn btn-success mb-3">+ Add Supplier</a>
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Pic_Supplier</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->pic_supplier }}</td>
                                <td class="text-center">
                                    <a href="{{ route('suppliers.show', $supplier->id) }}"
                                        class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                        class="btn btn-sm btn-primary">EDIT</a>

                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                        class="d-inline" id="form-delete" data-title="{{ $supplier->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Data Supplier Belum Tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    </script>

</body>

</html>
