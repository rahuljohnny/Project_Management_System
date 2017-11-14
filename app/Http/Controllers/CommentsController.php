<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(),[ //It validates if title and body is set properly
            'body' => 'required',
            //'commentable_id' => 'required',
            //'commentable_type' => 'required'
            //'user_id' => auth()->id()

        ]);

        //dd($request->all());

        if(Auth::check()) { //Must be logged in
            $post = new Comment;
            $post->body = request('body');
            $post->url = request('url');
            $post->user_id = auth()->id();
            $post->commentable_type = request('commentable_type');
            $post->commentable_id = request('commentable_id');


            $post->save();

            //$company = Company::create([$request->all()]);
            //$company = Company::create($request->all());



            if ($post) {
                session()->flash(
                    'message', 'Post is published!!'
                );
                return redirect()->route('projects.show', ['project' => $post->commentable_id])
                    ->with('success', 'Commented!!');
            }

        }
        return back()->withInput()->with('errors','Error !!! Company could not be created!!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
