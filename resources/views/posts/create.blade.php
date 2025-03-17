@extends('layouts.master')

@section('title')
    Them moi bai viet
@endsection

@section('content')
    <h1>Them moi bai viet</h1>
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="">Title</label>
            <input type="text" name="title" id="" placeholder="Nhap title">
        </div>
        <div>
            <label for="">Image</label>
            <input type="file" name="image" id="">
        </div>
        <div>
            <select name="user_id[]" multiple>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Content</label>
            <textarea name="content" id="" placeholder="Nhap content"></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection