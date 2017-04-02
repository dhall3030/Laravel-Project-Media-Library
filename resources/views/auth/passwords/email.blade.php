@extends('layout')





@section('content')

<main>




<section>

<div class="container">


     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif



 







    
<h3>Reset Password</h3>



    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}


    <p><label for="email">E-Mail Address:</label><input id="email" type="email"  name="email" value="{{ old('email') }}"><p>


    @if ($errors->has('email'))
        <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif



    <button type="submit" class="btn btn-primary">
     Send Password Reset Link
    </button>








</div>

</section>

</main>


@stop