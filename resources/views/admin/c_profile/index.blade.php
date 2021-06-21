@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Change Profile</h2>
    </div>
    <div class="card-body">
        <form class="form-pill" action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_name">User name</label>
                <input id="user_name" type="text" class="form-control" placeholder="{{ $user->name }}" name="user_name">
                <input type="hidden" class="form-control" name="old_name" value="{{ $user->name }}">

                @error('current_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input id="user_email" type="email" class="form-control" placeholder="{{ $user->email }}"
                    name="user_email">
                <input type="hidden" class="form-control" name="old_email" value="{{ $user->email }}">
            </div>

            <button type="submit" class="btn btn-primary">Change</button>

        </form>
    </div>
</div>

@endsection
