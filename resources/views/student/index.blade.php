@extends('layouts.dashboard')

@section('title')
    <h2>Welcome, {{ auth()->user()->name }}</h2>
@endsection

@section('content')
    <div class="alerts">
        @if (session()->has('enroll-fail'))
            <div class="alert alert-danger">{{ session('enroll-fail') }}</div>
        @elseif(session()->has('car-create-fail'))
            <div class="alert alert-danger">{{ session('car-create-fail') }}</div>
        
        @endif
    </div>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Package</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->name }}</td>
                    <td>
                        <a href="{{ route('studentEnroll', $package->id) }}" class="btn btn-primary">Enroll</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection