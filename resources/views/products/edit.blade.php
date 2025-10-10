<!--@dump($data)-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #bad4ffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h4 {
            color: #000000ff;
            font-weight: 700;
        }

        .card {
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        label {
            font-weight: 600;
            color: #34495e;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #dfe6e9;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.3);
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        .btn-warning {
            border: none;
            border-radius: 8px;
            color: #212529;
            transition: 0.3s;
        }

        .btn-warning:hover {
            background-color: #ffcd39;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background-color: #565e64;
        }

        .alert-danger {
            border-radius: 10px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4 class="mb-4 text-center">✏️ Edit Product</h4>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('products.update', $data['product']->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- IMAGE --}}
                            <div class="form-group mb-3">
                                <label>IMAGE</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- CATEGORY --}}
                            <div class="form-group mb-3">
                                <label for="product_category_id">Product Category</label>
                                <select class="form-control" id="product_category_id" name="product_category">
                                    <option value="">--Select Category Product--</option>
                                    @foreach($data['categories'] as $category)
                                        <option value="{{ $category->id }}" @if(old("product_category", $data['product']->product_category_id) == $category->id) selected @endif>
                                            {{ $category->product_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_category')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SUPPLIER --}}
                            <div class="form-group mb-3">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control" id="supplier_id" name="supplier_id">
                                    <option value="">--Select Supplier--</option>
                                    @foreach($data['suppliers_'] as $supplier)
                                        <option value="{{ $supplier->id }}" @if(old("supplier_id", $data['product']->supplier_id) == $supplier->id) selected @endif>
                                            {{ $supplier->supplier_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TITLE --}}
                            <div class="form-group mb-3">
                                <label>TITLE</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title', $data['product']->title) }}"
                                    placeholder="Masukkan Judul Product">
                                @error('title')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="form-group mb-3">
                                <label>DESCRIPTION</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5"
                                    placeholder="Masukkan Description Product">{{ old('description', $data['product']->description) }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PRICE & STOCK --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>PRICE</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                                            value="{{ old('harga', $data['product']->price) }}" placeholder="Masukkan Harga Product">
                                        @error('price')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>STOCK</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                            value="{{ old('stock', $data['product']->stock) }}" placeholder="Masukkan Stock Product">
                                        @error('stock')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- BUTTONS --}}
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('products.index') }}" class="btn btn-secondary me-3">⬅️ Back</a>
                                <button type="reset" class="btn btn-warning me-3">RESET</button>
                                <button type="submit" class="btn btn-primary">UPDATE</button>
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
        CKEDITOR.replace('description');
    </script>
</body>

</html>
