<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Products</title>
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
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="mb-4 text-center">🧩 Add New Product</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body p-4">
                        <form id="productForm" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- IMAGE --}}
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            </div>

                            {{-- PRODUCT CATEGORY --}}
                            <div class="mb-3">
                                <label for="product_category_id" class="form-label">Product Category</label>
                                <select class="form-select" id="product_category_id" name="product_category">
                                    <option value="">--Select Product Category--</option>
                                    @foreach($data['categories'] as $category)
                                        <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- TITLE --}}
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Masukkan Judul Product">
                            </div>

                            {{-- SUPPLIER --}}
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-select" id="supplier_id" name="supplier_id">
                                    <option value="">--Select Supplier--</option>
                                    @foreach($data['supplier'] as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan Description Product"></textarea>
                            </div>

                            {{-- PRICE & STOCK --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Masukkan Harga Product">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="Masukkan Stock Product">
                                </div>
                            </div>

                            {{-- BUTTONS --}}
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary me-3 px-4">💾 Save</button>
                                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-warning me-3 px-4">🔄 Reset</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');

        function resetForm() {
            document.getElementById('productForm').reset();
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');
            }
        }
    </script>
</body>
</html>
