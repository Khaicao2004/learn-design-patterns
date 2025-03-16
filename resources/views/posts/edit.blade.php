@extends('layouts.master')

@section('title')
    Them moi bai viet
@endsection

@section('content')
    <h1>Them moi bai viet</h1>
    <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="">Title</label>
            <input type="text" name="title" id="" value="{{ $post->title }}">
        </div>
        <div>
            <label for="">Image</label>
            <img src="{{ Str::contains($post->image, 'http') ? $post->image : Storage::url($post->image) }}" alt="" width="80px" height="80px">
            <input type="file" name="image" id="">
        </div>
        <div>
            <label for="">Content</label>
            <textarea name="content" id="" placeholder="Nhap content">{{ $post->content }}</textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection