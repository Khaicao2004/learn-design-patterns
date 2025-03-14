@extends('layouts.master')


@section('title')
    Danh sach bai viet
@endsection

@section('content')
    <h1>Danh sach bai viet</h1>
    <div style="padding: 20px">
        <a href="{{ route('posts.create') }}" style="padding: 5px; background-color: green;">Create</a>
        <table style="margin-top: 10px; border: 1px solid black; width: 100%; text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            @foreach ($post->users as $user)
                                <b>{{ $user->name ?? '-' }}</b>
                            @endforeach
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ Str::contains($post->image, 'http') ? $post->image : Storage::url($post->image) }}"
                                alt="" width="80px" height="80px">
                        </td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td>
                            <div style="display: flex; justify-content: space-between">
                                <a href="{{ route('posts.show', $post->id) }}">Show</a>
                                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
