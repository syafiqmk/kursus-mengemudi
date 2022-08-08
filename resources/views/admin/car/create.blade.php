@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <form action="{{ Route('car.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="">Registration Number</label>
                    <input type="text" name="reg-number" id="" class="form-control @error('reg-number') is-invalid @enderror" autocomplete="off" placeholder="Registration Number" required value="{{ old('reg-number') }}">
                    @error('reg-number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" autocomplete="off" required value={{ old('name') }}>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="number" name="price" id="" class="form-control @error('price') is-invalid @enderror" autocomplete="off" placeholder="Rent Price" required value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Engine Capacity</label>
                    <input type="number" name="engine-capacity" id="" class="form-control @error('engine-capacity') is-invalid @enderror" placeholder="Engine Capacity" autocomplete="off" required value="{{ old('engine-capacity') }}">
                    @error('engine-capacity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Brand</label>
                    <select name="brand" id="" class="form-select @error('brand') is-invalid @enderror" required>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ (old('brand') == $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="">Transmisi</label>
                    <select name="transmission" id="" class="form-select @error('transmission') is-invalid @enderror" required>
                        @foreach ($transmissions as $transmission)
                            <option value="{{ $transmission->id }}" {{ (old('transmission') == $transmission->id) ? 'selected' : '' }}>{{ $transmission->name }}</option>
                        @endforeach
                    </select>
                    @error('transmission')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="{{ Route('car.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection