@extends('layouts.dashboard')

@section('title')
    <h2>Cars</h2>
@endsection

@section('content')
    <div class="alerts">
        @if (session()->has('car-create-success'))
            <div class="alert alert-success">{{ session('car-create-success') }}</div>
        @elseif(session()->has('car-create-fail'))
            <div class="alert alert-danger">{{ session('car-create-fail') }}</div>
        @elseif(session()->has('car-update-success'))
            <div class="alert alert-success">{{ session('car-update-success') }}</div>
        @elseif(session()->has('car-update-fail'))
            <div class="alert alert-danger">{{ session('car-update-fail') }}</div>
        @elseif(session()->has('car-delete-success'))
            <div class="alert alert-success">{{ session('car-delete-success') }}</div>
        @elseif(session()->has('car-delete-success'))
            <div class="alert alert-danger">{{ session('car-delete-fail') }}</div>
        @endif
    </div>

    <a href="{{ Route('car.create') }}" class="btn btn-primary">Tambah</a>

    <div class="row mt-3">
        @foreach ($cars as $car)
            <div class="card mx-2" style="width: 18rem;">
                <img src="{{ asset('/storage/'. $car->image) }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->brand->name }} {{ $car->name }}</h5>
                    <p>{{ $car->engine_capacity }} CC, {{ $car->transmission->name }}, {{ $car->status }}</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('car.show', $car->id) }}" class="btn btn-primary mx-1">Detail</a>
                        <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning mx-1">Edit</a>
                        <form action="{{ route('car.destroy', $car->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1" onclick="return confirm('Hapus Data?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection