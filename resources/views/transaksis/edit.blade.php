<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
<body>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h4>Edit Supplier</h4>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Category Name --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Category Name</label>
                            <input 
                                type="text" 
                                name="product_category_name" 
                                class="form-control @error('product_category_name') is-invalid @enderror"
                                value="{{ old('product_category_name', $category->product_category_name) }}"
                                placeholder="Masukkan Category">

                            @error('product_category_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                         {{-- BUTTONS --}}
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary me-3">⬅️ Back</a>
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
</body>
</html>