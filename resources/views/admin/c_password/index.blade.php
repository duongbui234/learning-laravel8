@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Change Password</h2>
    </div>
    <div class="card-body">
        <form class="form-pill" action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Current password</label>
                <input id="current_password" type="password" class="form-control" placeholder="current password"
                    name="current_password">

                @if(session('error'))
                <span class="text-danger">{{ session('error') }}</span>
                @endif

                @error('current_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">New password</label>
                <input id="password" type="password" class="form-control" placeholder="new password" name="password">

                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                    placeholder="confirm password">
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Change</button>

        </form>
    </div>
</div>

@endsection
