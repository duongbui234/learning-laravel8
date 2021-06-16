<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi... <b style='color:#0d6efd;'>{{ Auth::user()->name }}</b>
            <b style='float:right;'>All Category <span class='badge bg-primary'></span> </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">



                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">All category</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Category name</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php($i = 1) --}}
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->category_name}}</td>
                                        @if (!$category->created_at)
                                            <td><span class="text-danger">No date set</span></td>
                                        @else
                                            <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-header">Add category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST" >
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category name</label>
                                    <input name='category_name' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('category_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
