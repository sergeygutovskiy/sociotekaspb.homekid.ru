<?php

namespace Database\Factories\Job\Variant;

use App\Models\Dictionary;
use App\Models\Job\Variant\Club;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job\Variant\EduProgram>
 */
class ClubFactory extends Factory
{
    protected $model = Club::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'conducting_classes_form_id' => fake()->randomElement(Dictionary::where('category_id', 15)->pluck('id')),

            'public_work_ids' => fake()->randomElements(Dictionary::where('category_id', 10)->pluck('id'), 2),
            'service_type_ids' => fake()->randomElements(Dictionary::where('category_id', 11)->pluck('id'), 2),
            'service_name_ids' => fake()->randomElements(Dictionary::where('category_id', 12)->pluck('id'), 2),
        ];
    }
}
