@extends('Layouts/default')

@section('content')
	<h1>Add Island</h1>
	
	<form action="{{ route('islands.store') }}" method="post">
		@csrf
		
		<label for="name">Name</label><br />
		<input type="text" name="name" id="name" value="{{ $island->name }}" />
		<br />
		
		<input type="submit" value="Save" />
		<a href="{{ route('islands.index') }}" class="btn">Cancel</a><br />
	</form>
	
@endsection