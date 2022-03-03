<?php

namespace Database\Seeders;

use App\Models\AidCenter;
use Illuminate\Database\Seeder;

class AidCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requried = "\n\xF0\x9F\x91\x89Теплые куртки, мужская одежда, свитера, носки;\n" .
            "\xF0\x9F\x91\x89Одеяла, матрассаы, карематы, спальные мешки;\n" .
            "\xF0\x9F\x91\x89Полотенца;\n" .
    "\xF0\x9F\x91\x89Медикаменты;\n" .
            "\xF0\x9F\x91\x89Консервы, крупы, чай пакетированный, кофе, сахар.";
        $time = 'Время работы (ориентировочно): ежедневно, с 10:00 до 16:00';

        AidCenter::query()->truncate();

        AidCenter::query()->create([
            'city' => 'г.Донецк',
            'region' => null,
            'address' => 'ул. Красноармейская, 75',
            'phone' => null,
            'required' => $requried,
            'description' => 'Здание "Театр на Садовом" #ДепОперштаб\n' . $time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Донецк',
            'region' => null,
            'address' => 'ул. Артема, 127',
            'phone' => '071-319-97-11',
            'required' => $requried,
            'description' => 'Центр медаиапроектов Звезда\n' . $time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Донецк',
            'region' => null,
            'address' => 'ул. пр. Богдана Хмельницкого, 102',
            'phone' => '071-504-36-06',
            'required' => $requried,
            'description' =>'Кабинет 512\n'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Макеевка',
            'region' => null,
            'address' => 'ул. Кирова, 1а',
            'phone' => '071-308-04-96',
            'required' => $requried,
            'description' =>'зал МПТУ'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Горловк',
            'region' => null,
            'address' => 'мобильный пункт',
            'phone' => '071-330-19-67',
            'required' => $requried,
            'description' =>$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Горловк',
            'region' => null,
            'address' => null,
            'phone' => '071-330-19-67',
            'required' => $requried,
            'description' =>'мобильный пункт\n'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Дебальцево',
            'region' => null,
            'address' => null,
            'phone' => null,
            'required' => $requried,
            'description' =>'Здание администрации г. Дебальцево\n'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Енакиево',
            'region' => null,
            'address' => 'пр. Ленина, 99',
            'phone' => '071-482-26-32',
            'required' => $requried,
            'description' =>$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Зугрес',
            'region' => null,
            'address' => 'пр. Ленина, 8-А',
            'phone' => '071-482-26-34',
            'required' => $requried,
            'description' =>'Дворецк Культуры\n'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Харцызск',
            'region' => null,
            'address' => null,
            'phone' => null,
            'required' => $requried,
            'description' =>'здание Администрации г. Харцызска\n'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Снежное',
            'region' => 'пгт. Северное',
            'address' => 'ул. Минская',
            'phone' => '071-311-85-33',
            'required' => $requried,
            'description' =>'Северная поселковая администрация\n'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'пгт.Тельманова',
            'region' => 'Тельмановский район',
            'address' => null,
            'phone' => null,
            'required' => $requried,
            'description' =>'здание Администрации Тельмановского района\n'.$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Торез',
            'region' => null,
            'address' => 'ул. Пионерская, 1',
            'phone' => '071-482-26-49',
            'required' => $requried,
            'description' =>$time,
        ]);

        AidCenter::query()->create([
            'city' => 'г.Углегорск',
            'region' => null,
            'address' => 'ул. Тркторная, 25',
            'phone' => '071-372-56-72, 071-482-26-38',
            'required' => $requried,
            'description' =>'Здание ЦКиД\n'.$time,
        ]);
    }
}
