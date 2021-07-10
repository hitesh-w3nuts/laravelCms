@extends('layout.admin.app')
@section('page-title')
<h1>Add new {{ucfirst(str_replace('_',' ', $passData['current']))}}</h1>
@endsection
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/summernote/summernote-bs4.min.css')}}">
@endsection
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('failed') }}
</div>
@endif
<form method="post" action="/posts">
	<input type="hidden" name="type" value="{{$passData['current']}}">
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
	<div class="row">
		<div class="col-md-9">
			<div class="form-group">
	            <input type="text" class="form-control" name="name" id="title" placeholder="Title">
          	</div>
          	<div class="form-group">
	            <textarea class="form-control" name="content" rows="20" id="summernote"></textarea>
          	</div>
		</div>
		<div class="col-md-3">
			<div class="side-wrap text-right">
				<div class="form-group">
		            <input type="submit" class="btn btn-primary" value="Publish">
	          	</div>
	          	
	          	<div class="card card-primary">
              		<div class="card-header">
	                	<h3 class="card-title">Categories</h3>
	              	</div>
	              	<div class="card-body">
	              		@if(isset($passData['cats']) && !empty($passData['cats']))
		              	<div class="text-left" style="padding: 10px 10px;">
		              		@foreach($passData['cats'] as $cat)
				              	<div class="form-group">
				              		<div class="form-check">
						            	<input class="form-check-input" name="categoryID" value="{{$cat['term_id']}}" type="checkbox">
				              			<label class="form-check-label">{{$cat['name']}}</label>
				              		</div>
					          	</div>
					          	@if(isset($cat['child']) && !empty($cat['child']))
					          	<div class="text-left" style="padding: 5px 10px;">
					          		@foreach($cat['child'] as $cCat)
					              	<div class="form-group">
					              		<div class="form-check">
							            	<input class="form-check-input" name="categoryID" value="{{$cCat['term_id']}}" type="checkbox">
				              			<label class="form-check-label">{{$cCat['name']}}</label>
					              		</div>
						          	</div>
						          	@endforeach
				              	</div>
				              	@endif
				            @endforeach
		              	</div>
		              	@endif
		            </div>
	          	</div>
			</div>
		</div>
	</div>
</form>
@endsection
@section('page-script')
<script type="text/javascript" src="{{ asset('css/admin/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#summernote').summernote({
			height: 300,
			fonts:false,
		});
	});
</script>
@endsection