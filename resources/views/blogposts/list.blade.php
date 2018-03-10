@extends('layouts.app')

@section('content')
<div class="container">
	<div class="align-right view-all-btn">
		<a href="new" class="btn btn-primary">Create new Blog</a>
	</div>
	@foreach($posts as $post)
		<div class="card list-card">
			<div class="card-header">
				<div class="card-title">
					<h3><a href="view/{{$post->id}}">{{$post->blog_name}}</a></h3>
				</div>
				<div class="align-right">
					<div>Created By:{{$post->user->name}}</div>
					<div>Last updated At:{{$post->updated_at}}</div>
				</div>
			</div>
			<div class="card-body">
				<div class="card-text list-card-text">{{$post->blog_post}}</div>
			</div>
			<div class="align-right">
				<a class="view_links" href="view/{{$post->id}}">View</a>
				@if($post->user_id == $user->id || $user->role == "admin")
					<a class="view_links" href="edit/{{$post->id}}">Edit</a>
					<a class="view_links" href="delete/{{$post->id}}">Delete</a>
				@endif
			</div>
		</div>
	@endforeach
</div>
@endsection
