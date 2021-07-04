@extends('layouts.app')

@push('css')


@endpush


@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Module</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    @can('permissions.create')
                    <li class="breadcrumb-item"><a href="{{ route('permissions.create') }}">Create</a></li>
                    @endcan
                    <li class="breadcrumb-item active">Module</li>
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
                <table id="datatable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Module Name</th>
                        <th scope="col">Permission Name</th>
                        <th scope="col">Slug Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key=>$permission)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            @if($permission->module)
                            <th>{{ $permission->module->name }}</th>
                            @else
                            @endif
                            <td>{{ $permission->name }} </td>
                            <td>{{ $permission->slug }} </td>
                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                            <td style="display: flex">
                                @can('permissions.edit')
                                <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-success">Edit</a>
                                @endcan
                                @can('permissions.delete')
                                <form  style="direction: inline" action="{{ route('permissions.destroy',$permission->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="DELETE" class="btn btn-danger">
                                </form>
                                @endcan
                            </td>
                          </tr>

                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('js')

@endpush
