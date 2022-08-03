@extends('layouts.dashboard')

@section('content')
    <h5>{{ $package->detail }}</h5>
    <h6>Price : Rp.{{ $package->price }}</h6>

    <h3 class="mt-4">Cars :</h3>
    @foreach ($cars as $car)
        <div class="card mx-2" style="width: 18rem;">
                <img src="{{ asset('/storage/'. $car->image) }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->brand->name }} {{ $car->name }}</h5>
                    <p>{{ $car->engine_capacity }} CC, {{ $car->transmission->name }}, {{ $car->status }}</p>
                    <div class="d-flex justify-content-center">
                        <form action="/student/enroll/{{ $package->id }}/{{ $car->id }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Enroll</button>
                        </form>
                    </div>
                </div>
            </div>
    @endforeach
@endsection