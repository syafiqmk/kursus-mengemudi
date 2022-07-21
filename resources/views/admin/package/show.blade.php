@extends('layouts.admin')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

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
                    <td>Rp. {{ $package->price }}</td>
                </tr>
                <tr>
                    <td>Transmission</td>
                    <td>:</td>
                    <td>{{ $package->transmission->name }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection