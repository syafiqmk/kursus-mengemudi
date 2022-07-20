@extends('layouts.admin')

@section('title')
    <h2>{{ $title }}</h2>
@endsection

@section('content')
    <img src="{{ asset('/storage/'. $user->photo) }}" alt="" class="img-fluid col-sm-7">
@endsection