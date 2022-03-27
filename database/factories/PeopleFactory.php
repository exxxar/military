<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\People;
use App\Models\User;

class PeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'fname' => $this->faker->word,
            'sname' => $this->faker->word,
            'tname' => $this->faker->word,
            'birth' => $this->faker->word,
            'age_from' => $this->faker->word,
            'age_to' => $this->faker->word,
            'sex' => $this->faker->word,
            'photos' => '{}',
            'phone' => $this->faker->phoneNumber,
            'user_id' => User::factory(),
            'people_id' => People::factory(),
            'city' => $this->faker->city,
            'region' => $this->faker->word,
            'address' => $this->faker->word,
            'story' => $this->faker->text,
            'description' => $this->faker->text,
            'status' => $this->faker->numberBetween(-10000, 10000),
            'for' => $this->faker->numberBetween(-10000, 10000),
            'searched_from' => $this->faker->dateTime(),
            'is_active' => $this->faker->boolean,
            'deleted_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
