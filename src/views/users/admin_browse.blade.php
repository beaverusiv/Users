@extends('base.backend')

@section('title')
Browse Users
@stop

@section('content_header')
<h1>
    Browse Users
</h1>
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Users</h3>
                        <div class="box-tools">
                            <div class="input-group">
                                <input name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" type="text">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        {{ HTML::linkRoute('users.adminEdit', 'Edit', [$user->id], ['class' => 'btn btn-primary btn-sm']) }}
                                        {{ HTML::linkRoute('users.adminDelete', 'Delete', [$user->id], ['class' => 'btn btn-danger btn-sm']) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->links(); }}

                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            </div>
        </div><!--/.col -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
@stop