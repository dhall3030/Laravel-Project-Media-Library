@extends('layout')





@section('content')

<section id="media">

	<div class="container">


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

	<br>
	{{$hello}}
	<br>
	<ul>
	<li><a href ="{{ App::make('url')->to('/') }}/media">Manage Media</a></li>
	<li><a href ="{{ App::make('url')->to('/') }}/user-logout">Logout</a></li>
	</ul>


	</div>

</section>


@stop