<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\PostCollection
     */
    public function index()
    {
        return new PostCollection(
            PostResource::collection(
                Post::all()
            )
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\PostResource
     */
    public function show($id)
    {
        return new PostResource(
            Post::findOrFail($id)
        );
    }

}
