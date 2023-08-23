<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addComments(StoreCommentRequest $request)
    {
     $comment = $request->validated();

        // check for authenticated user
        if(!Auth::check())
        {
            return response([
                'error'=>'Not Authenticated',
                'success'=>false
            ],304);
        }

        // add authenticated user to the associative array
        $comment += ['users_id'=>Auth::user()->id, 'created_at'=>now(), 'updated_at'=>now()];
     try{
        $insertComment = Comment::insert($comment);

        return response([
            'success'=>true,
            'rsponse'=>$insertComment,
        ],200);
     }catch(\Throwable $e){
       return $e->getMessage();
     }


    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
