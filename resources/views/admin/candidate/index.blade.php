{{-- admin/dashboard.blade.php --}}
@extends('admin.layouts.base')

@section('title')
    Data Kandidat Ketua OSIS
@endsection

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0 text-wrap">Data Kandidat Calon Ketua Osis</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- Zero config table start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Daftar Kandidat</h5>
                        <a href="{{ url('admin/candidates/create') }}" class="btn btn-primary">Tambah Kandidat</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Kandidat</th>
                                    <th>Visi Misi</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->candidate_number }}</td>
                                        <td>{{ $item->vision_mission }}</td>
                                        <td>
                                            <a href="{{ asset('storage/uploads/candidate/' . $item->photo) }}" target="_blank" >
                                                <img src="{{ asset('storage/uploads/candidate/' . $item->photo) }}" alt="Foto kandidat" width="100px" class="rounded-md">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/candidates/edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ url('admin/candidates/delete', $item->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus ini? ')" class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Data tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
