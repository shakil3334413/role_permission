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
                    <li class="breadcrumb-item"><a href="{{ route('modules.create') }}">Create</a></li>
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
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $key=>$module)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $module->name }} <br>
                            <td>{{ $module->created_at->diffForHumans() }}</td>
                            <td style="display: flex">
                                <a href="{{ route('modules.edit',$module->id) }}" class="btn btn-success">Edit</a>
                                <form  style="direction: inline" action="{{ route('modules.destroy',$module->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="DELETE" class="btn btn-danger">
                                </form>
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
