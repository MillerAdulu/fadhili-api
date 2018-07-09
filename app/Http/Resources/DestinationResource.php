<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
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
          'destinationId' => $this->id,
          'destinationName' => $this->name,
          'destinationCrisis' => $this->crisis,
          'destinationLocation' => $this->location,
          'createdAt' => (string) $this->created_at,
          'updatedAt' => (string) $this->updated_at
        ];
    }
}
