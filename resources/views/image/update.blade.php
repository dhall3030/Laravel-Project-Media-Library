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


		{!! Form::open(array('route' => array( 'update-image' ,$image->media_image_id) , 'name' =>'ImageForm')) !!}

		<h1>Update Media Image:</h1>

		<p>{!! Form::label('priority', 'Priority:')!!} {!! Form::number('priority' , $image->priority )!!}</p>

		



		{!! Form::hidden('Go') !!}
		{!! Form::submit('Submit') !!}
		{!! Form::close() !!}

		

	</div>


</section>

@stop