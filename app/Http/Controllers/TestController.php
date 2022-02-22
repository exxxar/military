<?php

namespace App\Http\Controllers;

use App\Exports\FinalExport;
use App\Imports\MainImport;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function finalImportExcel()
    {
        $data = Excel::toArray(new MainImport(), 'result.xlsx');

        foreach ($data[0]  as $key => $item) {
            if ($key == 0) {
                continue;
            }

            Shelter::create([
                'city' => $item[0],
                'region' => $item[1],
                'address' => $item[2],
                'lat' => $item[3],
                'lon' => $item[4],
                'balance_holder' => $item[5],
                'responsible_person' => $item[6],
                'capacity' => $item[7],
                'description' => $item[8],
            ]);
        }

        dd(Shelter::all()->count());
    }

    public function importExcel()
    {
        $data = Excel::toArray(new MainImport(), 'military.xlsx');

        $formattedData = [];

        array_push($formattedData, ['city', 'region', 'address', 'lat', 'lon', 'balance_holder', 'responsible_person', 'capacity', 'description']);

        foreach ($data[0] as $key => $item) {
            if ($this->isDistrict($item[0])) {
                $itemArray = ['Донецк'];
            } else {
                $itemArray = [$item[0]];
            }

            array_push($itemArray, $item[0]); // region
            array_push($itemArray, $item[3]); // address
            array_push($itemArray, "0"); // lat
            array_push($itemArray, "0"); // lon
            array_push($itemArray, $item[1]); // balance_holder
            array_push($itemArray, $item[6]); // responsible_person
            array_push($itemArray, $item[9]); // capacity
            array_push($itemArray, $item[14]); // description

            array_push($formattedData, $itemArray);
        }

        foreach ($data[1] as $key => $item) {
            if ($this->isDistrict($item[0])) {
                $itemArray = ['Донецк'];
            } else {
                $itemArray = [$item[0]];
            }

            array_push($itemArray, $item[0]); // region
            array_push($itemArray, $item[5]); // address
            array_push($itemArray, "0"); // lat
            array_push($itemArray, "0"); // lon
            array_push($itemArray, $item[2]); // balance_holder
            array_push($itemArray, $item[8]); // responsible_person
            array_push($itemArray, $item[11]); // capacity
            array_push($itemArray, $item[14]); // description

            array_push($formattedData, $itemArray);
        }

        foreach ($data[2] as $key => $item) {
            if ($item[0] == null) {
                continue;
            }

            if ($this->isDistrict($item[0])) {
                $itemArray = ['Донецк'];
            } else {
                $itemArray = [$item[0]];
            }

            array_push($itemArray, $item[0]); // region
            array_push($itemArray, $item[4]); // address
            array_push($itemArray, "0"); // lat
            array_push($itemArray, "0"); // lon
            array_push($itemArray, $item[2]); // balance_holder
            array_push($itemArray, $item[7]); // responsible_person
            array_push($itemArray, $item[10]); // capacity
            array_push($itemArray, $item[14]); // description

            array_push($formattedData, $itemArray);
        }

        foreach ($data[3] as $key => $item) {
            if ($item[0] == null) {
                continue;
            }

            if ($this->isDistrict($item[0])) {
                $itemArray = ['Донецк'];
            } else {
                $itemArray = [$item[0]];
            }

            array_push($itemArray, $item[0]); // region
            array_push($itemArray, $item[4]); // address
            array_push($itemArray, "0"); // lat
            array_push($itemArray, "0"); // lon
            array_push($itemArray, $item[1]); // balance_holder
            array_push($itemArray, $item[7]); // responsible_person
            array_push($itemArray, $item[10]); // capacity
            array_push($itemArray, $item[12]); // description

            array_push($formattedData, $itemArray);
        }

        foreach ($data[4] as $key => $item) {
            if ($item[0] == null) {
                continue;
            }

            if ($this->isDistrict($item[0])) {
                $itemArray = ['Донецк'];
            } else {
                $itemArray = [$item[0]];
            }

            array_push($itemArray, $item[0]); // region
            array_push($itemArray, $item[4]); // address
            array_push($itemArray, "0"); // lat
            array_push($itemArray, "0"); // lon
            array_push($itemArray, $item[1]); // balance_holder
            array_push($itemArray, $item[7]); // responsible_person
            array_push($itemArray, $item[10]); // capacity
            array_push($itemArray, $item[13]); // description

            array_push($formattedData, $itemArray);
        }

        foreach ($data[5] as $key => $item) {
            if ($item[0] == null) {
                continue;
            }

            if ($this->isDistrict($item[0])) {
                $itemArray = ['Донецк'];
            } else {
                $itemArray = [$item[0]];
            }

            array_push($itemArray, $item[0]); // region
            array_push($itemArray, $item[4]); // address
            array_push($itemArray, "0"); // lat
            array_push($itemArray, "0"); // lon
            array_push($itemArray, $item[1]); // balance_holder
            array_push($itemArray, $item[7]); // responsible_person
            array_push($itemArray, $item[10]); // capacity
            array_push($itemArray, $item[12]); // description

            array_push($formattedData, $itemArray);
        }

        foreach ($data[6] as $key => $item) {
            if ($item[0] == null) {
                continue;
            }

            if ($this->isDistrict($item[0])) {
                $itemArray = ['Донецк'];
            } else {
                $itemArray = [$item[0]];
            }

            array_push($itemArray, $item[0]); // region
            array_push($itemArray, $item[4]); // address
            array_push($itemArray, "0"); // lat
            array_push($itemArray, "0"); // lon
            array_push($itemArray, $item[1]); // balance_holder
            array_push($itemArray, $item[7]); // responsible_person
            array_push($itemArray, $item[10]); // capacity
            array_push($itemArray, $item[14]); // description

            array_push($formattedData, $itemArray);
        }

        $export = new FinalExport($formattedData);
        return Excel::store($export, 'result.xlsx');
    }

    private function isDistrict($region) : bool
    {
        if (in_array($region, ["Ворошиловский", "Ленинский", "Кировский", "Киевский", "Пролетарский", "Петровский", "Куйбышевский", "Буденновский", "Калининский"])) {
            return true;
        }

        return false;
    }
}
