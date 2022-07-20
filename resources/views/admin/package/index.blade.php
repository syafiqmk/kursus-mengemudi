@extends('layouts.admin')

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
                    <td class="d-flex">
                        <a href="{{ route('package.show', $package->id) }}" class="btn btn-primary me-1">Detail</a>
                        <a href="{{ route('package.edit', $package->id) }}" class="btn btn-warning me-1">Edit</a>
                        <form action="{{ route('package.destroy', $package->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection