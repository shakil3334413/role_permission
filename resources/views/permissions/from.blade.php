@extends('layouts.app') @push('css')
{{--  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />  --}}
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
                    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Back</a></li>
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
                <form action="{{ isset($permission) ? route('permissions.update',$permission->id) : route('permissions.store') }}" method="POST">
                    @csrf @isset($permission) @method('PUT') @endisset

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Manage Permission</h5>
                                <br />
                                <div class="form-group">
                                    <label for="name">Permission Name</label>
                                    <input id="name" type="text" placeholder="Permission Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $permission->name ?? old('name') }}" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Slug</label>
                                    <input id="email" type="text" placeholder="Slug" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $permission->slug ?? old('slug') }}" />
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roles">Module Name</label>
                                <select class="js-example-basic-single form-control @error('module_id') is-invalid @enderror" id="roles" name="module_id">
                                    <option value="">Select Module</option>
                                    @foreach ($modules as $module)
                                    <option value="{{ $module->id }}" @isset($permission) {{ $module->id==$permission->module_id ?'selected' : '' }} @endif>{{ $module->name }}</option>
                                    @endforeach
                                </select>
                                @error('module_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @isset($permission)
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
{{--  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  --}}

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
