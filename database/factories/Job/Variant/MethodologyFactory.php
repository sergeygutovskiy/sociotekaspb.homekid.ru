<?php

namespace Database\Factories\Job\Variant;

use App\Models\Dictionary;
use App\Models\Job\Variant\Methodology;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job\Variant\EduProgram>
 */
class MethodologyFactory extends Factory
{
    protected $model = Methodology::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'direction_id' => fake()->randomElement(Dictionary::where('category_id', 14)->pluck('id')),
          'prevalence_id' => fake()->randomElement(Dictionary::where('category_id', 17)->pluck('id')),
          'activity_organization_form_id' => fake()->randomElement(Dictionary::where('category_id', 18)->pluck('id')),
          'application_period_id' => fake()->randomElement(Dictionary::where('category_id', 19)->pluck('id')),
          'authors' => fake()->randomElement([ fake()->paragraph(), null ]),
          'effectiveness_study' => fake()->randomElement([ fake()->paragraph(), null ]),
          'effectiveness_study_link' => fake()->randomElement([ fake()->url(), null ]),
          'realized_cycles' => fake()->paragraph(),
          'cycle_duration' => fake()->paragraph(),
        ];
    }
}
