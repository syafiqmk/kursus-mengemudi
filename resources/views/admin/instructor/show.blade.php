@extends('layouts.dashboard')

@section('content')
    <div class="row d-flex justify-content-center">
        <img src="{{ asset('/storage/'. $user->photo) }}" alt="" class="img-fluid col-sm-7 mb-4">
        <div class="col-md-6">
        
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
                <tr>
                    <td></td>
                    <td></td>
                    <td class="d-flex">
                        <a href="{{ route('instructor.edit', $user->id) }}" class="btn btn-primary me-1">Edit</a>
                        <form action="{{ route('instructor.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection