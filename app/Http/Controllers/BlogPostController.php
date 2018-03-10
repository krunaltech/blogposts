<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Posts;

class BlogPostController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function new_post()
	{
		return view("blogposts.create_blog");
	}
	
	public function create(Request $request)
	{
		$user = Auth::user();
		
		$validator = $this->validation($request);
		if ($validator->fails()) {
            return redirect('posts/new')
                        ->withErrors($validator)
                        ->withInput();
        }
		
		$post_data = new \stdClass();
		$post_data->blog_name = $request->input("blogName");
		$post_data->blog_post = $request->input("blogPost");
		$post_data->user_id = $user->id;
		$post_id = $this->save($post_data);
		return redirect('posts/view/'.$post_id);
	}
	
	public function save($data, $post_id=null)
	{
		if($post_id == null)
		{
			$post = new Posts;
			$post->user_id = $data->user_id;
		}
		else
			$post = Posts::find($post_id);
		$post->blog_name = $data->blog_name;
		$post->blog_post = $data->blog_post;		
		$post->save();
		return $post->id;
	}
	
	public function validation($request, $post_id=null)
	{
		return Validator::make($request->all(), [
            'blogName' => 'required|unique:posts,blog_name,'.$post_id.'|max:300',
            'blogPost' => 'required'
        ]);
		
	}
	
	public function view(Request $request, $post_id)
	{
		$post = Posts::find($post_id);
		
		if($post === null)
			return redirect('posts/list');
		$user = Auth::user();
		return view("blogposts.view", ["post"=>$post,"user"=>$user]);
	}
	
	public function edit(Request $request, $post_id)
	{
		$post = Posts::find($post_id);
		if($post === null)
			return redirect('posts/list');
		return view("blogposts.create_blog", ["post"=>$post]);
	}
	
	public function list()
	{
		$posts = Posts::all();
		$user = Auth::user();
		return view("blogposts.list", ["posts"=>$posts,"user"=>$user]);
	}
	
	public function delete(Request $request, $post_id)
	{
		$post = Posts::find($post_id);
		if($post)
			$post->delete();
		return redirect('posts/list');
	}
	
	public function update(Request $request)
	{
		$post_id = $request->input("postID");
		$validator = $this->validation($request, $post_id);
		if ($validator->fails()) {
            return redirect('posts/view/'.$post_id)
                        ->withErrors($validator)
                        ->withInput();
        }
		
		$post_data = new \stdClass();
		$post_data->blog_name = $request->input("blogName");
		$post_data->blog_post = $request->input("blogPost");
		
		$post_id = $this->save($post_data, $post_id);
		return redirect('posts/view/'.$post_id);
	}
}
