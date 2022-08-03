@extends('layouts.dashboard')

@section('title')
    <h2>Welcome, {{ auth()->user()->name }}</h2>
@endsection

@section('content')

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