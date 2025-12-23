@extends('admin.layouts.base')
@section('title')
    Form Kandidat
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Kandidat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('candidate.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nama Kandidat</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Enter name">
                                    @error('name')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="candidate_number">Nomor Urut Kandidat</label>
                                    <input type="text" class="form-control" id="candidate_number" name="candidate_number"
                                        value="{{ old('candidate_number') }}" placeholder="Enter candidate_number">
                                    @error('candidate_number')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="photo">Foto</label>
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        placeholder="Enter photo">
                                    @error('photo')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="vision_mission">Visi Misi</label>
                                    <textarea type="text" class="form-control"id="vision_mission" name="vision_mission" placeholder="Text">
                                        {{ old('vision_mission') }}
                                    </textarea>
                                    @error('vision_mission')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url('admin/candidates') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
