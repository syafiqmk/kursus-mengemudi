@extends('layouts.admin')

@section('title')
    <h2>Brands</h2>
@endsection

@section('content')
    <div class="alerts">
        @if (session()->has('brand-create-success'))
            <div class="alert alert-success">{{ session('brand-create-success') }}</div>
        @elseif(session()->has('brand-create-fail'))
            <div class="alert alert-danger">{{ session('brand-create-fail') }}</div>
        @elseif(session()->has('brand-update-success'))
            <div class="alert alert-success">{{ session('brand-update-success') }}</div>
        @elseif(session()->has('brand-update-fail'))
            <div class="alert alert-danger">{{ session('brand-update-fail') }}</div>
        @elseif(session()->has('brand-delete-success'))
            <div class="alert alert-success">{{ session('brand-delete-success') }}</div>
        @elseif(session()->has('brand-delete-success'))
            <div class="alert alert-danger">{{ session('brand-delete-fail') }}</div>
        @endif
    </div>

    <a href="{{ Route('brand.create') }}" class="btn btn-primary">Tambah</a>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Nama Brand</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $brand->name }}</td>
                    <td class="d-flex">
                        <a href="{{ Route('brand.edit', $brand->id) }}" class="btn btn-warning me-2">Edit</a>
                        <form action="{{ route('brand.destroy', $brand->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection