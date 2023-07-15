<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Form;

class FormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Form::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(-10000, 10000),
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'submission_limit' => $this->faker->numberBetween(-10000, 10000),
            'allow_notifications' => $this->faker->boolean,
            'published' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime(),
            'expires_at' => $this->faker->dateTime(),
        ];
    }
}
