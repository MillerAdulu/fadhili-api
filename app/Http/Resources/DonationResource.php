<?php
  
  namespace App\Http\Resources;
  
  use Illuminate\Http\Resources\Json\JsonResource;
  
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
      return [
        'donationId' => $this->id,
        'donationName' => $this->name,
        'donationPrice' => $this->price,
        'donationDestination' => $this->destination,
        'createdAt' => (string) $this->created_at,
        'updatedAt' => (string) $this->updated_at
      ];
    }
  }
