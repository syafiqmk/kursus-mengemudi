@extends('layouts.dashboard')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('package.update', $package->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Package Name" autocomplete="off" required value="{{ $package->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price" autocomplete="off" required value="{{ $package->price }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Detail</label>
                    <textarea name="detail" id="" cols="30" rows="10" class="form-control @error('detail') is-invalid @enderror" placeholder="Detail" autocomplete="off" required>{{ $package->detail }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="">Transmission</label>
                    <select name="transmission" id="" class="form-select @error('transmission') is-invalid @enderror">
                        @foreach ($transmissions as $transmission)
                            <option value="{{ $transmission->id }}" {{ ($transmission->id == $package->transmission_id) ? ' selected' : '' }}>{{ $transmission->name }}</option>
                        @endforeach
                    </select>
                    @error('transmission')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('package.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection