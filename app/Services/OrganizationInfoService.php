<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use Throwable;

class OrganizationInfoService
{
    /**
     * @param $orgNumber
     * @return string[]
     * @throws Exception
     */
    public static function getOrganizationData($orgNumber): array
    {
        $response = Http::get('https://data.brreg.no/enhetsregisteret/api/enheter/' . $orgNumber);

        if ($response->failed())
            $response->throw();

        try {
            $name = $response['navn'];
            $orgForm = $response['organisasjonsform']['kode'];

            $businessAddress = $response['forretningsadresse'];
            $firstAddress = $businessAddress['adresse'][0];
            $zipCode = $businessAddress['postnummer'];
            $place = $businessAddress['poststed'];

            $address = $firstAddress . " " . $zipCode . " " . $place;
        } catch (Throwable $throwable) {
            throw new Exception("Unexpected response payload format -> " . $throwable->getMessage());
        }

        return ['name' => $name, 'org_form' => $orgForm, 'address' => $address];
    }

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
