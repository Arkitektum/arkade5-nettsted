<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrganizationInfoService
{
    /**
     * @param $organization
     * @return void
     * @throws Exception
     */
    public static function setOrganizationInfo($organization): void
    {
        try {
            $organizationInfo = self::getOrganizationData($organization->org_number);
            $organization->name = $organizationInfo['name'];
            $organization->org_form = $organizationInfo['org_form'];
            $organization->address = OrganizationInfoService::assembleFullAddress(
                $organizationInfo['address']['addressLines'],
                $organizationInfo['address']['zipCode'],
                $organizationInfo['address']['place']
            );
            $organization->save();
        } catch (Throwable $throwable) {
            throw new Exception('Could not get organization data for ' . $organization->orgNumber . ' -> ' . $throwable->getMessage());
        }

        if (isset($organizationInfo['address'])) {
            try {
                $coordinates = self::getCoordinates($organizationInfo['address']);
                $organization->latitude = $coordinates['lat'];
                $organization->longitude = $coordinates['lon'];
                $organization->save();
            } catch (Throwable $throwable) {
                throw new Exception('Could not get coordinates for ' . $organization->address . ' -> ' . $throwable->getMessage());
            }
        }
    }

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
            $addressLines = $businessAddress['adresse'];
            $zipCode = $businessAddress['postnummer'];
            $place = $businessAddress['poststed'];

            $address = ['addressLines' => $addressLines, 'zipCode' => $zipCode, 'place' => $place];
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
        foreach ($address['addressLines'] as $addressLine) {

            $fullAddress = self::assembleFullAddress($addressLine, $address['zipCode'], $address['place']);
            $response = Http::get('https://ws.geonorge.no/adresser/v1/sok?sok=' . urlencode($fullAddress));

            if (isset($response['adresser']) && count($response['adresser']) == 1) {
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
        throw new Exception("Coordinates could not be determined");
    }

    /**
     * @param $addressText
     * @param $zipCode
     * @param $place
     * @return string
     */
    public static function assembleFullAddress($addressText, $zipCode, $place): string
    {
        return (is_array($addressText) ? implode(', ', $addressText) : $addressText) . ", " . $zipCode . " " . $place;
    }
}
