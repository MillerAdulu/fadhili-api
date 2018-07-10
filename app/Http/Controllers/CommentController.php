<?php
  
  namespace App\Http\Controllers;
  use App\Comment;
  use App\Http\Resources\CommentCollection;
  use App\Http\Resources\CommentResource;
  
  class CommentController extends Controller
  {
    public function index($post_id)
    {
      return new CommentCollection(
        CommentResource::collection(
          Comment::where('post_id', $post_id)->get()
        )
      );
    }
  }
