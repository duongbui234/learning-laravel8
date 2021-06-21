@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create contact</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Phone number</label>
                    <input type="text" name="phone" class="form-control" id="exampleFormControlInput1">

                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1">

                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Address</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>

                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
