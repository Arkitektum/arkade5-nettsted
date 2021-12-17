<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use Throwable;

class OrganizationInfoService
{
    /**
     * @param $address
     * @return string[]
     * @throws Throwable
     */
    public static function getCoordinates($address): array
    {
        $response = Http::get('https://ws.geonorge.no/adresser/v1/sok?sok=' . $address);

        if ($response->failed())
            $response->throw();

        try {
            $representationPoint = $response['adresser'][0]['representasjonspunkt'];
            $lat = $representationPoint['lat'];
            $lon = $representationPoint['lon'];
        } catch (Throwable $throwable) {
            throw new Exception("Unexpected response payload format -> " . $throwable->getMessage());
        }
        return ['lat' => $lat, 'lon' => $lon];
    }
}
