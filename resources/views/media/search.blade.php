@extends('layout')


@section('content')

<section id="media_search">

	<div class="container">


		{!! Form::open(array('route' => 'search-media' , 'name' => 'MediaForm')) !!}


		<h1>Search Media Items:</h1>


		<p>{!! Form::label('search', 'Search:')!!}{!! Form::text('value' , $value) !!}</p>

		<p>{!! Form::label('media_type_id', 'Media Type:')!!} {!! Form::select('media_type_id', $media_type ,$media_type_id) !!}</p>



		{!! Form::hidden('Go') !!}
		{!! Form::submit('Search') !!}
		{!! Form::close() !!}




		

	<div>

</section>




@if (isset($results) )


<section id="media_results">

	<div class="container">

			
			<table class="table">

				<thead>
					
					<tr>
						<th>Item Name</th>	
						<th>View</th>	

					</tr>

				</thead>

				

				<tbody>
					
				


				@foreach ($results as $result)

				<tr>


				<td>{{$result->name}}</td>
				<td><a href ="{{ App::make('url')->to('/') }}/get-profile/{{$result->media_id}}" >View</a></td> 

				</tr>


				@endforeach


				</tbody>

			 <br>

			@if(count($results) > 0)

		    {{count($results)}} results found. <br>
			
		    @else

		    0 results found.

			@endif




			{{ $results->links() }}


			</table>


	</div>


</section>		




		@endif




@stop