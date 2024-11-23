@extends('layouts.adminLayout')

@section('title', 'Index Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
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

            @if (auth()->user()->hasPermission('post.create'))
                <a href="/post-create" class='btn btn-primary m-2'>Create</a>
            @endif
            
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Count</th>
                        <th>Premium</th>
                        @if (auth()->check() && auth()->user()->role)
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ $item->image }}" alt="Image" style="width: 50px; height: 50px;">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>{{ $item->count }}</td>
                            <td>{{ $item->premium }}</td>
                            <td>
                                <div class="d-inline-flex">

                                    {{-- @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'edit')) --}}
                                    @if (auth()->user()->hasPermission('post.edit'))
                                        <a href="/post-edit/{{ $item->id }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                                    @endif

                                    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'delete'))
                                    {{-- @if (auth()->user()->hasPermission('post.create')) --}}

                                        <form action="/post-delete/{{ $item->id }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif

                                    @if (auth()->user()->hasPermission('post.show'))
                                        <a href="/post-show/{{ $item->id }}" class="btn btn-sm btn-warning ml-1">Show</a>
                                    @endif
                                </div>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </section>
</div>
@endsection
