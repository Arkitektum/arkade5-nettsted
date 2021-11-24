<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationLocation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'Feature',
            'properties' => [
                'organizationName' => $this->name
            ],
            'geometry' => [
                "type" => "Point",
                "coordinates" => [$this->longitude, $this->latitude]
            ]
        ]; // GeoJson
    }
}
