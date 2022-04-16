<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AnnounceQueue;

class AnnounceQueueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnnounceQueue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'text' => $this->faker->text,
            'images' => '{}',
            'need_send_at' => $this->faker->dateTime(),
            'sent_at' => $this->faker->dateTime(),
            'softdeletes' => $this->faker->word,
        ];
    }
}
