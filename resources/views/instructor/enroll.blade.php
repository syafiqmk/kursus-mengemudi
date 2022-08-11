@extends('layouts.dashboard')

@section('content')
    <table class="table">
        <tr>
            <td>Package</td>
            <td>:</td>
            <td>{{ $enroll->package->name }}</td>
        </tr>
        <tr>
            <td>Student</td>
            <td>:</td>
            <td>{{ $enroll->student->name }}</td>
        </tr>
        <tr>
            <td>Instructor</td>
            <td>:</td>
            <td>{{ $enroll->instructor->name }}</td>
        </tr>
        <tr>
            <td>Car</td>
            <td>:</td>
            <td>{{ $enroll->car->brand->name }} {{ $enroll->car->name }}, {{ $enroll->car->transmission->name }}, {{ $enroll->car->engine_capacity }} CC ({{ $enroll->car->registration_number }})</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <form action="/instructor/enroll/{{ $enroll->id }}/finish" method="post">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn btn-primary" onclick="return confirm('Finish Course?')">Finish</button>
                </form>
            </td>
        </tr>
    </table>
@endsection