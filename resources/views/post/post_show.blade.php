@extends('layouts.adminLayout')

@section('title', 'Item Details')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <!-- Back to Items button -->
        <a href="{{ route('post.index') }}" class="btn btn-primary m-2">Back to Items</a>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header text-center">
                            <h3 class="card-title">Item Details</h3>
                        </div>
                        
                        <div class="card-body">
                            <!-- Item Image -->
                            @if($post->image)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded" alt="Item Image" style="max-height: 300px;">
                                </div>
                            @else
                                <p class="text-center text-muted">No Image Available</p>
                            @endif

                            <!-- Item Name -->
                            <div class="form-group">
                                <h5><i class="fas fa-tag"></i> Name</h5>
                                <p class="text-muted">{{ $post->name }}</p>
                            </div>

                            <!-- Item Price -->
                            <div class="form-group">
                                <h5><i class="fas fa-dollar-sign"></i> Price</h5>
                                <p class="text-muted">${{ number_format($post->price, 2) }}</p>
                            </div>

                            <!-- Item Count -->
                            <div class="form-group">
                                <h5><i class="fas fa-boxes"></i> Count</h5>
                                <p class="text-muted">{{ $post->count }}</p>
                            </div>

                            <!-- Premium Status -->
                            <div class="form-group">
                                <h5><i class="fas fa-star"></i> Premium Status</h5>
                                <p class="text-muted">
                                    @if($post->premium)
                                        <span class="badge badge-success">Premium</span>
                                    @else
                                        <span class="badge badge-secondary">Standard</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer with Edit and Delete Buttons -->
                        <div class="card-footer text-right">
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

@endsection
