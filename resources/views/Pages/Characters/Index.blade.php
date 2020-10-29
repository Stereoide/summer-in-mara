@extends('Layouts/default')

@section('content')
	<h1>Characters</h1>
	
	@forelse ($characters as $character)
		<a href="{{ route('characters.edit', [$character->id,]) }}">{{ $character->name }} / {{ $character->island->name }}</a> ({{ $character->items()->count() }})<br />
	@empty
		No characters created yet<br />
	@endforelse
	
	<a href="{{ route('characters.create') }}" class="btn">Add character</a><br />
@endsection