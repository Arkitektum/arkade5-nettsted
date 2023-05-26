<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ArkadeRelease as ArkadeReleaseResource;
use App\Http\Resources\ArkadeDownloader as ArkadeDownloaderResource;
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
            'er_automatisert' => $this->is_automated,
            'arkadenedlaster' => new ArkadeDownloaderResource($this->arkadeDownloader),
            'organisasjon' => new OrganizationResource($this->organization),
            'arkadeutgivelse' => new ArkadeReleaseResource($this->arkadeRelease),
//            'links' => [
//                'self' => route('statistics.download', $this->id),
//                'parent' => route('statistics.downloads'),
//            ],
        ];
    }
}
