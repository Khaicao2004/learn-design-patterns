@extends('layouts.master')


@section('title')
    Login
@endsection

@section('content')
    <h1 class="text-center">Login</h1>
    <form action="{{route('auth.login') }}" method="post">
       <div class="p-5 w-25 d-flex">
            <div class="">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Nhap email">
            </div>
            <div class="mt-3">
                
            </div>
       </div>
    </form>
@endsection