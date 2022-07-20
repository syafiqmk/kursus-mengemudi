@extends('layouts.instructor')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <div class="alerts">
        @if (session()->has('finish-success'))
            <div class="alert alert-success">{{ session('finish-success') }}</div>
        @elseif(session()->has('finish-fail'))
            <div class="alert alert-danger">{{ session('finish-fail') }}</div>
        
        @endif
    </div>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Package</th>
            <th>Student</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($enrolls as $enroll)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $enroll->package->name }}</td>
                    <td>{{ $enroll->user->name }}</td>
                    <td>
                        <a href="/instructor/enroll/{{ $enroll->id }}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection