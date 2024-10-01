@extends('main/main')
@section('title', 'Profile')
@section('content')
    <img src="/storage/avatars/{{$user->ava}}" alt="">
    <h2>{{ $user->login }}</h2>
@endsection
