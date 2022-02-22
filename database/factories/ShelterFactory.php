<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Shelter;

class ShelterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shelter::class;

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
            'lat' => $this->faker->latitude,
            'lon' => $this->faker->randomFloat(0, 0, 9999999999.),
            'balance_holder' => $this->faker->word,
            'responsible_person' => $this->faker->word,
            'capacity' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text,
        ];
    }
}
