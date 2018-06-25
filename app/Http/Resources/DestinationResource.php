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
          'id' => $this->id,
          'name' => $this->name,
          'crisis' => $this->crisis,
          'location' => $this->location,
          'createdAt' => (string) $this->created_at,
          'updatedAt' => (string) $this->updated_at
        ];
    }
}
