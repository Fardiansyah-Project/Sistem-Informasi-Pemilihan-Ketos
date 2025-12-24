@extends('admin.layouts.base')
@section('title')
    Edit Profile {{ Auth::user()->name }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Admin</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            <small class="text-success">
                                {{ session('success') }}
                            </small>
                        </div>
                    @endif
                    <form action="{{ route('user-profile.change-password', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group">
                                <label class="form-label" for="current_password">Password Lama</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    value="{{ old('current_password') }}" placeholder="Enter password" autocomplete="off">
                                @error('current_password')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="new_password">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    value="{{ old('new_password') }}" placeholder="Enter password" autocomplete="off">
                                @error('new_password')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                                    value="{{ old('new_password_confirmation') }}" placeholder="Enter password" autocomplete="off">
                                @error('new_password_confirmation')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('/admin') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
