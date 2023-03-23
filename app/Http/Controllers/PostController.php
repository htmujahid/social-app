<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostMedia;
use App\Models\PostReact;
use App\Models\PostStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $post = Post::create(
                [
                    'content' => $request->input('content'),
                    'user_id' => $request->user()->id,
                ]
            );


            if ($request->hasFile('media')) {
                $files = $request->file('media');
        
                foreach ($files as $file) {
                    $path = $file->store('posts', 'public');
        
                    PostMedia::create(
                        [
                            'post_id' => $post->id,
                            'path' => $path,
                        ]
                    );
                }
            }

        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * add a react to the specified resource.
     */
    public function react(Request $request, string $id)
    {
        PostReact::create(
            [
                'post_id' => $id,
                'user_id' => $request->user()->id,
                'type' => $request->input('type'),
            ]
        );
    }

    /**
     * remove a react from the specified resource.
     */
    public function unreact(Request $request, string $id)
    {
        PostReact::where('post_id', $id)->where('user_id', $request->user()->id)->delete();
    }
    
    /**
     * add a stat to the specified resource.
     */
    public function stat(Request $request, string $id)
    {

        PostStat::create(
            [
                'post_id' => $id,
                'user_id' => $request->user()->id,
            ]
        );
    }
}
