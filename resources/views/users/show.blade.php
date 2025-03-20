@extends('layouts.master')

@section('title')
    Chi tiet nguoi dung
@endsection

@section('content')
    <h1>Chi tiet nguoi dung</h1>
    <div class="">
        <label for="">Name</label>
        <input type="text" value="{{ $user->name }}" disabled>
    </div>
    <div class="">
        <label for="">Email</label>
        <input type="text" value="{{ $user->email }}" disabled>
    </div>
@endsection