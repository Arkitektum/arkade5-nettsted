<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArkadeDownloader extends JsonResource
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
            'epost' => $this->email,
            'har_arkade_v1_erfaring' => $this->has_arkade_v1_experience ? 'Ja' : '',
            'onsker_nyheter' => $this->wants_news ? 'Ja' : '',
            'antall_nedlastinger' => $this->downloads->count(),
//            'links' => [
//                'self' => route('statistics.downloader', $this->id),
//                'parent' => route('statistics.downloaders'),
//            ],
        ];
    }
}
