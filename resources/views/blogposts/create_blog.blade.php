@extends('layouts.app')

@section('content')
<div class="container">
	<form method="post" action="{{isset($post)?'../update':'create'}}">
		@csrf
	  <div class="form-group">
		<label for="blogName">Blog Name:</label>
		<input type="text" class="form-control {{ $errors->has('blogName') ? ' is-invalid' : '' }}" id="blogName" name="blogName" placeholder="Enter blog name/title" value="{{ old('blogName')?old('blogName'):(isset($post)?$post->blog_name:"") }}" required>
		@if ($errors->has('blogName'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('blogName') }}</strong>
            </span>
        @endif
	  </div>
	  <div class="form-group">
		<label for="blogPost">Blog Post:</label>
		<textarea class="form-control {{ $errors->has('blogPost') ? ' is-invalid' : '' }}" id="blogPost" name="blogPost" rows="20" required>{{ old('blogPost')?old('blogPost'):(isset($post)?$post->blog_post:"") }}</textarea>
		@if ($errors->has('blogPost'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('blogPost') }}</strong>
            </span>
        @endif
		@if(isset($post))
			<input type="hidden" name="postID" value="{{$post->id}}">
		@endif
	  </div>
	  <div class="form-group">
		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="button" class="btn btn-outline-danger" onClick="cancelPostCreate();">Cancel</button>
	  </div>
	</form>
</div>
@endsection
