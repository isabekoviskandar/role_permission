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
        <a href="/roles" class="btn btn-primary m-2">Roles</a>
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
                            <h3 class="card-title">Edit Role</h3>
                        </div>
                        
                        <form action="{{ route('role.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="nameInput">Role Name</label>
                                    <input type="text" class="form-control" name="name" id="nameInput" value="{{ $role->name }}" required>
                                    @error('name')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Permissions Input with Choices.js -->
                                <div class="form-group">
                                    <label for="permissions">Permissions</label>
                                    <select id="permissions" name="permissions[]" multiple>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}" 
                                                @if(in_array($permission->id, $role->permissions->pluck('id')->toArray())) selected @endif>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('permissions')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Role</button>
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
