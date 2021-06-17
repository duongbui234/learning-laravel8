<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi... <b style='color:#0d6efd;'>{{ Auth::user()->name }}</b>
            <b style='float:right;'>All Category <span class='badge bg-primary'></span> </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            {{-- ---------------------- --}}
            {{-- CATEGORIES LIST --}}
            {{-- ---------------------- --}}

            <div class="row">



                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="card-header">All category</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Category name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php($i = 1) --}}
                                @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                    <td>{{ $category->category_name}}</td>
                                    <td>{{ $category->user->name }}</td>
                                    @if (!$category->created_at)
                                    <td><span class="text-danger">No date set</span></td>
                                    @else
                                    <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/category/edit/'.$category->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ url('/category/softdelete/' . $category->id) }}"
                                            class="btn btn-danger">Move to trash</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-header">Add category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category name</label>
                                    <input name='category_name' type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
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

            {{-- ---------------------- --}}
            {{-- TRASHED LIST --}}
            {{-- ---------------------- --}}

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Trashed list</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Category name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php($i = 1) --}}
                                @foreach ($trashedList as $trashedCat)
                                <tr>
                                    <th scope="row">{{ $trashedList->firstItem() + $loop->index }}</th>
                                    <td>{{ $trashedCat->category_name}}</td>
                                    <td>{{ $trashedCat->user->name }}</td>
                                    @if (!$trashedCat->created_at)
                                    <td><span class="text-danger">No date set</span></td>
                                    @else
                                    <td>{{ Carbon\Carbon::parse($trashedCat->created_at)->diffForHumans() }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/category/restore/' . $trashedCat->id) }}"
                                            class="btn btn-info">Restore</a>
                                        <a href="{{ url('/category/delete/' . $trashedCat->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $trashedList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
