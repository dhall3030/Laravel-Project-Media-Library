@extends('layout')





@section('content')

<section>

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



			<h1>Home</h1>


			<ul>

				<li><a href ="{{ App::make('url')->to('/') }}/search-media">Search</a></li>
		 		<li><a href ="{{ App::make('url')->to('/') }}/user-login">Login</a></li>	

			</ul>

	


	</div>

</section>


@stop