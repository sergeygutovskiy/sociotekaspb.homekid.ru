<?php

namespace Database\Factories\Job\Variant;

use App\Models\Dictionary;
use App\Models\Job\Variant\EduProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job\Variant\EduProgram>
 */
class EduProgramFactory extends Factory
{
    protected $model = EduProgram::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'direction_id' => fake()->randomElement(Dictionary::where('category_id', 14)->pluck('id')),
            'conducting_classes_form_id' => fake()->randomElement(Dictionary::where('category_id', 15)->pluck('id')),
        ];
    }
}
