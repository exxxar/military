<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HumanitarianAidHistory;

class HumanitarianAidHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HumanitarianAidHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'index' => $this->faker->word,
            'full_name' => $this->faker->word,
            'passport' => $this->faker->word,
            'description' => $this->faker->text,
            'issue_at' => $this->faker->dateTime(),
            'deleted_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
