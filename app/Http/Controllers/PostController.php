<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get()->toArray();
        // dd($post);die;
        return view('posts.show')->with(compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo '<pre>'; print_r($data);die;
            $post = new Post;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->status = 1;
            $post->save();
            return redirect()->back()->with('success', 'Post added successfully');
        }
        
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $postDetails = Post::find($post['id']);
        // dd($postDetails);die;
        return view('posts.edit')->with(compact('postDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($request->isMethod('put')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            Post::where('_id',$post['_id'])->update(['title'=>$data['title'], 'description'=>$data['description']]);
            return redirect('/posts')->with('message', 'Post Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(isset($post['_id'])){

        Post::where('_id',$post['_id'])->delete();

        return redirect('/posts')->with('message', 'Post Deleted Successfully');
    }

  }
}
