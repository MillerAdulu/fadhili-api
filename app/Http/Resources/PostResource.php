<?php
  
  namespace App\Http\Resources;
  
  use Illuminate\Http\Resources\Json\JsonResource;
  
  class PostResource extends JsonResource
  {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'postId' => $this->id,
        'postTitle' => $this->title,
        'postExcerpt' => $this->excerpt,
        'postBody' => $this->body,
        'postImage' => $this->image,
        'postSlug' => $this->slug,
        'createdAt' => (string) $this->created_at,
        'updatedAt' => (string) $this->updated_at
      ];
    }
  }
