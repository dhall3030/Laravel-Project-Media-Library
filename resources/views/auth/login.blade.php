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

<h3>Login:</h3>

<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
{{ csrf_field() }}

<p><label for="email">E-Mail Address</label> 
<input id="email" type="email"  name="email" value="{{ old('email') }}">
</p>
 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
 
<p><label for="password" >Password</label><input id="password" type="password"  name="password"></p>

 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

 <p><label><input type="checkbox" name="remember"> Remember Me</label></p>

 <p><button type="submit" ><i class="fa fa-btn fa-sign-in"></i> Login </button><p>

 <p><a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a></p>

</form>


</div>

</section>

</main>


@stop
