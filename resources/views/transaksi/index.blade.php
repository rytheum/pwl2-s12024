@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <h2 class="fw-bold mb-1">Data Transactions</h2>

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <a href="{{ route('transaksis.create') }}" class="btn btn-success mb-3">+ Add Transaction</a>
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Nama Kasir</th>
                        <th>Email Pembeli</th>
                        <th>Tanggal Transaksi</th>
                        <th>Jumlah Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    @forelse ($transaksis as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>TRX-0{{ $transaksi->id }}</td>
                            <td>{{ $transaksi->nama_kasir }}</td>
                            <td>{{ $transaksi->email_pembeli ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</td>
                            <td>{{ $transaksi->details->count() }}</td>
                            <td>
                                <a href="{{ route('transaksis.show', $transaksi->id) }}" class="btn btn-lg btn-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-lg btn-warning me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" 
                                      method="POST" 
                                      class="d-inline" 
                                      id="form-delete" 
                                      data-title="Transaksi ID TRX-{{ $transaksi->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-lg btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $transaksis->links() }}
            </div>
        </div>
    </div>

    {{-- SweetAlert flash message --}}
    @if(session()->has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "GAGAL",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    {{-- Script konfirmasi hapus --}}
    <script>
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
@endsection
