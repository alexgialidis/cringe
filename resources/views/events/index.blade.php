@extends ('layout')

@section ('content')

@foreach ($events as $event)

	<h2>{{ $event['title'] }}</h2>

	<p>{{ $event['description'] }}</p>

	<hr>

@endforeach	

@endsection