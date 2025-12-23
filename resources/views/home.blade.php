{{-- home.blade.php --}}
@extends('layouts.base')

@section('title')
    Beranda - Pemilihan Ketua OSIS
@endsection

@section('content')
    <div class="container-fluid py-4">
        {{-- Hero Section --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-gradient-primary text-white"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body py-5">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h1 class="display-5 fw-bold mb-3">Pemilihan Ketua OSIS {{ date('Y')}}/{{date('Y')+1}}</h1>
                                <p class="lead mb-0">Suaramu Menentukan Pemimpin Masa Depan</p>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-vote-yea" style="font-size: 120px; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Overview --}}
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Total Pemilih</p>
                                <h2 class="mb-0 fw-bold">{{ $totalUsers }}</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                                <i class="fas fa-users text-primary fs-3"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-success small">
                            <i class="fas fa-check-circle me-1"></i>
                            <span>Terdaftar</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Suara Masuk</p>
                                <h2 class="mb-0 fw-bold">{{ $totalVotes }}</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                <i class="fas fa-vote-yea text-success fs-3"></i>
                            </div>
                        </div>
                        @php
                            $votePercentage = $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100, 1) : 0;
                        @endphp
                        <div class="d-flex align-items-center small">
                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $votePercentage }}%"></div>
                            </div>
                            <span class="text-success fw-semibold">{{ $votePercentage }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Belum Memilih</p>
                                <h2 class="mb-0 fw-bold">{{ $absentVoters->count() }}</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                                <i class="fas fa-user-clock text-warning fs-3"></i>
                            </div>
                        </div>
                        <div
                            class="d-flex align-items-center {{ $absentVoters->count() > 0 ? 'text-warning' : 'text-success' }} small">
                            @if ($absentVoters->count() > 0)
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                <span>Menunggu</span>
                            @else
                                <i class="fas fa-check-circle me-1"></i>
                                <span>Semua memilih</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Kandidat Terdepan</p>
                                <h2 class="mb-0 fw-bold">No. {{ $leadingCandidate->candidate_number ?? '-' }}</h2>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded-3">
                                <i class="fas fa-trophy text-danger fs-3"></i>
                            </div>
                        </div>
                        @if ($leadingCandidate)
                            <div class="d-flex align-items-center text-danger small">
                                <i class="fas fa-chart-line me-1"></i>
                                <span>{{ $leadingCandidate->votes_count }} suara</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="row">
            {{-- Candidate Cards --}}
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Kandidat Ketua OSIS</h5>
                            <span class="badge bg-primary">{{ $candidates->count() }} Kandidat</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach ($candidates as $candidate)
                                @php
                                    $percentage =
                                        $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0;
                                @endphp
                                <div class="col-md-6">
                                    <div class="card border h-100 hover-shadow" style="transition: all 0.3s;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="position-relative">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">
                                                        {{ $candidate->candidate_number }}
                                                    </div>
                                                    @if ($leadingCandidate && $leadingCandidate->id === $candidate->id)
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                                            <i class="fas fa-crown"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="mb-1 fw-bold">{{ $candidate->name }}</h6>
                                                    <p class="text-muted mb-0 small">
                                                        <i
                                                            class="fas fa-graduation-cap me-1"></i>{{ $candidate->class ?? 'Kelas XI' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <span class="small text-muted">Perolehan Suara</span>
                                                    <span class="badge bg-primary">{{ $candidate->votes_count }}
                                                        suara</span>
                                                </div>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $percentage }}%"
                                                        aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="fw-semibold">{{ $percentage }}%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($candidate->visi)
                                                <div class="mt-3 pt-3 border-top">
                                                    <p class="small text-muted mb-1"><strong>Visi:</strong></p>
                                                    <p class="small mb-0">{{ Str::limit($candidate->visi, 80) }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($candidates->isEmpty())
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="fas fa-inbox text-muted mb-3"
                                            style="font-size: 64px; opacity: 0.3;"></i>
                                        <p class="text-muted">Belum ada kandidat yang terdaftar</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Chart Section --}}
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">Grafik Perolehan Suara</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="voteChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Leading Candidate Card --}}
                @if ($leadingCandidate)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-warning text-white border-0 py-3">
                            <h6 class="mb-0"><i class="fas fa-trophy me-2"></i>Kandidat Terdepan</h6>
                        </div>
                        <div class="card-body text-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 80px; height: 80px;">
                                <span
                                    class="display-4 fw-bold text-warning">{{ $leadingCandidate->candidate_number }}</span>
                            </div>
                            <h5 class="fw-bold mb-2">{{ $leadingCandidate->name }}</h5>
                            <p class="text-muted mb-3">{{ $leadingCandidate->class ?? 'Kelas XI' }}</p>
                            <div class="d-flex justify-content-around text-center border-top pt-3">
                                <div>
                                    <h4 class="mb-0 text-warning fw-bold">{{ $leadingCandidate->votes_count }}</h4>
                                    <small class="text-muted">Suara</small>
                                </div>
                                <div class="vr"></div>
                                <div>
                                    @php
                                        $leadPercentage =
                                            $totalVotes > 0
                                                ? round(($leadingCandidate->votes_count / $totalVotes) * 100, 1)
                                                : 0;
                                    @endphp
                                    <h4 class="mb-0 text-warning fw-bold">{{ $leadPercentage }}%</h4>
                                    <small class="text-muted">Persentase</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Absent Voters List --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="mb-0"><i class="fas fa-user-clock me-2"></i>Belum Memilih
                            ({{ $absentVoters->count() }})</h6>
                    </div>
                    <div class="card-body p-0">
                        @if ($absentVoters->count() > 0)
                            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                @foreach ($absentVoters->take(10) as $voter)
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px; min-width: 40px;">
                                            <i class="fas fa-user text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 fw-semibold">{{ $voter->name }}</p>
                                            <small class="text-muted">{{ $voter->username }}</small>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning">Pending</span>
                                    </div>
                                @endforeach
                                @if ($absentVoters->count() > 10)
                                    <div class="list-group-item text-center">
                                        <small class="text-muted">+{{ $absentVoters->count() - 10 }} lainnya</small>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-check-circle text-success mb-2" style="font-size: 48px;"></i>
                                <p class="text-muted mb-0">Semua pemilih sudah memberikan suara!</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Quick Info --}}
                <div class="card border-0 shadow-sm mt-4 bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                        <ul class="list-unstyled mb-0 small">
                            <li class="mb-2">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <strong>Periode:</strong> {{ date('Y')}}/{{date('Y')+1}}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <strong>Status:</strong> <span class="badge {{ $status->value == 'open' ? 'bg-success' : 'bg-danger' }}">
                                    @if ($status->value == 'open')
                                        Berlangsung
                                    @else
                                        Tertutup
                                    @endif
                                </span>
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <strong>Sistem:</strong> One Person One Vote
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const candidateNames = {!! json_encode($candidates->pluck('name')) !!};
        const votesData = {!! json_encode($candidates->pluck('votes_count')) !!};

        const colors = [
            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
            '#e74a3b', '#858796', '#5a5c69', '#2e59d9'
        ];

        const ctx = document.getElementById('voteChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: candidateNames,
                datasets: [{
                    label: 'Jumlah Suara',
                    data: votesData,
                    backgroundColor: colors,
                    borderWidth: 0,
                    borderRadius: 8,
                    barPercentage: 0.7
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
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        padding: 12,
                        displayColors: false,
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
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    </script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-2px);
        }

        .card {
            transition: all 0.3s ease;
        }

        .progress-bar {
            transition: width 0.6s ease;
        }

        .list-group-item {
            transition: background-color 0.2s;
        }

        .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
    </style>
@endsection
