<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'comment_id' => 'required|exists:comments,id',
            'content' => 'required|string',
            'title' => 'required|string',

        ]);

        $comment = Reply::create([
            'comment_id' => $request->get('comment_id'),
            'content' => $request->get('content'),
            'title' => $request->get('title'),
            'user_id' => $user->id
        ]);


        return response($comment, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $reply = Reply::where(['user_id' => $user->id , 'id' => $id])->first(); // make sure the post belongs to the user

        //$post = Post::with('comments')->find(['user_id' => $user->id , 'id' => $id]);
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'string'
        ]);

        $reply->update($data);

        return response($reply, 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = $request->user();
        $reply = Reply::where(['user_id' => $user->id , 'id' => $id])->first(); // make sure the reply belongs to the user
        $reply->delete();
        return response('', 204);
    }
}
