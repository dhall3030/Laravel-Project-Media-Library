@extends('layout')




@section('content')


<section id="media_profile">

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

	{!! Form::open(array('route' => 'create-media' , 'name' => 'MediaForm')) !!}
	<h3>Create Media Item:</h3>
	<p>{!! Form::label('name', 'Name:')!!}{!! Form::text('name') !!}</p>
	<p>{!! Form::label('number_of_copies', 'Number Of_Copies: ')!!}{!! Form::text('number_of_copies') !!}</p>
	<p>{!! Form::label('description', 'Description:')!!}{!! Form::textarea('description') !!}</p>
	<p>{!! Form::label('media_type_id', 'Media Type:')!!} {!! Form::select('media_type_id', $media_type) !!}</p>



	{!! Form::hidden('Go') !!}
	{!! Form::submit('Submit') !!}
	{!! Form::close() !!}


	</div>

</section>


@stop