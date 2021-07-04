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
                    <li class="breadcrumb-item"><a href="{{ route('roles.create') }}">Create</a></li>
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
                <table id="datatable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Permission</th>
                        <th scope="col">Update At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key=>$role)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $role->name }}</td>
                            @if($role->permissions->count()>0)
                            <td>{{ $role->permissions->count() }}</td>
                            @else
                            <td>No Permission</td>
                            @endif
                            <td>{{ $role->updated_at->diffForHumans() }}</td>
                            <td style="display: flex">
                                <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success">Edit</a>

                                @if($role->delteable==true)
                                <form  style="direction: inline" action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="DELETE" class="btn btn-danger">
                                </form>
                                @endif
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
    <script src="https://code.jquery.com/jquery-3.5.1.js">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js">

        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
@endpush
