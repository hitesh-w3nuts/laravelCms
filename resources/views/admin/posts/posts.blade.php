<?php use App\Post; ?>
@extends('layout.admin.app')
@section('page-title')
<h1>Posts</h1>
@endsection
@section('content')
<a href="/admin/add-new/{{$passData['current']}}" class="btn btn-primary">Add new</a>
<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Category</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<?php $i=0; ?>
	@if(count($passData['posts']))
		@foreach($passData['posts'] as $post)
			<?php $i++; ?>
			<tr>
				<td>{{$i}}</td>
				<td>{{$post->name}}</td>
				<td>
					@if($post->categoryID > 0)	
						{{Post::find($post->id)->category->name}}
					@endif
				</td>
				<td>{{date('d-m-Y h:i:s', strtotime($post->created_at))}}</td>
				<td><a href="/admin/edit/{{$passData['current']}}/{{$post->id}}"><i class="fa fa-edit"></i></a></td>
			</tr>
		@endforeach
	@else
		<tr>
			<td colspan="3"><h3 class="text-center">Posts not found</h3></td>
		</tr>
	@endif
</table>
@endsection