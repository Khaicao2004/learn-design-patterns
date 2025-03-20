@extends('layouts.master')

@section('title')
    Them nguoi dung
@endsection

@section('content')
<h1>Create</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="">
            <label for="">Name</label>
            <input type="text" name="name" placeholder="nhap name">
        </div>
        <div class="">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="nhap email">
        </div>
        <div class="">
            <label for="">Password</label>
            <input type="text" name="password" placeholder="nhap password">
        </div>
        <div class="">
            <label for="">Image</label>
           <input type="file" name="avatar" id="">
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection