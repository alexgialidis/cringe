@extends ('layout')

@section ('content')

	<h1>{{ $event['title'] }}</h1>

	<p>{{ $event['description'] }}</p>

	<a href="/events/{{ $event['id'] }}/buy">Buy ticket</a>

@endsection