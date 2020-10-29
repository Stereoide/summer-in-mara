@extends('Layouts/default')

@section('content')
	<h1>Items</h1>
	
	@forelse ($items as $item)
		<a href="{{ route('items.edit', [$item->id,]) }}">{{ $item->name }}</a><br />
	@empty
		No items created yet<br />
	@endforelse
	
	<a href="{{ route('items.create') }}" class="btn">Add item</a><br />
@endsection