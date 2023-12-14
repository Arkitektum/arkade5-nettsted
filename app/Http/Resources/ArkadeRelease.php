<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArkadeRelease extends JsonResource
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
            'brukergrensesnitt' => $this->user_interface,
            'versjonsnummer' => $this->version_number,
            'utgivelsesdato' => $this->released_at->format("d.m.Y"),
            'deutgivelsesdato' => isset($this->dereleased_at) ? $this->dereleased_at->format("d.m.Y") : null,
            'antall_nedlastinger' => $this->downloads->count(),
            'links' => [
                'self' => route('statistics.release', $this->id),
                'parent' => route('statistics.releases'),
                'nedlastinger' => route('statistics.downloads', ['utgivelse' => $this->id]),
            ],
        ];
    }
}
