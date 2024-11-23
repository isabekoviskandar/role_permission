@extends('layouts.adminLayout')

@section('title', 'Create Item')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <!-- Back to Items button -->
        <a href="{{ route('post.index') }}" class="btn btn-primary m-2">Items</a>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Item</h3>
                        </div>
                        
                        <!-- Form start -->
                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                                <!-- Name Input -->
                                <div class="form-group">
                                    <label for="nameInput">Name</label>
                                    <input type="text" class="form-control" name="name" id="nameInput" placeholder="Enter item name" required>
                                    @error('name')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Price Input -->
                                <div class="form-group">
                                    <label for="priceInput">Price</label>
                                    <input type="number" class="form-control" name="price" id="priceInput" placeholder="Enter price" required>
                                    @error('price')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="imageInput">Image</label>
                                    <input type="file" class="form-control-file" name="image" id="imageInput" required>
                                    @error('image')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Count Input -->
                                <div class="form-group">
                                    <label for="countInput">Count</label>
                                    <input type="number" class="form-control" name="count" id="countInput" placeholder="Enter count" required>
                                    @error('count')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Premium Checkbox -->
                                <div class="form-group">
                                    <label for="premiumInput">Premium</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="premium" id="premiumInput" value="1">
                                        <label class="form-check-label" for="premiumInput">Is Premium</label>
                                    </div>
                                    @error('premium')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create Item</button>
                            </div>
                        </form>
                        <!-- Form end -->
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
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection
