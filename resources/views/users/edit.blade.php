@extends('layouts.master')

@section('title')
    Sua nguoi dung
@endsection

@section('content')
    <h1>Edit</h1>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="">
            <label for="">Name</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>
        <div class="">
            <label for="">Email</label>
            <input type="text" name="email" value="{{ $user->email }}">
        </div>
        {{-- <div class="">
            <label for="">Password</label>
            <input type="text" name="password" value="">
        </div> --}}
        <button type="submit">Submit</button>
    </form>
@endsection
