@extends('Layouts/default')

@section('content')
	<h1>Edit Island</h1>
	
	<form action="{{ route('islands.update', [$island->id,]) }} " method="post">
		@csrf
		@method('PUT')
		
		<label for="name">Name</label><br />
		<input type="text" name="name" id="name" value="{{ $island->name }}" />
		<br />
		
		<input type="submit" value="Save" />
		<a href="{{ route('islands.index') }}" class="btn">Cancel</a><br />
	</form>
	
@endsection