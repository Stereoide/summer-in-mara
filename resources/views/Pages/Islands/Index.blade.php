@extends('Layouts/default')

@section('content')
	<h1>Islands</h1>
	
	@forelse ($islands as $island)
		<a href="{{ route('islands.edit', [$island->id,]) }}">{{ $island->name }}</a> ({{ $island->characters()->count() }})<br />
	@empty
		No islands created yet<br />
	@endforelse
	
	<a href="{{ route('islands.create') }}" class="btn">Add island</a><br />
@endsection