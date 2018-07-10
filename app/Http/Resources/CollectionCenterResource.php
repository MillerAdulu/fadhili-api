<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionCenterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $coordinates_array = explode(',', $this->coordinates);
      
        return [
          'collectionCenterId' => $this->id,
          'collectionCenterName' => $this->name,
          'collectionCenterLongitude' => $coordinates_array[0],
          'collectionCenterLatitude' => $coordinates_array[1],
          'createdAt' => (string) $this->created_at,
          'updatedAt' => (string) $this->updated_at,
        ];
    }
}
