@extends('admin.admin_master')

@section('admin')

<div class="py-12">
    <div class="container">

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
                    <div class="card-header">All message</div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php($i = 1) --}}
                            @php($i = 1)
                            @foreach ($messages as $mes)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $mes->name}}</td>
                                <td>{{ $mes->email }}</td>
                                <td>{{ $mes->subject }}</td>
                                <td>{{ $mes->message }}</td>
                                <td>
                                    <a href="{{ url('/message/delete/' . $mes->id) }}" class="btn btn-danger">Delete</a>
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
