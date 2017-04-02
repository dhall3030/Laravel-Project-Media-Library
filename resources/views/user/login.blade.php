@extends('layout')





@section('content')

<main>




<section>

<div class="container main">


	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
		@endif



{!! Form::open(array('route' => 'user-login' , 'name' => 'loginForm')) !!}













	
<h1>Login:</h1>



<p>{!! Form::label('email', 'Email:')!!}{!! Form::email('email') !!}</p>

<p>{!! Form::label('password', 'Password:')!!}{!! Form::password('password') !!}</p>

<p>{!!Form::checkbox('name', 'value')!!}{!! Form::label('remember', 'Remember Me:')!!}</p>


<p>
<button>
<i class="fa fa-sign-in" aria-hidden="true"></i> Login
</button>
</p>

<a href ="{{ App::make('url')->to('/') }}/password/reset">Reset Password</a>



{!! Form::hidden('Go') !!}


{!! Form::close() !!}

</div>

</section>

</main>


@stop