@extends('layouts.adminLayout')

@section('title', 'Edit Post')

@section('content')

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <a href="/posts" class="btn btn-primary m-2">Posts</a>
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{ session('success') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
      
            @if (session('error'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{ session('error') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        
                        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="nameInput">Name</label>
                                    <input type="text" class="form-control" name="name" id="nameInput" value="{{ $post->name }}">
                                    @error('name')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Price -->
                                <div class="form-group">
                                    <label for="priceInput">Price</label>
                                    <input type="number" class="form-control" name="price" id="priceInput" value="{{ old('price', $post->price) }}">
                                    @error('price')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="form-group">
                                    <label for="imageInput">Image</label>
                                    <input type="file" class="form-control" name="image" id="imageInput">
                                    @if ($post->image)
                                        <img src="storage/app/public/ .{{$post->image}}" alt="Current Image" style="width: 100px; margin-top: 10px;">
                                    @endif
                                
                                    @error('image')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Count -->
                                <div class="form-group">
                                    <label for="countInput">Count</label>
                                    <input type="number" class="form-control" name="count" id="countInput" value="{{ old('count', $post->count) }}">
                                    @error('count')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Premium -->
                                <div class="form-group">
                                    <label for="premiumInput">Premium</label>
                                    <select class="form-control" name="premium" id="premiumInput">
                                        <option value="1" {{ $post->premium ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$post->premium ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('premium')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection
