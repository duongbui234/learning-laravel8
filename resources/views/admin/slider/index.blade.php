@extends('admin.admin_master')
@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row" style="justify-content: flex-start; padding: 16px; ">
            <a href="{{ url('slider/add') }}"><button class="btn btn-info">Add slider</button></a>
        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card-header">All Sliders</div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%">SL</th>
                                <th scope="col" style="width: 20%">Title</th>
                                <th scope="col" style="width: 35%">Description</th>
                                <th scope="col" style="width: 20%">Image</th>
                                <th scope="col" style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($sliders as $slider)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $slider->title}}</td>
                                <td>{{ $slider->description}}</td>
                                <td> <img src="{{ asset($slider->image) }}" alt="Slider image"
                                        style="width: 50px; height= 40px;">
                                </td>
                                <td>
                                    <a href="{{ url('/slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/slider/delete/' . $slider->id) }}" class="btn btn-danger"
                                        onclick="return confirm('Are u sure delete this slider')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
