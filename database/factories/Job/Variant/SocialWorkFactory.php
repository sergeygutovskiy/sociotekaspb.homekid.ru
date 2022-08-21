<?php

namespace Database\Factories\Job\Variant;

use App\Models\Dictionary;
use App\Models\Job\Variant\SocialWork;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job\SocialProject>
 */
class SocialWorkFactory extends Factory
{
    protected $model = SocialWork::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'program_type_id' => fake()->randomElement(Dictionary::where('category_id', 16)->pluck('id')),
            'direction_id' => fake()->randomElement(Dictionary::where('category_id', 14)->pluck('id')),
            'conducting_classes_form_id' => fake()->randomElement(Dictionary::where('category_id', 15)->pluck('id')),
            'dates_and_mode_of_study' => fake()->paragraph(),
            'public_work_ids' => fake()->randomElements(Dictionary::where('category_id', 10)->pluck('id'), 2),
            'service_type_ids' => fake()->randomElements(Dictionary::where('category_id', 11)->pluck('id'), 2),
            'service_name_ids' => fake()->randomElements(Dictionary::where('category_id', 12)->pluck('id'), 2),
        ];
    }
}
