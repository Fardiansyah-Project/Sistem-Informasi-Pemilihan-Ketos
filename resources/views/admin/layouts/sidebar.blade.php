<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="../dashboard/index.html" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                {{-- <img src="{{ asset('assets/images/logo-dark.svg')}}" class="img-fluid logo-lg" alt="logo"> --}}
                <h4 class="text-">SISPAN</h4>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item {{ request()->is('admin') ? 'active' : '' }}">
                    <a href="{{ url('admin') }} " class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->is('admin/candidates*') ? 'active' : '' }}">
                    <a href="{{ url('admin/candidates') }} " class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">Kandidat</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Lainnya</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
                            class="pc-mtext">Kelola
                            Pengguna</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href=
                            "{{ url('/admin/user-management/voters') }}">Pemilih</a></li>
                        <li class="pc-item pc-hasmenu">
                            <a href="{{ url('/admin/user-management/admin') }}" class="pc-link">Admin</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
