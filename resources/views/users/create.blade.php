@extends('layouts.app') @push('css') {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" />
@endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Back</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12 col-x-12 col-sm-12">
                <form action="{{ isset($user) ? route('users.update',$user->id) : route('users.store') }}" method="POST">
                    @csrf @isset($user) @method('PUT') @endisset

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Manage User</h5>
                                <br />
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" placeholder="User Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="c_password">Confirm Password</label>
                                    <input id="c_password" type="password" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" cols="30" rows="4" placeholder="Description">{{ $user->description ?? old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roles">Role Status</label>
                                <select class="form-control @error('role_id') is-invalid @enderror" id="roles" name="role_id">
                                    <option value="">Select User Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @isset($user) {{ $role->id==$user->role_id ?'selected' : '' }} @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  for="status">Status</label>
                                <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" id="status">
                                    <option value="1"  @isset($user) {{ $user->is_active==1 ?'selected' : '' }} @endif>Active</option>
                                    <option value="0" @isset($user) {{ $user->is_active==0 ?'selected' : '' }} @endif>In Active</option>
                                </select>
                                @error('is_active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br />
                            @isset($user)
                            <input type="submit" class="btn btn-danger" value="Update" />
                            @else
                            <input type="submit" class="btn btn-danger" value="Create" />
                            @endisset
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js')
<script>
    $("#select-all").click(function (event) {
        if (this.checked) {
            $(":checkbox").each(function () {
                this.checked = true;
            });
        } else {
            $(":checkbox").each(function () {
                this.checked = false;
            });
        }
    });
</script>
@endpush
