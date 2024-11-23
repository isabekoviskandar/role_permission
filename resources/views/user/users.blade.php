@extends('layouts.adminLayout')

@section('title', 'Index Page')

@section('content')
<!-- Select2 CSS -->

<link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />

<div class="content-wrapper">
    {{-- @php
    foreach ($users as $user) {
        echo '<h4>'. $user->name .'<h4>';
        echo '<h6>'. $user->roles()->permissions() .'<h6>';
    }
    @endphp --}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Success and error messages -->
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
                <!-- "Create User" Button -->
                <div class="mb-3">
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                        Create User
                    </button> --}}
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                        Create 300k User
                    </button>
                </div>
            <div class="row">

                <!-- User Table -->
                <table class="table table-striped table-bordered" id="userTableBody">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Roles</th>
                            @if (auth()->check() && auth()->user()->role == 'admin')
                                <th>Change Role</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ implode(', ', $item->roles_name) }}</td>
                                {{-- @if (auth()->check() && auth()->user()->role == 'admin') --}}
                                <td>
                                <div class="d-inline-flex">
                                    @if (auth()->user()->hasPermission('user.edit'))
                                        <a href="/user-edit/{{ $item->id }}" class="btn btn-sm btn-warning mr-1">Edit</a>
    
                                    @endif
                                    @if (auth()->user()->hasPermission('user.destroy'))

                                    <form action="/user-delete/{{ $item->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    @endif
                                </form>
                                    
                                    </div>
                                </td>
                                {{-- @endif --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                {{ $users->links() }}
            </div>
        </div>
    </section>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Name Input -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Roles Input with Select2 -->
                    <div class="form-group">
                        <select id="roles" name="roles[]" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create 300k User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const element = document.getElementById('roles');
        const choices = new Choices(element, {
            removeItemButton: true,
            placeholder: true,
            placeholderValue: "Select roles"
        });
    });
</script>

@endsection
