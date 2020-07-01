<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Organization extends JsonResource
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
            'organisasjonsform' => $this->org_form,
            'organisasjonsnummer' => $this->org_number,
            'links' => [
                'self' => route('statistics.organization', $this->id),
                'parent' => route('statistics.organizations'),
            ],
        ];
    }
}
