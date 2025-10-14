<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #bad4ff;
            color: #ffffffff;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
        }

        h2 { color: #000000ff; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #161b22;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .sidebar.hide { left: -250px; }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 40px;
            color: #00b4d8;
        }

        .sidebar a {
            color: #c9d1d9;
            text-decoration: none;
            display: block;
            padding: 12px 25px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #21262d;
            border-left: 4px solid #00b4d8;
            color: #fff;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: #161b22;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .navbar-custom.full { left: 0; }

        .toggle-btn {
            background: none;
            border: none;
            color: #00d5ff;
            font-size: 24px;
            cursor: pointer;
        }

        /* ===== CONTENT ===== */
        .content {
            margin-left: 250px;
            padding: 100px 40px 60px;
            transition: all 0.3s ease;
        }

        .content.full { margin-left: 0; }

        /* ===== FOOTER ===== */
        .footer-custom {
            background: #161b22;
            color: #c9d1d9;
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            z-index: 999;
        }

        .footer-custom.full { left: 0; }

        /* Loader (optional) */
        #loader {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }
        #loader.hidden { display: none; }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar" id="sidebar">
        <h4>Tech Admin</h4>
        <a href="{{ url('home') }}" class="{{ request()->is('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a>
        <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}"><i class="fas fa-box"></i> Products</a>
        <a href="{{ route('suppliers.index') }}" class="{{ request()->is('suppliers*') ? 'active' : '' }}"><i class="fas fa-truck"></i> Suppliers</a>
        <a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Categories</a>
        <a href="{{ route('transaksis.index') }}" class="{{ request()->is('transaksis*') ? 'active' : '' }}"><i class="fas fa-sack-dollar"></i> Transactions</a>
    </div>

    {{-- NAVBAR --}}
    <div class="navbar-custom" id="navbar">
        <button class="toggle-btn" id="toggle-btn"><i class="fas fa-bars"></i></button>
        <span class="ms-3 fw-semibold">@yield('title', 'Dashboard')</span>
    </div>

    {{-- CONTENT --}}
    <div class="content" id="content">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="footer-custom text-center py-3" id="footer">
        <p class="mb-0">&copy; {{ date('Y') }} Tech Admin | Built with
            <i class="fa-solid fa-heart text-danger"></i> By Josevan, Aditya Sutanto, Steven Credentia, Halim Kurniawan
        </p>
    </footer>

    {{-- Loader (opsional) --}}
    <div id="loader" class="hidden">
        <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ====== SIDEBAR TOGGLE ======
        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");
        const navbar = document.getElementById("navbar");
        const content = document.getElementById("content");
        const footer = document.getElementById("footer");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("hide");
            navbar.classList.toggle("full");
            content.classList.toggle("full");
            footer.classList.toggle("full");
        });

        // ====== FORM HANDLING + SWEETALERT ======
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", (e) => {
                if (form.classList.contains('form-delete')) {
                    e.preventDefault();
                    const itemName = form.getAttribute('data-title') || 'data ini';
                    Swal.fire({
                        title: `Yakin hapus "${itemName}"?`,
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
                    return;
                }

                // tampilkan loader untuk form lain
                loader.classList.remove("hidden");
            });
        });

        // ====== SWEETALERT FLASH MESSAGE ======
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });
    </script>

    @stack('scripts')
</body>
</html>
