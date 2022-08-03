@extends('layouts.dashboard')

@section('title')
    <h2>Brands</h2>
@endsection

@section('content')

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
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $brands->links() }}
@endsection