@extends('layouts.adminLayout')

@section('title', 'Role Page')

@section('content')
<!-- Select2 CSS -->
<style>
        /* Override the background color and text color of selected items */
    .choices__inner {
        background-color: #f8f9fa; /* Light gray for better contrast */
        color: #333; /* Dark text color */
        border-color: #ced4da; /* Adjust border color if needed */
    }

    .choices__list--multiple .choices__item {
        background-color: #007bff; /* Primary color for selected items */
        color: white; /* White text on selected items */
        border-radius: 5px; /* Rounded corners for selected items */
        padding: 5px 10px; /* Adjust padding for readability */
    }

    .choices__list--dropdown .choices__item--selectable {
        background-color: #ffffff; /* White background for dropdown items */
        color: #333; /* Dark text color */
    }

    .choices__list--dropdown .choices__item--selectable:hover {
        background-color: #e9ecef; /* Slight hover effect for dropdown items */
    }

</style>
<link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />

<div class="content-wrapper">

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

            <div class="mb-3">
                <a href="{{route('role.create')}}" class="btn btn-primary">Create Role</a>

            </div>
            <div class="row">
                <!-- Role Table -->
                <table class="table table-striped table-bordered" id="userTableBody">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            @if (auth()->check())
                                <th>Change Activity</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                @if (auth()->check())
                                    <td>
                                    <div class="d-inline-flex">

                                    @if (auth()->user()->hasPermission('role.edit'))
                                        <a href="/role-edit/{{$item->id}}" class="btn btn-sm btn-warning mr-2" style="display:inline;">Edit</a>
                                    @endif

                                    @if (auth()->user()->hasPermission('roles.toggleStatus'))

                                        <form action="{{ route('roles.toggleStatus', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-{{ $item->is_active ? 'danger' : 'success' }} btn-sm" style="display:inline;">
                                                {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    @endif
                                    </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination Links -->
                {{ $roles->links() }}
            </div>
        </div>
    </section>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create New User</h5>
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

                    <!-- Permissions Input with Select2/Choices.js -->
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <select id="permissions" name="permissions[]" multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const element = document.getElementById('permissions'); // Use correct ID
        const choices = new Choices(element, {
            removeItemButton: true,
            placeholder: true,
            placeholderValue: "Select permissions"
        });
    });
</script>

@endsection
