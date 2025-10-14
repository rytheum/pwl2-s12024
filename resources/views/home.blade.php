@extends('layouts.app')

@section('title', 'Home Dashboard')

@section('content')
    <h2 class="mb-3">Home Dashboard</h2>

    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm">
                <div class="card-body bg-warning text-center">
                    <i class="fas fa-box fa-4x"></i>
                </div>
                <div class="card-footer bg-warning text-center">
                    <a href="{{ route('products.index') }}" class="text-white">Data Products <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm">
                <div class="card-body bg-success text-center">
                    <i class="fas fa-tags fa-4x"></i>
                </div>
                <div class="card-footer bg-success text-center">
                    <a href="{{ route('categories.index') }}" class="text-white">Data Category <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm">
                <div class="card-body bg-danger text-center">
                    <i class="fas fa-truck fa-4x"></i>
                </div>
                <div class="card-footer bg-danger text-center">
                    <a href="{{ route('suppliers.index') }}" class="text-white">Data Supplier <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm">
                <div class="card-body bg-primary text-center">
                    <i class="fas fa-print fa-4x"></i>
                </div>
                <div class="card-footer bg-primary text-center">
                    <a href="{{ route('transaksis.index') }}" class="text-white">Data Transaksi <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection


