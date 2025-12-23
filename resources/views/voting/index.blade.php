@extends('layouts.base')

@section('title')
    Voting - Pemilihan Ketua OSIS
@endsection

@section('content')
    <div class="container py-4">
        @if (auth()->user()->hasVoted())
            {{-- Success Message After Voting --}}
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                    style="width: 120px; height: 120px;">
                                    <i class="fas fa-check-circle text-success" style="font-size: 72px;"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold mb-3">Terima Kasih Atas Partisipasi Anda!</h2>
                            <p class="lead text-muted mb-4">Suara Anda telah berhasil tercatat</p>

                            <div class="card bg-light border-0 mx-auto" style="max-width: 500px;">
                                <div class="card-body">
                                    <p class="text-muted mb-2 small">Anda telah memilih:</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if ($myVote->photo)
                                            <img src="{{ asset('storage/uploads/candidate/' . $myVote->photo) }}"
                                                alt="{{ $myVote->name }}" class="rounded-circle me-3"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">
                                                {{ $myVote->candidate_number }}
                                            </div>
                                        @endif
                                        <div class="text-start">
                                            <h4 class="mb-0 fw-bold">{{ $myVote->name }}</h4>
                                            <p class="text-muted mb-0">Nomor Urut {{ $myVote->candidate_number }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-home me-2"></i>Kembali ke Beranda
                                </a>
                            </div>

                            <div class="alert alert-info mt-4 mx-auto" style="max-width: 600px;">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Suara Anda bersifat rahasia dan tidak dapat diubah setelah dikirim</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Voting Form --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <h2 class="fw-bold mb-2">Pilih Calon Ketua OSIS</h2>
                            <p class="text-muted mb-0">Pilih salah satu kandidat di bawah ini. Pilihan Anda tidak dapat
                                diubah setelah dikirim.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Alert Messages --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('vote.store') }}" method="POST" id="voteForm">
                @csrf
                <div class="row g-4">
                    @forelse ($candidates as $candidate)
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100 candidate-card" style="transition: all 0.3s;">
                                <div class="card-body p-4">
                                    {{-- Header with Photo and Number --}}
                                    <div class="row mb-3">
                                        <div class="col-auto">
                                            @if ($candidate->photo)
                                                <img src="{{ asset('storage/uploads/candidate/' . $candidate->photo) }}"
                                                    alt="{{ $candidate->name }}" class="rounded-circle shadow"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                                    style="width: 100px; height: 100px;">
                                                    <span
                                                        class="display-4 fw-bold">{{ $candidate->candidate_number }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <div class="d-flex align-items-start justify-content-between">
                                                <div>
                                                    <span class="badge bg-primary mb-2">Nomor Urut
                                                        {{ $candidate->candidate_number }}</span>
                                                    <h4 class="fw-bold mb-1">{{ $candidate->name }}</h4>
                                                    <p class="mb-0 small" style="line-height: 1.6;">
                                                    </p>
                                                    <p class="text-muted mb-0">
                                                        <i class="fas fa-graduation-cap me-1"></i>
                                                        {{ $candidate->class ?? 'Kelas XI' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Vision & Mission --}}
                                    @if ($candidate->vision_mision)
                                        <div class="mb-3">
                                            <h6 class="fw-bold text-primary mb-2">
                                                <i class="fas fa-lightbulb me-2"></i>Visi & Misi
                                            </h6>
                                            <div class="bg-light rounded p-3">
                                                <p class="mb-0 small" style="line-height: 1.6;">
                                                    {{ Str::limit($candidate->vision_mision, 200) }}
                                                </p>
                                                @if (strlen($candidate->vision_mision) > 200)
                                                    <button type="button" class="btn btn-link btn-sm p-0 mt-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#candidateModal{{ $candidate->id }}">
                                                        Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Vote Button --}}
                                    <button type="button" class="btn btn-primary btn-lg w-100 vote-btn"
                                        data-candidate-id="{{ $candidate->id }}"
                                        data-candidate-name="{{ $candidate->name }}"
                                        data-candidate-number="{{ $candidate->candidate_number }}">
                                        <i class="fas fa-vote-yea me-2"></i>Pilih Kandidat Ini
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Modal for Full Vision & Mission --}}
                        @if ($candidate->vision_mision && strlen($candidate->vision_mision) > 200)
                            <div class="modal fade" id="candidateModal{{ $candidate->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <div class="d-flex align-items-center">
                                                @if ($candidate->photo)
                                                    <img src="{{ asset('storage/uploads/candidate/' . $candidate->photo) }}"
                                                        alt="{{ $candidate->name }}" class="rounded-circle me-3"
                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                        style="width: 60px; height: 60px; font-size: 24px;">
                                                        {{ $candidate->candidate_number }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <h5 class="modal-title fw-bold mb-0">{{ $candidate->name }}</h5>
                                                    <small class="text-muted">Nomor Urut
                                                        {{ $candidate->candidate_number }}</small>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="fw-bold text-primary mb-3">
                                                <i class="fas fa-lightbulb me-2"></i>Visi & Misi Lengkap
                                            </h6>
                                            <div class="bg-light rounded p-3">
                                                <p class="mb-0" style="white-space: pre-line; line-height: 1.8;">
                                                    {{ $candidate->vision_mision }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-inbox text-muted mb-3" style="font-size: 64px; opacity: 0.3;"></i>
                                    <h5 class="text-muted">Belum ada kandidat yang tersedia</h5>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </form>

            {{-- Confirmation Modal --}}
            <div class="modal fade" id="confirmModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold">
                                <i class="fas fa-question-circle text-warning me-2"></i>Konfirmasi Pilihan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center py-4">
                            <div class="mb-3">
                                <i class="fas fa-vote-yea text-primary" style="font-size: 64px;"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Apakah Anda yakin?</h5>
                            <p class="mb-2">Anda akan memilih:</p>
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h4 class="fw-bold mb-1" id="selectedCandidateName"></h4>
                                    <p class="text-muted mb-0">Nomor Urut <span id="selectedCandidateNumber"></span></p>
                                </div>
                            </div>
                            <div class="alert alert-warning mt-3 mb-0">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <small>Pilihan Anda tidak dapat diubah setelah dikirim!</small>
                            </div>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Batal
                            </button>
                            <button type="button" class="btn btn-primary px-4" id="confirmVoteBtn">
                                <i class="fas fa-check me-2"></i>Ya, Pilih Kandidat Ini
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .candidate-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .vote-btn {
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .vote-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15);
        }

        .modal-content {
            border-radius: 1rem;
            overflow: hidden;
        }

        @media (max-width: 768px) {

            .candidate-card .row>.col-auto img,
            .candidate-card .row>.col-auto>div {
                width: 80px !important;
                height: 80px !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedCandidateId = null;
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

            // Handle vote button clicks
            document.querySelectorAll('.vote-btn').forEach(button => {
                button.addEventListener('click', function() {
                    selectedCandidateId = this.dataset.candidateId;
                    document.getElementById('selectedCandidateName').textContent = this.dataset
                        .candidateName;
                    document.getElementById('selectedCandidateNumber').textContent = this.dataset
                        .candidateNumber;
                    confirmModal.show();
                });
            });

            // Handle confirm vote
            document.getElementById('confirmVoteBtn').addEventListener('click', function() {
                if (selectedCandidateId) {
                    // Create hidden input for candidate_id
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'candidate_id';
                    input.value = selectedCandidateId;

                    const form = document.getElementById('voteForm');
                    form.appendChild(input);

                    // Disable button to prevent double submission
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';

                    // Submit form
                    form.submit();
                }
            });
        });
    </script>
@endsection
