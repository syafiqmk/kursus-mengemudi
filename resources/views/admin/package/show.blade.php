@extends('layouts.dashboard')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <td>Package</td>
                    <td>:</td>
                    <td>{{ $package->name }}</td>
                </tr>
                <tr>
                    <td>Detail</td>
                    <td>:</td>
                    <td>{{ $package->detail }}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($package->price, 2, ',', '.') }}</td>
                </tr>
                {{-- <tr>
                    <td>Transmission</td>
                    <td>:</td>
                    <td>{{ $package->transmission->name }}</td>
                </tr> --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td class="d-flex">
                        <a href="{{ route('package.edit', $package->id) }}" class="btn btn-primary me-1">Edit</a>
                        <form action="{{ route('package.destroy', $package->id) }}" method="post">
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