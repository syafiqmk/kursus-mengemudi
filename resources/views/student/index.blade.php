@extends('layouts.dashboard')

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
                        <a href="{{ route('student.enroll', $package->id) }}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection