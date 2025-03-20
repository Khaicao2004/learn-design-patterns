@extends('layouts.master')


@section('title')
    Danh sach bai viet
@endsection

@section('content')
    <h1 class="text-center">Danh sach bai viet</h1>
    <div class="p-5">
        <a href="{{ route('posts.create') }}" class="bg-primary text-dark p-2 text-decoration-none">Create</a>
        <table class="table table-bordered text-center mt-2">
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
                            <div class="d-flex gap-4">
                                <a href="{{ route('posts.show', $post->id) }}" class="bg-primary p-2 text-dark text-decoration-none">Show</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="bg-warning p-2 text-dark text-decoration-none">Edit</a>
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
