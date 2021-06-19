@extends('admin.admin_master')

@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header"><b>Edit brand name</b></div>
                    <div class="card-body">
                        <form action="{{ url('/brand/update/'.$brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name='old_image' value="{{ $brand->brand_image }}">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand name</label>
                                <input name='brand_name' value='{{ $brand->brand_name }}' type="text"
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="file" id="actual-btn" hidden name="brand_image" />

                                <!-- our custom upload button -->
                                <label for="actual-btn" class="brand-label">Choose File</label>

                                <!-- name of file chosen -->
                                <span id="file-chosen">No file chosen</span>
                                @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name }}"
                                    style="width: 100px">
                            </div>

                            <button type="submit" class="btn btn-primary">Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
