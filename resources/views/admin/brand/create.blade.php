@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <form action="{{ Route('brand.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="">Nama Brand</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Brand" autocomplete="off" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ Route('brand.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection