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
<?php 

$title = $content = $catId = $id = '';
$action = '/posts';
$method = 'post';
if(isset($passData['singlePost'])){
	$id = $passData['singlePost'][0]->id;
	$title = $passData['singlePost'][0]->name;
	$content = $passData['singlePost'][0]->content;
	$catId = $passData['singlePost'][0]->categoryID;
	$action = '/posts/update';
	$method = 'put';
}
?>


<form method="post" action="{{$action}}">
	<input type="hidden" name="type" value="{{$passData['current']}}">
	<input type="hidden" name="id" value="{{$id}}">
	@if(isset($passData['singlePost']))
		{{ method_field('PUT') }}
	@endif
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
	<div class="row">
		<div class="col-md-9">
			<div class="form-group">
	            <input type="text" class="form-control" name="name" id="title" value="{{$title}}" placeholder="Title">
	            @if ($errors->has('name'))
                    <span class="text-danger">Please enter title</span>
                @endif
          	</div>
          	<div class="form-group">
	            <textarea class="form-control" name="content" rows="20" id="summernote">{{$content}}</textarea>
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
		              			{{$selected = ''}}
		              			@if($cat['term_id'] == $catId)
		              				<?php $selected = 'checked'; ?>
	              				@endif
				              	<div class="form-group">
				              		<div class="form-check">
						            	<input class="form-check-input" name="categoryID" value="{{$cat['term_id']}}" type="radio" {{$selected}}>
				              			<label class="form-check-label">{{$cat['name']}}</label>
				              		</div>
					          	</div>
					          	@if(isset($cat['child']) && !empty($cat['child']))
					          	<div class="text-left" style="padding: 5px 10px;">
					          		@foreach($cat['child'] as $cCat)
						          		{{$selected = ''}}
				              			@if($cCat['term_id'] == $catId)
				              				<?php $selected = 'checked'; ?>
			              				@endif
					              	<div class="form-group">
					              		<div class="form-check">
							            	<input class="form-check-input" name="categoryID" value="{{$cCat['term_id']}}" {{$selected}} type="radio">
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