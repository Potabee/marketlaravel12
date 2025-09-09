{{-- Sidebar ini menggunakan komponen Offcanvas Bootstrap untuk mobile --}}
<aside class="offcanvas-lg offcanvas-start sidebar bg-white border-end d-flex flex-column p-0" tabindex="-1"
    id="sidebarMenu" aria-labelledby="sidebarMenuLabel">

    {{-- Header Sidebar (Logo & Tombol Close di Mobile) --}}
    <div class="offcanvas-header border-bottom">
        <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center">
            <x-application-logo class="d-block h-auto" style="width: 36px;" />
            <span class="ms-2 fs-5 fw-bold text-dark">Toko Admin</span>
        </a>
        <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
            aria-label="Close"></button>
    </div>

    {{-- Body Sidebar (dibuat scrollable jika menu panjang) --}}
    <div class="offcanvas-body d-flex flex-column p-0">
        {{-- Info Pengguna --}}
        @if (Auth::check())
            <div class="p-3 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="d-flex align-items-center justify-content-center fw-bold text-primary-emphasis bg-primary-subtle rounded-circle"
                            style="width: 40px; height: 40px;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="flex-grow-1" style="min-width: 0;">
                        <p class="small fw-semibold text-dark text-truncate mb-0">Hi, {{ auth()->user()->name }}</p>
                        @if (auth()->user()->getRoleNames()->isNotEmpty())
                            <p class="small text-muted text-capitalize mb-0">
                                {{ auth()->user()->getRoleNames()->first() }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Menu Navigasi Utama --}}
        <ul class="nav nav-pills flex-column p-3 flex-grow-1">
            <li class="nav-item mb-1">
                <a href="{{ route('dashboard') }}"
                    class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : 'text-dark' }}">
                    <svg class="me-3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>

            @hasanyrole('kasir|admin')
                <li class="nav-item mb-1">
                    <a href="#"
                        class="nav-link d-flex align-items-center {{ request()->routeIs('kasir.*') ? 'active' : 'text-dark' }}">
                        <svg class="me-3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Kasir
                    </a>
                </li>
            @endhasanyrole

            @hasanyrole('sales|admin')
                <li class="nav-item mb-1">
                    <a href="#"
                        class="nav-link d-flex align-items-center {{ request()->routeIs('sales.*') ? 'active' : 'text-dark' }}">
                        <svg class="me-3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Sales
                    </a>
                </li>
            @endhasanyrole

            @role('admin')
                <li class="nav-item mb-1">
                    <a class="nav-link d-flex align-items-center text-dark" data-bs-toggle="collapse"
                        href="#reportsCollapse" role="button" aria-expanded="false" aria-controls="reportsCollapse">
                        <svg class="me-3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan
                        <svg class="ms-auto" width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <div class="collapse" id="reportsCollapse">
                        <div class="py-2 ms-4 border-start">
                            <a href="#" class="nav-link text-dark ms-3 small py-1">Laporan Stok</a>
                            <a href="#" class="nav-link text-dark ms-3 small py-1">Laporan Penjualan</a>
                        </div>
                    </div>
                </li>
            @endrole
        </ul>

        {{-- Tombol Logout di Bawah --}}
        <div class="p-3 border-top mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link d-flex align-items-center text-dark"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <svg class="me-3" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
            </form>
        </div>
    </div>
</aside>
