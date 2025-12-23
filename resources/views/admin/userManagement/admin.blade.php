{{-- admin/dashboard.blade.php --}}
@extends('admin.layouts.base')

@section('title')
    Data Admin
@endsection

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0 text-wrap">Data Admin</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Daftar Admin</h5>
                        <a href="{{ url('admin/user-management/admin/create') }}" class="btn btn-primary">Tambah Admin</a>
                    </div>
                </div>
                @if (session('generate_password'))
                    <div class="alert alert-info text-center">
                        {{ session('generate_password') }}<br>
                        <small class="text-info">
                            Simpan password ini, karena tidak akan muncul lagi.
                        </small>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        <small class="text-success">
                            {{ session('success') }}
                        </small>
                    </div>
                @endif
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Posisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admin as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            {{-- <a href="{{ url('admin/user-management/edit', $item->id) }}"
                                                class="btn btn-warning">Edit</a> --}}
                                                <a href="{{ url('admin/user-management/generate-password', $item->id) }}"
                                                class="btn btn-sm btn-warning" onclick="return confirm('Yakin ingin mengubah password ini?')">Generate</a>
                                            <a href="{{ url('admin/user-management/delete', $item->id) }}"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ini? ')"
                                                class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        {{-- Warna text abu-disabled class  --}}
                                        <td colspan="5" class="text-center text-muted">Data tidak tersedia</td>
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
