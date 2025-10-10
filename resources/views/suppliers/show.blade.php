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
            color: #ffffffff;
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
                <h3 class="mb-4 text-center">📦 Supplier Details</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body supplier-detail">
                        <h4 class="supplier-title">Supplier Details</h4>
                        <hr>
                        <p><strong>ID:</strong> {{ $supplier->id ?? 'readonly' }}</p>
                        <hr>
                        <p><strong>Supplier:</strong> {{ $supplier->supplier_name ?? '-' }}</p>
                        <hr>
                        <p><strong>PIC Supplier:</strong> {{ $supplier->pic_supplier ?? '-' }}</p>
                        <hr>
    
                        {{-- Back Button --}}
                        <div class="text-end mt-4">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>