<?php
  
  namespace App\Http\Resources;
  
  use Illuminate\Http\Resources\Json\JsonResource;
  use App\Destination;
  
  class DonationResource extends JsonResource
  {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $destinationLocation = '';
      $destinations = Destination::all();
      foreach($destinations as $destination) {
        if($this->destination == $destination->id) {
          $destinationLocation = $destination->name;
        }
      }
      return [
        'donationId' => $this->id,
        'donationName' => $this->name,
        'donationPrice' => $this->price,
        'donationDestination' => $destinationLocation,
        'donationContents' => $this->contents,
        'createdAt' => (string) $this->created_at,
        'updatedAt' => (string) $this->updated_at
      ];
    }
  }
