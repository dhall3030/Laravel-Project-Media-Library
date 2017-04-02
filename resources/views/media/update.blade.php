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


		{!! Form::open(array('route' => array( 'update-media' ,$media->media_id) , 'name' =>'MediaForm')) !!}

		<h1>Update Media Item:</h1>

		<p>{!! Form::label('name', 'Name:')!!}{!! Form::text('name' ,$media->name)!!}</p>

		<p>{!! Form::label('number_of_copies', 'Number Of Copies: ')!!}{!! Form::number('name' ,$media->number_of_copies)!!}</p>

		
		<p>{!! Form::label('description', 'Description:')!!}{!! Form::textarea('description' ,$media->description)!!}</p>

		<p>{!! Form::label('media_type_id', 'Media Type:')!!} {!! Form::select('media_type_id', $media_type , $media->media_type_id ) !!}</p>



		{!! Form::hidden('Go') !!}
		{!! Form::submit('Submit') !!}
		{!! Form::close() !!}

		<h3>Upload images:</h3>	

		{!! Form::open(array('route' => array('upload-multiple',$media->media_id) , 'name' => 'uploadForm' , 'files' => true  )) !!}
	 
	 	
	 	<p>{!! Form::file('image[]' , array('multiple' => 'true')  ) !!}</p>


		<p>{!! Form::submit('Submit') !!}</p>

		{!! Form::hidden('Go') !!}

		
		{!! Form::close() !!}


		


		@foreach ($media->images as $image)

		<div class="media-thumb">

		<div class="image-delete">

		<a href="{{ App::make('url')->to('/update-image') }}/{{$image->media_image_id}}" title="update">[+]</a>	

		<a href="{{ App::make('url')->to('/delete-media-image') }}/{{$image->media_image_id}}" title="Delete">[x]</a>

		</div>

		<img src="{{ App::make('url')->to('/') }}/media_images/thumb/{{$image->image}}">

		


		</div>


		@endforeach

	</div>


</section>

@stop