<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topic_id)
    {
        $posts = Post::where(['topic_id' => $topic_id])->withCount('comments')->get();

        return response($posts, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $user = $request->user();

         $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'topic_id' => 'exists:topics,id'
        ]);

        $post = Post::create([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'user_id' => $user->id,
                'topic_id' => $request->get('topic_id')
        ]);



        return response($post,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where(['id' => $id])->with('comments')->with('replies')->get();
        return response($post,200 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = $request->user();
        $post = Post::where(['user_id' => $user->id , 'id' => $id])->with('comments')->first(); // make sure the post belongs to the user

        //$post = Post::with('comments')->find(['user_id' => $user->id , 'id' => $id]);
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'string'
        ]);

        $post->update($data);

        return response($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $post = Post::where(['user_id' => $user->id , 'id' => $id])->with('comments')->first(); // make sure the post belongs to the user
        $post->delete();
        return response(204);
    }
}
