@extends('admin.layouts.base')
@section('title')
    Profile {{ Auth::user()->name }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Profile {{ Auth::user()->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="form-label" for="name">Nama</label>
                            <p class="text-muted">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
