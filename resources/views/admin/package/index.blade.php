@extends('layouts.dashboard')

@section('content')

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