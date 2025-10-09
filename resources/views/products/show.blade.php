<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0d1117;
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
            <div class="col-md-10">
                <h3 class="mb-4 text-center">📦 Product Details</h3>
                <div class="row">
                    {{-- Image Section --}}
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image">
                            </div>
                        </div>
                    </div>

                    {{-- Detail Section --}}
                    <div class="col-md-8 mb-4">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-body product-detail">
                                <h4 class="product-title">{{ $product->title }}</h4>
                                <hr>
                                <p><strong>Category:</strong> {{ $product->product_category_name ?? '-' }}</p>
                                <hr>
                                <p><strong>Supplier:</strong> {{ $product->supplier_name ?? '-' }}</p>
                                <hr>
                                <p><strong>Price:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <hr>
                                <p><strong>Description:</strong></p>
                                <div class="border rounded p-3 bg-light text-secondary" style="white-space: pre-line;">
                                    {{ $product->description }}
                                </div>
                                <hr>
                                <p><strong>Stock:</strong> {{ $product->stock }}</p>

                                {{-- Back Button --}}
                                <div class="text-end mt-4">
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
