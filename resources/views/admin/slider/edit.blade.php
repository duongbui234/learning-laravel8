@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit slider</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('slider/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                        value="{{ $slider->title }}">
                    <input type="hidden" name='old_title' value="{{ $slider->title }}">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                    <input type="text" name='old_description' value="{{ $slider->description }}">
                </div>
                <div class="form-group">
                    <input type="file" id="actual-btn" hidden name='image' />
                    <input type="hidden" name='old_image' value="{{ $slider->image }}">

                    <!-- our custom upload button -->
                    <label for="actual-btn" class="brand-label" style="color: white !important">Choose File</label>

                    <!-- name of file chosen -->
                    <span id="file-chosen">No file chosen</span>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
