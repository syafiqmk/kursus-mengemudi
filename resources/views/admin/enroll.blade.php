@extends('layouts.admin')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <div class="alerts">
        @if (session()->has('pay-confirm-success'))
            <div class="alert alert-success">{{ session('pay-confirm-success') }}</div>
        @elseif(session()->has('pay-confirm-fail'))
            <div class="alert alert-danger">{{ session('pay-confirm-fail') }}</div>
        
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
                        <a href="/admin/enroll/{{ $enroll->id }}" class="btn btn-primary">Confirm</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection