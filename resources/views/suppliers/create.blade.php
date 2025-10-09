<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:lightgray">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="mb-4 text-center">Add New Supplier</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form method="POST" action="{{ route('suppliers.store') }}">
                            @csrf

                            {{-- Supplier Name --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Supplier Name</label>
                                <input type="text" name="supplier_name" 
                                       class="form-control @error('supplier_name') is-invalid @enderror" 
                                       placeholder="Masukkan nama supplier" 
                                       value="{{ old('supplier_name') }}">
                                @error('supplier_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PIC Supplier --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PIC Supplier</label>
                                <input type="text" name="pic_supplier" 
                                       class="form-control @error('pic_supplier') is-invalid @enderror" 
                                       placeholder="Masukkan nama PIC" 
                                       value="{{ old('pic_supplier') }}">
                                @error('pic_supplier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
