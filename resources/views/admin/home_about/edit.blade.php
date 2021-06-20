@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit about</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('about/update/'.$about->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                        value="{{ $about->title }}">
                    <input type="hidden" name='old_title' value="{{ $about->title }}">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Short description</label>
                    <textarea class="form-control" name="short_des" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                    <input type="hidden" name='old_short_des' value="{{ $about->short_des }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Long description</label>
                    <textarea class="form-control" name="long_des" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <input type="hidden" name='old_long_des' value="{{ $about->long_des }}">
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
