<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:lightgray">

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h4>Edit Supplier</h4>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Supplier Name --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Supplier Name</label>
                            <input 
                                type="text" 
                                name="supplier_name" 
                                class="form-control @error('supplier_name') is-invalid @enderror"
                                value="{{ old('supplier_name', $supplier->supplier_name) }}"
                                placeholder="Masukkan nama supplier">

                            @error('supplier_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- PIC Supplier --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">PIC Supplier</label>
                            <input 
                                type="text" 
                                name="pic_supplier" 
                                class="form-control @error('pic_supplier') is-invalid @enderror"
                                value="{{ old('pic_supplier', $supplier->pic_supplier) }}"
                                placeholder="Masukkan nama PIC">

                            @error('pic_supplier')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-md btn-primary me-2">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
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