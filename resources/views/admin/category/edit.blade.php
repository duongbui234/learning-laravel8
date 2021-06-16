<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi... <b style='color:#0d6efd;'>{{ Auth::user()->name }}</b>
            {{-- <b style='float:right;'>All Category <span class='badge bg-primary'></span> </b> --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header"><b>Edit category name</b></div>
                        <div class="card-body">
                            <form action="{{ url('/category/update/'.$category->id) }}" method="POST" >
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category name</label>
                                    <input name='category_name' value='{{ $category->category_name }}' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
