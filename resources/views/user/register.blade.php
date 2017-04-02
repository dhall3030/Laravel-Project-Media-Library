@extends('layout')





@section('content')

<main>
<section>

<div class="container main">


	
<?php

//echo count($errors);

?>


	

	@if(Session::has('flash_message'))
	    <div class="alert alert-success">
	        <p>{{ Session::get('flash_message') }}</p>
	    </div>
		@endif





	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
		@endif



{!! Form::open(array('route' => 'register-user' , 'name' => 'registration')) !!}



	
<h3>Register:</h3>

<p>{!! Form::label('name', 'Name:')!!}{!! Form::text('name') !!}</p>

<p>{!! Form::label('email', 'Email:')!!}{!! Form::email('email') !!}</p>



<p>{!! Form::label('Phone', 'Phone Number:')!!}{!! Form::tel('phone') !!}</p>

<p>{!! Form::label('password', 'Password:')!!}{!! Form::password('password') !!}</p>

<p>{!! Form::label('confirm_password', 'Confirm Password:')!!}{!! Form::password('password_confirmation') !!}</p>


<p>{!! Form::submit('Submit') !!}</p>



{!! Form::hidden('Go') !!}


{!! Form::close() !!}

</div>

</section>

</main>


@stop