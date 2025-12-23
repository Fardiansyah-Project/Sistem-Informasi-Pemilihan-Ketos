@extends('layouts.baseAuth')
@section('title')
    Register
@endsection
@section('content')
    <div class="card my-5">
        <form action="{{ route('register.voter.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-end mb-4">
                    <h3 class="mb-0"><b>Daftar</b></h3>
                </div>
                @if ($errors->has('error'))
                    <div class="alert alert-danger text-center">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <input type="hidden" id="role" name="role" value="voter" >
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nama" autocomplete="off">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email Address" autocomplete="off">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="nis">Nomor Induk Siswa</label>
                    <input type="text" id="nis" name="nis" value="{{ old('nis') }}" class="form-control" placeholder="Nomor Induk Siswa" autocomplete="off">
                    @error('nis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                        <label class="form-check-label text-muted" for="customCheckc1">Keep me sign
                            in</label>
                    </div>
                    <a href="{{ route('login') }}" class="link-primary">Sudah punya akun?</a>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
