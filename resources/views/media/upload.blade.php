@extends('layout')





@section('content')

<main>

<section>

	<div class="container">


		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif


	 
		{!! Form::open(array('route' => array('upload-image', $media_id) , 'name' => 'uploadForm' , 'files' => true )) !!}
	 
	 	
	 	<p>{!! Form::file('image') !!}</p>


		<p>{!! Form::submit('Submit') !!}</p>

		{!! Form::hidden('Go') !!}

		
		{!! Form::close() !!}



	</div>

</section>

</main>


@stop