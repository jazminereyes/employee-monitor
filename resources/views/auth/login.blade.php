@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="wrap-login100">
	<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
        @csrf
		<h5>Welcome Back!</h5>
					
		<div class="wrap-input100 m-b-20">
			<input id="email" type="email" class="input100 @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <span class="focus-input100 @error('email') no-focus @enderror"></span>
        </div>

        @error('email')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

		<div class="wrap-input100 m-b-20">
			<input id="password" type="password" class="input100 @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
            <span class="focus-input100 @error('password') no-focus @enderror"></span>
        </div>
 
        @error('password')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        @if(session()->has('error'))
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ session()->get('error') }}</strong>
            </span>
        @endif
					
		<div class="container-login100-form-btn">
			<button class="login100-form-btn" type="submit">Sign in</button>
        </div>
                    
        <div class="login-footer">
            <a href="{{ url('register/company') }}">Register as Company</a>
        </div>
	</form>

	<div class="login100-more left-div"></div>
</div>
@endsection