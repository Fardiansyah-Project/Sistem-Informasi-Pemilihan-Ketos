@extends('layouts.baseAuth')
@section('title')
    Login
@endsection
@section('content')
    <div class="card my-5">
        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-end mb-4">
                    <h3 class="mb-0"><b>Login</b></h3>
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
                <div class="form-group mb-3">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" autocomplete="off">
                    @error('email')
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
                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                        <label class="form-check-label text-muted" for="customCheckc1">Keep me sign
                            in</label>
                    </div>
                    <a href="{{ route('voter.register')}}" class="link-primary">Belum punya akun?</a>
                </div>
                <div class="d-grid mt-4 gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </form>
    </div>
@endsection
