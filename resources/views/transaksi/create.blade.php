<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
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
            <div class="col-md-6">
                <h3 class="mb-4 text-center">Add New Category</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf

                            {{-- Category Name --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Category</label>
                                <input type="text" name="product_category_name" 
                                       class="form-control @error('product_category_name') is-invalid @enderror" 
                                       placeholder="Masukkan nama category" 
                                       value="{{ old('product_category_name') }}">
                                @error('product_category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- BUTTONS --}}
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary me-3 px-4">💾 Save</button>
                                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-warning me-3 px-4">🔄 Reset</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
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
