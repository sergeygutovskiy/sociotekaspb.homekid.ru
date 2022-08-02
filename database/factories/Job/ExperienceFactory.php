<?php

namespace Database\Factories\Job;

use App\Models\Job\JobExperience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExperienceFactory extends Factory
{
    protected $model = JobExperience::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'results_in_journal' => [
                'description' => fake()->paragraph(),
                'link' => fake()->url(),
            ],
            'results_of_various_events' => [
                'description' => fake()->paragraph(),
                'link' => fake()->url(),
            ],
            'results_info_in_site' => [
                'description' => fake()->paragraph(),
                'link' => fake()->url(),
            ],
            'results_info_in_media' => [
                'description' => fake()->paragraph(),
                'link' => fake()->url(),
            ],
            'results_seminars' => [
                'description' => fake()->paragraph(),
                'link' => fake()->url(),
            ],
        ];
    }
}
