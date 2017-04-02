@extends('layout')





@section('content')

<section id="media_profile">

	<div class="container media-profile">

	<?php
	 
	 
	 $main_image = $media->images->first();

	

	 
	
	?>
    
    <div class="col-four"> 

    @if ($main_image != null)
	<img class="profile-image" src="{{ App::make('url')->to('/') }}/media_images/image/{{$main_image['image']}}">
	@endif

	</div>

	<div class="col-eight media-info "> 

	<p><strong>Name:</strong> {{$media->name}}</p>

	<!--<p>{{$media->media_type_id}}</p>-->

	<p><strong>Media Type:</strong> {{$media->media_type->name}}</p>

	<p><strong>Description:</strong></p>

	<p>{{$media->description}}</p>

	</div>

	<div class="col-twelve">
	
	@foreach ($media->images as $image)

		<!-- <div class="media-thumb">

		

		

		<img src="{{ App::make('url')->to('/') }}/media_images/thumb/{{$image->image}}">

		


		</div> -->


	@endforeach

	</div>

	<div class="col-four">
	
	@foreach ($media->images as $image)

		<div class="media-thumb-alt">

		

		

		<img src="{{ App::make('url')->to('/') }}/media_images/image/{{$image->image}}">

		


		</div>


	@endforeach

	</div>





	</div>

</section>




@stop