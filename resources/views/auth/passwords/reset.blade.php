@extends('layout')





@section('content')

<main>




<section>

<div class="container">


  

    
<h3>Reset Password</h3>


    <form   method="POST" action="{{ url('/password/reset') }}">
    {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">

    <p><label for="email">E-Mail Address</label><input id="email" type="email"  name="email" value="{{ $email or old('email') }}"> </p>

    @if ($errors->has('email'))
        <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif

    <p><label for="password">Password</label> <input id="password" type="password"  name="password"></p>


    @if ($errors->has('password'))
        <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif

    <p><label for="password-confirm">Confirm Password</label><input id="password-confirm" type="password"  name="password_confirmation"></p>

    @if ($errors->has('password_confirmation'))
        <span class="help-block">
        <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif

    <p><button type="submit">Reset Password</button></p>


    </form>





</div>

</section>

</main>


@stop