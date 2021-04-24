<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except([ 'index', 'show' ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::latest()->get();
        return view('threads.index', compact('threads'));
    }

    public function create()
    {
        return view('threads.create');
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($channelId, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    public function store()
    {
        $thread = Thread::create([
            'user_id'    => auth()->id(),
            'channel_id' => request('channel_id'),
            'title'      => request('title'),
            'body'       => request('body')
        ]);

        return redirect($thread->path());

    }


}
