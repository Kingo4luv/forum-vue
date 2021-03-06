<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use App\Inspections\Spam;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(15);
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
    public function store($channelid, Thread $thread, Spam $spam)
    {
        try{
            $this->validate(request(),[
                'body' => 'required'
            ]);

            $spam->detect(request('body'));
            $reply = $thread->addReply([

                'body' => request('body'),
                'user_id'    => auth()->id()

            ]);



        }catch (\Exception $e){
            return response('Sorry, your reply could not be saved at this time.', 422);

        }

        return $reply->load('user');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply, Spam $spam)
    {
        try{
            $this->authorize('update', $reply);

            $spam->detect(request('body'));

        }catch (\Exception $e){
            return response('Sorry, your reply could not be saved at this time.', 422);

        }

        $reply->update(['body'=> $request->body]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if(request()->expectsJson()){
            return response(['status' => 'Reply deleted']);
        }

        return back()->with('flash','Your reply has been deleted');

    }
}
