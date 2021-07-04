@extends('layouts.app')

@push('css')

{{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">  --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Roles</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                    <li class="breadcrumb-item active">Roles</li>
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
                <form action="{{ isset($role) ? route('roles.update',$role->id) : route('roles.store') }}" method="POST">
                    @csrf
                    @isset($role)
                        @method('PUT')
                    @endisset
                    <div class="card-body">
                        <h5 class="card-title"> Manage Role</h5>
                        <div class="form-group">
                            <input id="name" type="text" placeholder="Role Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}"/>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    <div class="text-center">
                        <strong>Manage Permission For Role</strong> <br>
                        @if($errors->has('permissions'))

                        <strong>The Permission field is requied</strong>

                @endif
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="select-all">
                            <label for="select-all" class="custom-control-label">Select All</label>
                        </div>
                    </div>
                        @forelse ( $modules->chunk(3) as $key=>$chunks)
                            @foreach ($chunks as $key=> $module)

                            <div class="col">
                                <h5>Module: {{ $module->name }}</h5>

                                @foreach ($module->permissions as $key=>$permission)
                                <div class="mb-3 ml-4">
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-checkbox"
                                        id="permission-{{ $permission->id }}" name="permissions[]"
                                        value="{{ $permission->id }}"
                                        @isset($role)
                                            @foreach ($role->permissions as $rPermission)
                                                {{ $rPermission->id==$permission->id ? 'checked' :'' }}
                                            @endforeach
                                        @endisset
                                        >
                                        <label for="permission-{{ $permission->id }}" class="custom-control-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>

                                @endforeach
                            </div>

                            @endforeach

                        @empty

                        <div class="row">
                            <div class="col text-center">
                                <h5>No Module Found</h5>
                            </div>
                        </div>

                        @endforelse
                    </div>
                    @isset($role)
                    <input type="submit" class="btn btn-danger" value="Update">
                   @else
                    <input type="submit" class="btn btn-danger" value="Create">
                    @endisset
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('js')
        <script>
            $('#select-all').click(function(event){
                if(this.checked){
                    $(':checkbox').each(function(){
                        this.checked=true;
                    });
                }else{
                    $(':checkbox').each(function(){
                        this.checked=false;
                    });
                }
            });

        </script>
@endpush
