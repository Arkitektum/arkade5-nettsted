<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ArkadeRelease as ArkadeReleaseResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Organization as OrganizationResource;

class ArkadeDownload extends JsonResource
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
            'nedlastingstidspunkt' => $this->downloaded_at->format("d.m.Y H:i"),
            'arkadeutgivelse' => new ArkadeReleaseResource($this->arkadeRelease),
            'bruker' => new UserResource($this->user),
            'organisasjon' => new OrganizationResource($this->organization),
            'links' => [
                'self' => route('download', $this->id),
                'parent' => route('downloads'),
            ],
        ];
    }
}
