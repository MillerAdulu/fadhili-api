<?php
  
  namespace App\Http\Controllers;
  use App\Comment;
  use App\Http\Resources\CommentCollection;
  use App\Http\Resources\CommentResource;
  use Illuminate\Http\Request;

  class CommentController extends Controller
  {
    public function index($post_id) {
      return new CommentCollection(
        CommentResource::collection(
          Comment::where('post_id', $post_id)->get()
        )
      );
    }
    
    public function comment(Request $request) {
      
      $request->validate([
        'donorId' => 'required',
        'postId' => 'required',
        'commentBody' => 'required'
      ]);
      
      $comment = new Comment;
      
      $comment->donor_id = $request->donorId;
      $comment->post_id = $request->postId;
      $comment->comment = $request->commentBody;
      
      $comment->save();
      
      return new CommentResource(
        $comment
      );
    }
  }
