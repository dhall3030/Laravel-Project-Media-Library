@extends('layout')




@section('content')


<section id="media">

	<div class="container">


	@if(Session::has('flash_message'))
	<div class="alert alert-success">
	<p>{{ Session::get('flash_message') }}</p>
	</div>
	@endif


	<p><a href ="{{ App::make('url')->to('/') }}/create-media/">Add New Media Item</a></p>

	
		{!! Form::open(array('route' => 'media' , 'name' => 'MediaForm')) !!}


		<h1>Search Media Items:</h1>


		<p>{!! Form::label('search', 'Search:')!!}{!! Form::text('value' , $value) !!}</p>

		<p>{!! Form::label('media_type_id', 'Media Type:')!!} {!! Form::select('media_type_id', $media_type ,$media_type_id) !!}</p>



		{!! Form::hidden('Go') !!}
		{!! Form::submit('Search') !!}
        {!! Form::close() !!}

        {!! Form::open(array('route' => 'media' , 'name' => 'MediaForm')) !!}
		{!! Form::hidden('Reset') !!}
		{!! Form::submit('Reset') !!}
		{!! Form::close() !!}

	

	</div>

</section>

@if (isset($media) )


<section id="media_results">

	<div class="container">

		<table class="table">

		<thead>

			<tr>
				 <th>Item Name</th>
				 <th>View</th>
				 <th>Edit</th>
				 <th>Delete</th>
			</tr>
			
		</thead>

	

		<tbody>
		@foreach ($media as $item)
		<tr>
		<td>{{$item->name}} - {{$item->media_type->name}}</td>
		<td><a href ="{{ App::make('url')->to('/') }}/get-profile/{{$item->media_id}}" >View</a></td>
		<td><a href ="{{ App::make('url')->to('/') }}/update-media/{{$item->media_id}}" >Edit</a></td>
		<td><a href ="{{ App::make('url')->to('/') }}/delete-media/{{$item->media_id}}">Delete</a></td>
		</tr>

		@endforeach

		</tbody>

	</table>

	@if(count($media) > 0)

		    {{count($media)}} results found. <br>
			
		    @else

		    0 results found.

			@endif


    {{ $media->links() }}


		
	</div>

</section>


@endif


@stop