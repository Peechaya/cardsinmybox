@extends('layouts.master')

@section('title')
@parent
:: Inscription
@stop

@section('content')
</nav>

<h1>Register</h1>

<div class="alert alert-danger alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ HTML::ul($errors->all() )}}
</div>
{{ Form::open(array('url' => 'user')) }}

<div class="form-group">
	{{Form::label('username','Username*')}}
	{{Form::text('username', null,array('class' => 'form-control'))}}
</div>

<div class="form-group">
	{{Form::label('email','Email*')}}
	{{Form::text('email', null,array('class' => 'form-control'))}}
</div>
<div class="form-group">
	{{Form::label('password','Password*')}}
	{{Form::password('password',array('class' => 'form-control'))}}
</div>

<div class="form-group">
	{{Form::label('confirm_password','Confirm Password*')}}
	{{Form::password('confirm_password',array('class' => 'form-control'))}}
</div>

{{Form::submit('Register', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}

@stop