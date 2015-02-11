@extends('base.frontend')

@section('title')
Login
@stop

@section('content')
<h2>Login</h2>
{!! Form::open(['route' => 'users.login']) !!}
{!! Form::label('email', 'Email') !!} <br />
{!! Form::email('email') !!} <br />
{!! Form::label('password', 'Password') !!} <br />
{!! Form::password('password') !!} <br />
{!! Form::submit('Login') !!}
{!! Form::close() !!}
@stop