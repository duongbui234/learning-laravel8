<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi... <b style='color:#0d6efd;'>{{ Auth::user()->name }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <div class="card-group">
                        @foreach ($pics as $pic)
                        <div class="col-md-4 mt-5">
                            <div class="card">
                                <img src="{{ asset($pic->image  ) }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


                <div class="col-md-4">

                    <div class="card">

                        <div class="card-header">Multi pictures</div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    {{-- <input type="file" id="actual-btn" hidden name="images" multiple='' />

                                    <!-- our custom upload button -->
                                    <label for="actual-btn" class="brand-label">Choose File</label>

                                    <!-- name of file chosen -->
                                    <span id="file-chosen">No file chosen</span> --}}

                                    {{-- <label for="exampleInputEmail1" class="form-label">Multiple image</label>
                                    <input name='image[]' type="file" class="form-control" id="exampleInputEmail1"
                                        multiple=""> --}}

                                    <input type="file" id="actual-btn" hidden name='images[]' multiple="" />

                                    <!-- our custom upload button -->
                                    <label for="actual-btn" class="brand-label">Choose File</label>

                                    <!-- name of file chosen -->
                                    <span id="file-chosen">No file chosen</span>

                                    @error('image')
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