@extends('layouts.dashboard')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')

    <div class="button">
        <a href="{{ route('instructor.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($instructors as $instructor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $instructor->name }}</td>
                    <td>
                        @if ($instructor->status == 'ready')
                            <p class="btn btn-success">Ready</p>
                        @else
                            <p class="btn btn-danger">Not Ready</p>
                        @endif
                    </td>
                    <td class="d-flex">
                        <a href="{{ route('instructor.show', $instructor->id) }}" class="btn btn-primary me-1">Detail</a>
                        <a href="{{ route('instructor.edit', $instructor->id) }}" class="btn btn-warning me-1">Edit</a>
                        <form action="{{ route('instructor.destroy', $instructor->id) }}" method="post">
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