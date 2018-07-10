<?php
  
  namespace App\Http\Resources;
  
  use App\Donor;
  use Illuminate\Http\Resources\Json\JsonResource;
  
  class CommentResource extends JsonResource
  {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      
      $donor_name = '';
      $donors = Donor::all();
      
      foreach ($donors as $donor) {
        
        if ($this->donor_id == $donor->id) {
          $donor_name = $donor->username;
        }
        
      }
      
      return [
        'commentId' => $this->id,
        'commentPostId' => $this->post_id,
        'commentDonorUserName' => $donor_name,
        'commentBody' => $this->comment,
        'createdAt' => (string) $this->created_at,
        'updatedAt' => (string) $this->updated_at
      ];
    }
  }
