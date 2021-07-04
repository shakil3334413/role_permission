@extends('layouts.app') @push('css') @endpush @section('content')

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
                    <li class="breadcrumb-item"><a href="{{ route('modules.index') }}">Back</a></li>
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
                <form action="{{ isset($module) ? route('modules.update',$module->id) : route('modules.store') }}" method="POST">
                    @csrf @isset($module) @method('PUT') @endisset
                    <div class="card-body">
                        <h5 class="card-title">Manage Modules</h5> <hr>
                        <br />
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" placeholder="Module Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $module->name ?? old('name') }}" />
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @isset($module)
                        <input type="submit" class="btn btn-danger" value="Update" />
                        @else
                        <input type="submit" class="btn btn-danger" value="Create" />
                        @endisset
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js') @endpush
