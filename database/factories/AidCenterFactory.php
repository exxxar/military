<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AidCenter;

class AidCenterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AidCenter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city' => $this->faker->city,
            'region' => $this->faker->word,
            'address' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'phone' => $this->faker->phoneNumber,
            'required' => $this->faker->text,
            'description' => $this->faker->text,
        ];
    }
}
