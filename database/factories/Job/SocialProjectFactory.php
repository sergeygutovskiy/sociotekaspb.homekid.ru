<?php

namespace Database\Factories\Job;

use App\Models\Dictionary;
use App\Models\Job\Variant\SocialProject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job\SocialProject>
 */
class SocialProjectFactory extends Factory
{
    protected $model = SocialProject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'participant' => fake()->randomElement([ [ 'description' => fake()->paragraph() ], null ]),
            'implementation_period' => fake()->sentence(),
            'implementation_level_id' => fake()->randomElement(Dictionary::where('category_id', 8)->pluck('id')),
            'public_work_ids' => fake()->randomElements(Dictionary::where('category_id', 10)->pluck('id'), 2),
            'service_type_ids' => fake()->randomElements(Dictionary::where('category_id', 11)->pluck('id'), 2),
            'service_name_ids' => fake()->randomElements(Dictionary::where('category_id', 12)->pluck('id'), 2),
            'need_recognition_ids' => fake()->randomElements(Dictionary::where('category_id', 13)->pluck('id'), 2),
        ];
    }
}
