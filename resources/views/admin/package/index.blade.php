@extends('layouts.dashboard')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <div class="alerts">
        @if (session()->has('package-create-success'))
            <div class="alert alert-success">{{ session('package-create-success') }}</div>
        @elseif(session()->has('package-create-fail'))
            <div class="alert alert-danger">{{ session('package-create-fail') }}</div>
        @elseif(session()->has('package-update-success'))
            <div class="alert alert-success">{{ session('package-update-success') }}</div>
        @elseif(session()->has('package-update-fail'))
            <div class="alert alert-danger">{{ session('package-update-fail') }}</div>
        @elseif(session()->has('package-delete-success'))
            <div class="alert alert-success">{{ session('package-delete-success') }}</div>
        @elseif(session()->has('package-delete-success'))
            <div class="alert alert-danger">{{ session('package-delete-fail') }}</div>
        @endif
    </div>

    <a href="{{ route('package.create') }}" class="btn btn-primary">Tambah</a>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->name }}</td>
                    <td>
                        <form action="{{ route('package.destroy', $package->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            
                            <div class="btn-group" role="group">
                                <a href="{{ route('package.edit', $package->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('package.show', $package->id) }}" class="btn btn-primary">Detail</a>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection