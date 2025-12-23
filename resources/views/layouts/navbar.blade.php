<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/logo-osis.png') }}" class="rounded-circle" width="40" alt="logo">
            <div class="">
                <h4 class="text-primary m-0" style="font-size: 1rem">SIP-Ketos</h4>
                <p class="text-muted m-0" style="font-size: 7px">Sistem Informasi Pemilihan Ketua Osis</p>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('voting') ? 'active' : '' }}"
                            href="{{ url('/voting') }}">Memilih</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn nav-link">
                                <i class="ti ti-power text-danger"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</nav>
