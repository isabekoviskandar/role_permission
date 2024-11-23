@extends('layouts.adminLayout')

@section('title', 'Edit Role')

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
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createRoleModalLabel">Create New Role</h5>
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
                    @foreach ($permissionGroups as $permissionGroup)
                        <h3>{{ $permissionGroup->name }}</h3><br>
                        @foreach ($permissionGroup->permissions as $item)
                            <input type="checkbox" name="permissions[]" value="{{ $item->id }}" id="label{{ $item->id }}">
                            <label for="label{{ $item->id }}">{{ $item->name }}</label><br>
                        @endforeach
                        <br>
                    @endforeach
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </form>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const element = document.getElementById('permissions');
        const choices = new Choices(element, {
            removeItemButton: true,
            placeholder: true,
            placeholderValue: "Select permissions"
        });
    });
</script>

@endsection
