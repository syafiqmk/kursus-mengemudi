@extends('layouts.dashboard')

@section('content')
    <h5>Price : Rp. {{ number_format($package->price, 2, ',', '.') }}</h5>
    <p>{{ $package->detail }}</p>

    <h3 class="mt-4">Your Cars :</h3>
    <div class="row">
        @foreach ($cars->where('student_id', auth()->user()->id) as $car)
            <div class="card mx-1 col-md-3" style="width: 18rem;">
                    <img src="{{ asset('/storage/'. $car->image) }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->brand->name }} {{ $car->name }}</h5>
                        <p>{{ $car->engine_capacity }} CC, {{ $car->transmission->name }}, {{ $car->status }}</p>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('student.enrollProcess', [$package->id, $car->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Enroll</button>
                            </form>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>

    <h3 class="mt-4">Cars :</h3>
    <div class="row mb-3">
        @foreach ($cars->where('student_id', NULL) as $car)
            <div class="card mx-1 col-md-3" style="width: 18rem;">
                    <img src="{{ asset('/storage/'. $car->image) }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->brand->name }} {{ $car->name }}</h5>
                        <p>{{ $car->engine_capacity }} CC, {{ $car->transmission->name }}, {{ $car->status }}</p>
                        <p>Rp. {{ number_format($car->price, 2, ',', '.') }}</p>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('student.enrollProcess', [$package->id, $car->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Enroll</button>
                            </form>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
@endsection