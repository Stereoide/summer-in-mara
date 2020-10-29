@extends('Layouts/default')

@section('content')
	<h1>Edit Character</h1>
	
	<form action="{{ route('characters.update', [$character->id,]) }} " method="post">
		@csrf
		@method('PUT')
		
		<label for="name">Name</label><br />
		<input type="text" name="name" id="name" value="{{ $character->name }}" />
		<br />
		
		<label for="island_id">Island</label><br />
		<select name="island_id" id="island_id" size="1">
		@foreach ($islands as $island)
			<option value="{{ $island->id }}" @if ($character->island_id === $island->id) selected @endif >{{ $island->name }}</option>
		@endforeach
		</select><br />
		<br />
		
		<input type="submit" value="Save" />
		<a href="{{ route('characters.index') }}" class="btn">Cancel</a><br />
	</form>
	
@endsection