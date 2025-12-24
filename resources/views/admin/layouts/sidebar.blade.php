<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ url('/admin/')}}" class="b-brand text-primary d-flex align-items-center justify-content-center">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('assets/images/logo-osis.png')}}" class="rounded-circle" width="50"  alt="logo">
                <div class="">
                    <h4 class="text-primary m-0">SIP-Ketos</h4>
                    <p class="text-muted m-0" style="font-size: 8px">Sistem Informasi Pemilihan Ketua Osis</p>
                </div>
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
