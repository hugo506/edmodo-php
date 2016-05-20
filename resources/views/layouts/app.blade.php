<!DOCTYPE html>
<html lang="en">
<head>
<title>Edmodo Simple App</title>

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">

</head>

<body>


	<div class="container">

		<div class="navbar">
			<a class="navbar-brand" href="{{ url('dashboard') }}"> <img alt="Brand"
				src="https://www.edmodo.com/images_v2/marketing/shared/logo-blue.png" />
			</a>
			
			<p class="navbar-text pull-right">
			@if (isset($student))
						
				Welcome Student {{ $student->name }} ! | <a href="{{ url('logout') }}"
					class="navbar-link">Logout</a>
		
			@endif
			
			@if (isset($teacher))
			
				Welcome Teacher {{ $teacher->name }} | <a href="{{ url('logout') }}"
					class="navbar-link">Logout</a>
			
			
			@endif
			
			</p>
			
		</div>

		@yield('content')

	</div>



</body>
</html>