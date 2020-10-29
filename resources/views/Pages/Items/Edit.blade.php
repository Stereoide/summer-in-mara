@extends('Layouts/default')

@section('content')
	<h1>Edit Item</h1>

	<form action="{{ route('items.update', [$item->id,]) }} " method="post">
		@csrf
		@method('PUT')

		<label for="name">Name</label><br />
		<input type="text" name="name" id="name" value="{{ $item->name }}" autofocus />
		<br />

		<input type="submit" value="Save" />
		<a href="{{ route('items.index') }}" class="btn">Cancel</a><br />
	</form>

@endsection
