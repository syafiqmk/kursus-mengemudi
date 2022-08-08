@extends('layouts.dashboard')

@section('content')

    <a href="{{ Route('car.create') }}" class="btn btn-primary">Add data</a>

    <div class="row mt-3">
        @foreach ($cars->where('student_id', NULL) as $car)
            <div class="card mx-2" style="width: 18rem;">
                <img src="{{ asset('/storage/'. $car->image) }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->brand->name }} {{ $car->name }}</h5>
                    <p>{{ $car->engine_capacity }} CC, {{ $car->transmission->name }}, {{ $car->status }}</p>
                    <p>Rp. {{ number_format($car->price, 2, ',', '.') }}</p>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('car.destroy', $car->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group">
                                <a href="{{ route('car.show', $car->id) }}" class="btn btn-primary">Detail</a>
                                <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection