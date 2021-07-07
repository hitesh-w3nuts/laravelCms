@extends('layout.app')
@section('content')
<h1>Post Page</h1>
<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Name</th>
		</tr>
	</thead>
	<?php $i=0; ?>
	@if(count($posts))
		@foreach($posts as $post)
			<?php $i++; ?>
			<tr>
				<td>{{$i}}</td>
				<td>{{$post}}</td>
			</tr>
		@endforeach
	@endif
</table>
@endsection