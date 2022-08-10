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
            'results_in_journal' => fake()->randomElement([
                [ 'description' => fake()->paragraph(), 'link' => fake()->url() ],
                null,
            ]),
            'results_of_various_events' => fake()->randomElement([
                [ 'description' => fake()->paragraph(), 'link' => fake()->url() ],
                null,
            ]),
            'results_info_in_site' => fake()->randomElement([
                [ 'description' => fake()->paragraph(), 'link' => fake()->url() ],
                null,
            ]),
            'results_info_in_media' => fake()->randomElement([
                [ 'description' => fake()->paragraph(), 'link' => fake()->url() ],
                null,
            ]),
            'results_seminars' => fake()->randomElement([
                [ 'description' => fake()->paragraph(), 'link' => fake()->url() ],
                null,
            ]),
        ];
    }
}
