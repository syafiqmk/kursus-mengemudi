@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('student.car.update', $car->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Registration Number</label>
                    <input type="text" name="reg-number" id="" class="form-control @error('regNumber') is-invalid @enderror" placeholder="Registration Number" autocomplete="off" required value="{{ $car->registration_number }}">
                    @error('regNumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" placeholder="Name" autocomplete="off" required value="{{ $car->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Engine Capacity</label>
                    <input type="number" name="engine-capacity" id="" class="form-control @error('engineCapacity') is-invalid @enderror" placeholder="Engine Capacity" autocomplete="off" required value="{{ $car->engine_capacity }}">
                    @error('engineCapacity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Brand</label>
                    <select name="brand" id="" class="form-select">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ ($brand->id == $car->brand_id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Transmission</label>
                    <select name="transmission" id="" class="form-select">
                        @foreach ($transmissions as $transmission)
                            <option value="{{ $transmission->id }}" {{ ($transmission->id == $car->transmission_id) ? 'selected' : '' }}>{{ $transmission->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Image</label>
                    <img src="{{ asset('/storage/'.$car->image) }}" class="img-fluid col-sm-5 d-block" alt="">
                    <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <a href="{{ route('student.car.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection