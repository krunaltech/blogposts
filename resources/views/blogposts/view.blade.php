@extends('layouts.app')

@section('content')
<div class="container">
	<div class="align-right view-all-btn">
		<a href="../new" class="btn btn-primary">Create new Blog</a>
		<a href="../list" class="btn btn-primary">View All</a>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title"><h3>{{$post->blog_name}}</h3></div>
			<div class="align-right">
				<div>Created By:{{$post->user->name}}</div>
				<div>Last updated At:{{$post->updated_at}}</div>
			</div>
		</div>
		<div class="card-body">
			<div class="card-text">{{$post->blog_post}}</div>
		</div>
		@if($post->user_id == $user->id || $user->role == "admin")
		<div class="align-right">
			<a class="view_links" href="../edit/{{$post->id}}">Edit</a>
			<a class="view_links" href="../delete/{{$post->id}}">Delete</a>
		</div>
		@endif
	</div>
</div>
@endsection
