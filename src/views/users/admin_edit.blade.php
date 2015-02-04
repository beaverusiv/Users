@extends('base.backend')

@section('title')
Edit User
@stop

@section('content_header')
<h1>Edit User</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-body table-responsive">
                <!-- text input -->
                <div class="form-group">
                    {{ Form::model($user, ['route' => ['users.adminSave', $user->id]]) }}
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', null, ['class' => 'form-control']) }}
                    {{ Form::label('home_route', 'Home Route') }}
                    {{ Form::text('home_route', null, ['class' => 'form-control']) }}
                    {{ Form::label('groups[]', 'Groups') }}
                    {{ Form::select('groups[]', $groups, $selected_groups, ['id' => 'groups', 'class' => 'form-control', 'multiple' => 'multiple']) }}
                    {{ Form::submit('Save Details') }}
                    {{ Form::close() }}
                </div>

            </div><!-- /.box-body -->

        </div><!-- /.box -->
    </div>
</div>
@stop

@section('scripts')
<script>
    $("#groups").chosen({no_results_text: "No group with that name."});
</script>
@stop