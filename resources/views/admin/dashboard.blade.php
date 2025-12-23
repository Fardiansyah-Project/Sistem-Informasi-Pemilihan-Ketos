{{-- admin/dashboard.blade.php --}}
@extends('admin.layouts.base')

@section('title')
    Dashboard Pemilihan Ketua OSIS
@endsection

@section('content')
    {{-- Header Card --}}
    <div class="col-12 mb-3">
        {{-- admin/dashboard.blade.php --}}
        {{-- @php $status = \App\Models\Setting::where('key', 'voting_status')->first(); @endphp --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1 fw-semibold">Dashboard Pemilihan Ketua OSIS</h4>
                        <p class="text-muted mb-0">Hasil Perolehan Suara Real-time</p>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-light-success">
                            <i class="ti ti-circle-check me-1"></i>Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <h5>Kontrol Pemilihan</h5>
            <p>Status Saat Ini:
                <span class="badge {{ $status->value == 'open' ? 'bg-success' : 'bg-danger' }}">
                    {{ strtoupper($status->value) }}
                </span>
            </p>

            <form action="{{ route('admin.toggle-voting') }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn {{ $status->value == 'open' ? 'btn-danger' : 'btn-success' }}">
                    {{ $status->value == 'open' ? 'Nonaktifkan Pemilihan' : 'Aktifkan Pemilihan' }}
                </button>
            </form>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-primary">
                            <i class="ti ti-trophy f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total Suara</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <h4 class="mb-1">{{ $candidates->sum('votes_count') }}</h4>
                            <p class="text-muted mb-0" style="font-size: 11px">Suara masuk</p>
                        </div>
                        <div class="col-5">
                            <div class="d-grid">
                                <i class="ti ti-message text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-success">
                            <i class="ti ti-users f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total Kandidat</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <h4 class="mb-1">{{ $candidates->count() }}</h4>
                            <p class="text-muted mb-0 text-sm">Kandidat</p>
                        </div>
                        <div class="col-5">
                            <div class="d-grid">
                                <i class="ti ti-user-check text-success" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-warning">
                            <i class="ti ti-crown f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Kandidat Terdepan</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <h4 class="mb-1">No. {{ $leadingCandidate->candidate_number ?? '-' }}</h4>
                            <p class="text-muted mb-0 text-sm">
                                @if ($leadingCandidate)
                                    {{ $leadingCandidate->votes_count }} suara
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="col-5">
                            <div class="d-grid">
                                <i class="ti ti-medal text-warning" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-info">
                            <i class="ti ti-mail f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total Pemilih</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <h4 class="mb-1">{{ $totalUsers }}</h4>
                            <p class="text-muted mb-0 text-sm">Terdaftar</p>
                        </div>
                        <div class="col-5">
                            <div class="d-grid">
                                <i class="ti ti-user text-info" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-danger">
                            <i class="ti ti-user-x f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Belum Memilih</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <h4 class="mb-1">{{ $absentVoters->count() }}</h4>
                            <p class="text-muted mb-0 text-sm">Pemilih</p>
                        </div>
                        <div class="col-5">
                            <div class="d-grid">
                                <i class="ti ti-alert-circle text-danger" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-success">
                            <i class="ti ti-checkbox f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Sudah Memilih</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <h4 class="mb-1">{{ $totalUsers - $absentVoters->count() }}</h4>
                            @php
                                $percentage =
                                    $totalUsers > 0
                                        ? round((($totalUsers - $absentVoters->count()) / $totalUsers) * 100, 1)
                                        : 0;
                            @endphp
                            <p class="text-muted mb-0 text-sm">{{ $percentage }}% partisipasi</p>
                        </div>
                        <div class="col-5">
                            <div class="d-grid">
                                <i class="ti ti-checks text-success" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card {{ $status->value == 'open' ? 'bg-primary' : 'bg-danger'}}">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-white bg-opacity-25">
                            <i class="ti ti-chart-line f-20 text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-white">Status Pemilihan</h6>
                    </div>
                </div>
                <div class="bg-white bg-opacity-25 p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-12 text-center">
                            <h3 class="mb-2 text-white">
                                @if ($status->value == 'open')
                                    <i class="ti ti-circle-check text-success"></i>BERLANGSUNG
                                @else
                                    <i class="ti ti-circle-x text-warning"></i>TERTUTUP
                                @endif
                            </h3>
                            <p class="text-white text-opacity-75 mb-0">Pemilihan sedang aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="ti ti-chart-pie me-2"></i>Grafik Perolehan Suara
                </h5>
            </div>
            <div class="card-body">
                <div id="chart-container" style="min-height: 350px;">
                    <canvas id="voteChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="ti ti-chart-bar me-2"></i>Perbandingan Suara
                </h5>
            </div>
            <div class="card-body">
                <div id="bar-chart-container" style="min-height: 350px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="ti ti-list-details me-2"></i>Detail Perolehan Suara
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">No. Urut</th>
                                <th>Nama Kandidat</th>
                                <th>Perolehan Suara</th>
                                <th>Persentase</th>
                                <th class="pe-4">Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalVotes = $candidates->sum('votes_count');
                            @endphp
                            @foreach ($candidates as $candidate)
                                @php
                                    $percentage =
                                        $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 2) : 0;
                                @endphp
                                <tr>
                                    <td class="ps-4">
                                        <div class="avtar avtar-s bg-light-primary">
                                            <span class="fw-bold">{{ $candidate->candidate_number }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $candidate->name }}</h6>
                                        <small class="text-muted">Kandidat {{ $candidate->candidate_number }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success">
                                            <i class="ti ti-check me-1"></i>{{ $candidate->votes_count }} Suara
                                        </span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $percentage }}%</h6>
                                    </td>
                                    <td class="pe-4">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                                aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $percentage }}%</small>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($candidates->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="ti ti-inbox f-40 mb-2 d-block"></i>
                                            <p class="mb-0">Belum ada data kandidat</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data dari Laravel
        const candidateNames = {!! json_encode($candidates->pluck('name')) !!};
        const votesData = {!! json_encode($candidates->pluck('votes_count')) !!};

        // Warna yang sesuai dengan Mantis theme
        const colors = [
            'rgb(78, 115, 223)', // Primary
            'rgb(28, 200, 138)', // Success  
            'rgb(54, 185, 204)', // Info
            'rgb(246, 194, 62)', // Warning
            'rgb(231, 74, 59)', // Danger
            'rgb(133, 135, 150)', // Secondary
            'rgb(90, 92, 105)', // Dark
            'rgb(46, 89, 217)' // Primary dark
        ];

        // Pie Chart
        const ctxPie = document.getElementById('voteChart');
        if (ctxPie) {
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: candidateNames,
                    datasets: [{
                        label: 'Perolehan Suara',
                        data: votesData,
                        backgroundColor: colors,
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    family: 'Public Sans',
                                    size: 12
                                },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            bodyFont: {
                                family: 'Public Sans',
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.parsed || 0;
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = total > 0 ? ((value / total) * 100).toFixed(2) : 0;
                                    return label + ': ' + value + ' suara (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Bar Chart
        const ctxBar = document.getElementById('barChart');
        if (ctxBar) {
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: candidateNames,
                    datasets: [{
                        label: 'Jumlah Suara',
                        data: votesData,
                        backgroundColor: colors,
                        borderWidth: 0,
                        borderRadius: 8,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            bodyFont: {
                                family: 'Public Sans',
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    return 'Jumlah Suara: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    family: 'Public Sans',
                                    size: 11
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Public Sans',
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>

    <style>
        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .avtar {
            transition: transform 0.2s ease;
        }

        .card:hover .avtar {
            transform: scale(1.1);
        }

        .progress {
            transition: all 0.3s ease;
        }

        #chart-container,
        #bar-chart-container {
            position: relative;
        }
    </style>
@endsection
