<?php

namespace Database\Factories\Job;

use App\Models\Dictionary;
use App\Models\Job\JobPrimaryInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PrimaryInformationFactory extends Factory
{
    protected $model = JobPrimaryInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'annotation' => fake()->paragraph(),
            'objectives' => fake()->paragraph(),
            'purpose' => fake()->paragraph(),
            'payment_method_id' => fake()->randomElement(Dictionary::where('category_id', 3)->pluck('id')),
            'partnership' => [ 'description' => fake()->paragraph() ],
            'volunteer_id' => fake()->randomElement(Dictionary::where('category_id', 4)->pluck('id')),
            'needy_category_ids' => fake()->randomElements(Dictionary::where('category_id', 5)->pluck('id'), 2),
            'needy_category_target_group_ids' => fake()->randomElements(Dictionary::where('category_id', 6)->pluck('id'), 2),
            'social_service_ids' => fake()->randomElements(Dictionary::where('category_id', 7)->pluck('id'), 2),
            'rnsu_category_ids' => fake()->randomElements(Dictionary::where('category_id', 9)->pluck('id'), 2),
            'qualitative_results' => fake()->sentence(),
            'social_results' => fake()->sentence(),
            'replicability' => fake()->randomElement([ fake()->sentence(), null ]),
            'approbation' => fake()->randomElement([ [ 'description' => fake()->paragraph() ], null ]),
            'expert_opinion' => fake()->randomElement([ [ 'description' => fake()->paragraph() ], null ]),
            'review' => fake()->randomElement([ [ 'description' => fake()->paragraph() ], null ]),
            'comment' => fake()->randomElement([ [ 'description' => fake()->paragraph() ], null ]),
            'video' => fake()->url(),
            'required_resources_description' => fake()->sentence(),
            'photo_file_id' => null,
            'gallery_file_ids' => [],
            'is_best_practice' => fake()->boolean(),
            'is_remote_format_possible' => fake()->boolean(),
        ];
    }
}
