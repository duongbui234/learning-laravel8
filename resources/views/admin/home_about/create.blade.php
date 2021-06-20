@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create about</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Short description</label>
                    <textarea class="form-control" name="short_des" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                    @error('short_des')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Long description</label>
                    <textarea class="form-control" name="long_des" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('long_des')
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
