@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create slider</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" id="actual-btn" hidden name='image' />

                    <!-- our custom upload button -->
                    <label for="actual-btn" class="brand-label" style="color: white !important">Choose File</label>

                    <!-- name of file chosen -->
                    <span id="file-chosen">No file chosen</span>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
