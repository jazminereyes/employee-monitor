<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('/css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/steps.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="limiter">
		<div class="container-login100">
			@yield('content')
		</div>
    </div>
    @yield('js')
</body>
</html>