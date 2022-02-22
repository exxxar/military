<?php

namespace App\Services;

use App\Imports\MainImport;
use App\Models\Shelter;
use Maatwebsite\Excel\Facades\Excel;
use Yandex\Geocode\Facades\YandexGeocodeFacade;

class ShelterExcelService
{
    public function importFromExcel($file) : void
    {
        $data = Excel::toArray(new MainImport(), $file);

        foreach ($data[0]  as $key => $item) {
            // headers
            if ($key == 0) {
                continue;
            }

            $city = $item[0] ?? null;
            $address = $item[2];
            $lat = $item[3] ?? 0;
            $lon = $item[4] ?? 0;

            if (!empty($city) && !empty($address) && empty($lat) && empty($lon)) {
                try {
                    $data = YandexGeocodeFacade::setQuery($city . ", " . $address)->load();
                    $lat = $data->getResponse()->getLatitude();
                    $lon = $data->getResponse()->getLongitude();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            try {
                Shelter::create([
                    'city' => $city,
                    'region' => $item[1] ?? null,
                    'address' => $address,
                    'lat' => $lat,
                    'lon' => $lon,
                    'balance_holder' => $item[5] ?? null,
                    'responsible_person' => $item[6] ?? null,
                    'capacity' => $item[7] ?? null,
                    'description' => $item[8] ?? null,
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}