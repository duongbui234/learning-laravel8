@extends('admin.admin_master')
@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row" style="justify-content: flex-start; padding: 16px; ">
            <a href="{{ route('about.add') }}"><button class="btn btn-info">Add about</button></a>
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
                    <div class="card-header">Home about</div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%">SL</th>
                                <th scope="col" style="width: 10%">Title</th>
                                <th scope="col" style="width: 30%">Short Description</th>
                                <th scope="col" style="width: 35%">Long Description</th>
                                <th scope="col" style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($abouts as $about)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $about->title}}</td>
                                <td>{{ $about->short_des}}</td>
                                <td>{{ $about->long_des}}</td>

                                <td>
                                    <a href="{{ url('/about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/about/delete/' . $about->id) }}" class="btn btn-danger"
                                        onclick="return confirm('Are u sure delete this about')">Delete</a>
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
