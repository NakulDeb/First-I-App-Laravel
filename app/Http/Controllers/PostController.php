<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.post.posts')->withPosts(Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.post.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->author_id = Auth::user()->id ;
        $post->title = $request->title;
        $post->body = $request->body;
        $image = $request->image;

        $image_name = 'post-image-'.time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/images', $image_name);
        $image_path = 'images/'.$image_name;

        $post->image = $image_path;
        $post->save();

        session()->flash('success-message','Post Created Successful...');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('Backend.post.create-post')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $old_image = $post->image;

        $image = $request->image;
        if($image){

            $image_name = 'post-image-'.time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images', $image_name);
            $image_path = 'images/'.$image_name;
            $post->image = $image_path;

            if($old_image){
                unlink(public_path() .'/storage/'. $old_image);
            }
        }

        $post->save();

        session()->flash('success-message','Post Updated Successful...');
        return redirect(Route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $image = $post->image;
        if($image){
            unlink(public_path() .'/storage/'. $image);
        }
        $post->delete();
        session()->flash('success-message','Post Deleted Successful...');
        return redirect(Route('post.index'));
    }

    public function update_status(Post $post){
        $post->status = !$post->status;
        $post->update();

        $message = "";
        if($post->status){
            $message = "Post Unblocked Successful...";
        }
        else{
            $message = "Post Blocked Successful...";
        }

        session()->flash('success-message',$message);
        return redirect()->back();
    }
}
