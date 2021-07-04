@extends('layouts.app')

@push('css')

{{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">  --}}
{{--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">  --}}
@endpush


@section('content')

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
                    <li class="breadcrumb-item"><a href="{{ route('users.create') }}">Create</a></li>
                    <li class="breadcrumb-item active">User</li>
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
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Join At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=>$user)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $user->name }} <br>
                                @if($user->role)
                                    <span style="color: red;font-size: 12px;">{{ $user->role->name }}</span>
                                    @else
                                    <span style="color: red;font-size: 12px;">No Role Found</span>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            @if($user->is_active==1)
                            <td>Active</td>
                            @else
                            <td>InActive</td>
                            @endif
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td style="display: flex">
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success">Edit</a>
                                <form  style="direction: inline" action="{{ route('users.destroy',$user->id) }}" method="POST">
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
    <script src="https://code.jquery.com/jquery-3.5.1.js">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js">

        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
@endpush
