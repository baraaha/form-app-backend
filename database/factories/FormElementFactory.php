<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\FormElement;

class FormElementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormElement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'form_id' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->word,
            'label' => $this->faker->word,
            'properties' => $this->faker->text,
            'order' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
