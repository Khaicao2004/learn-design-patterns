@extends('layouts.app')

@section('content')
    <div class="container">
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createGroupChat">Create Group</button>
        <div class="row mb-3">
            <div class="col-md-6">
                <h4>Nhom cua ban</h4>
                <ul>
                    @foreach ($myGroup as $group)
                        <li>
                            <a href="{{ route('group.chatGroup', $group->id) }}">{{ $group->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h4>Nhom ban lam thanh vien</h4>
                <ul>
                    @foreach ($myGroupNotLeader as $group)
                        <li>
                            <a href="{{ route('group.chatGroup', $group->id) }}">{{ $group->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createGroupChat" tabindex="-1" aria-labelledby="createGroupChatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createGroupChatLabel">Create group chat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('group.createGroup') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Group name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="leader">Leader Group</label>
                            <input type="text" name="leader" id="leader" class="form-control"
                                value="{{ Auth::user()->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="member">Member Group</label>
                            <select name="member_id[]" id="member_id" class="form-control" style="min-height: 200px"
                                multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
