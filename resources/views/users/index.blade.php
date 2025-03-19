@extends('layouts.master')

@section('title')
    Danh sach nguoi dung
@endsection

@section('content')
    <h1 class="text-center">List users</h1>
   <div class="p-5">
        <a href="{{ route('users.create') }}" class="bg-primary text-dark p-2">Create</a>
        <table class="table table-bordered text-center mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                           <div style="display: flex; justify-content: space-between">
                                <a href="{{ route('users.show', $user->id) }}" class="bg-warning">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="bg-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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

       {{ $users->links() }}
   </div>
@endsection