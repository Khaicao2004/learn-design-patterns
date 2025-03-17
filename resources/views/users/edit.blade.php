@extends('layouts.master')

@section('title')
    Sua nguoi dung
@endsection

@section('content')
    <h1>Edit</h1>
    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
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
        <div class="">
            <label for="">Image</label>
            <img src="{{ Str::contains($user->avatar, 'http') ? $user->avatar : Storage::url($user->avatar) }}" alt="" width="80" height="80">
            <input type="file" name="avatar">
        </div>
        {{-- <div class="">
            <label for="">Password</label>
            <input type="text" name="password" value="">
            <input type="hidden" name="password" value="{{ $user->password }}">
        </div> --}}
        <button type="submit">Submit</button>
    </form>
@endsection
