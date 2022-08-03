@extends('layouts.dashboard')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')

    <table class="table">
        <thead>
            <th>#</th>
            <th>Package</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($enrolls as $enroll)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $enroll->package->name }}</td>
                    <td>
                        @if ($enroll->status == 'enroll')
                            <a href="/student/enroll/pay/{{ $enroll->id }}" class="btn btn-success">Enroll (Click to Pay!)</a>
                        @elseif($enroll->status == 'wait')
                            <p class="btn btn-warning">Waiting for Payment Confirmation</p>
                        @elseif($enroll->status == 'grant')
                            <p class="btn btn-primary">On Going</p>
                        @elseif($enroll->status == 'finish')
                            <p class="btn btn-primary">Finished</p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection