@include('header')

@if (Auth::check())
	<section id="top_bar"> 

		<div class="container"> 

		<ul id="login_info">


		<li>{{Auth::user()->name}} is logged in <li>


		<li><strong>Last login:</strong> {{ date('F j, Y, g:i a', strtotime (Auth::user()->last_login)) }}</li>

		</ul>

		</div>


	</section>
@endif


<header id="main_header">


	<div class="container">


	


	<nav>

		 <div class="brand">Media Library</div>

		 <ul class="main-menu">
		 
		 
		 

		 @if (Auth::check())
		 <li><a href ="{{ App::make('url')->to('/') }}/admin-dashboard">Home</a></li>
		 <li><a href ="{{ App::make('url')->to('/') }}/media">Manage Media</a></li>
		 <li><a href ="{{ App::make('url')->to('/') }}/user-logout">Logout</a></li>
		 @else

		 
		 <li><a href ="{{ App::make('url')->to('/') }}">Home</a></li>
		 <li><a href ="{{ App::make('url')->to('/') }}/search-media">Search</a></li>
		 <li><a href ="{{ App::make('url')->to('/') }}/user-login">Login</a></li>	


		 @endif
		
		</ul>

	</nav>

	</div>



</header>

<main>
@yield('content')
</main>


@include('footer')