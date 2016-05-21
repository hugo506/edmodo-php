@extends('layouts.app') @section('content')

<div class="panel-body">

	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span> {{$error_message}}
	</div>
</div>

@endsection
