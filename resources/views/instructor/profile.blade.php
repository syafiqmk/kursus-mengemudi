@extends('layouts.dashboard')

@section('title')
    <h2>{{ $user->name }}</h2>
@endsection

@section('content')
    @if (session()->has('wrong-pass'))
        <div class="alert alert-danger">{{ session('wrong-pass') }}</div>
    @elseif(session()->has('update-success'))
        <div class="alert alert-success">{{ session('update-success') }}</div>
    @elseif(session()->has('update-fail'))
        <div class="alert alert-danger">{{ session('update-fail') }}</div>
    @endif

    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <form action="/instructor/profile/edit" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" placeholder="Name" autocomplete="off" required value="{{ $user->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Name" autocomplete="off" required value="{{ $user->email }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Photo</label>
                    @if ($user->photo)
                        <img src="{{ asset('/storage/' . $user->photo) }}" alt="" class="img-fluid d-block col-sm-5 my-2">
                    @endif
                    <input type="file" name="photo" id="" class="form-control @error('photo') is-invalid @enderror">
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Old Password</label>
                    <input type="password" name="old-pass" id="" class="form-control" placeholder="Old Password" required>
                </div>
                <div class="mb-3">
                    <label for="">New Password</label>
                    <input type="password" name="new-pass" id="" class="form-control @error('new-pass') is-invalid @enderror" placeholder="new Password">
                    @error('new-pass')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection