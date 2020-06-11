<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'navn' => $this->name,
            'epost' => $this->email,
            'har_arkade_v1_erfaring' => $this->has_arkade_v1_experience,
            'onsker_nyheter' => $this->wants_news,
            'links' => [
                'self' => route('user', $this->id),
                'parent' => route('users'),
            ],
        ];
    }
}
