@extends('layouts.admin')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <img src="{{ asset('/storage/'. $user->photo) }}" alt="" class="img-fluid col-sm-7 mb-4">

    <table class="table">
        <tr>
            <td>Name</td>
            <td>:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                @if ($user->status == 'ready')
                    <p class="btn btn-success">Ready</p>
                @else
                    <p class="btn btn-danger">Not Ready</p>
                @endif
            </td>
        </tr>
    </table>
@endsection