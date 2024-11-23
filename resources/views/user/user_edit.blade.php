@extends('layouts.adminLayout')

@section('title', 'Edit User')

@section('content')

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <a href="/users" class="btn btn-primary m-2">Users</a>
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
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="nameInput">Name</label>
                                    <input type="text" class="form-control" name="name" id="nameInput" value="{{ $user->name }}">
                                    @error('name')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" class="form-control" name="email" id="emailInput" value="{{ $user->email }}">
                                    @error('email')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                                    <!-- Roles Input with Select2 -->
                                    <div class="form-group">
                                        <select id="roles" name="roles[]" multiple>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" 
                                                    @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach

                                        </select>
                                        
                                    </div>
                                <!-- Roles -->
                                {{-- <div class="form-group">
                                    <label for="rolesInput">Roles</label>
                                    <select multiple class="form-control" name="roles[]" id="rolesInput">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" 
                                                    @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div> --}}
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
