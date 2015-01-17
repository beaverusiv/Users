@extends('base.frontend')

@section('title')
Register
@stop

@section('content')
<h2>Register</h2>
{{ Form::open(['route' => 'users.register']) }}
{{ Form::label('name', 'Name') }} <br />
{{ Form::text('name') }} <br />
{{ Form::label('email', 'Email') }} <br />
{{ Form::email('email') }} <br />
{{ Form::label('password', 'Password') }} <br />
{{ Form::password('password') }} <br />
{{ Form::label('password_confirmation', 'Confirm Password') }} <br />
{{ Form::password('password_confirmation') }} <br />
{{ Form::submit('Login') }}
{{ Form::close() }}
@stop