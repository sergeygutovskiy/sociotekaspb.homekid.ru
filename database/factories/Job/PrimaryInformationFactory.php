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
            'payment_method_id' => Dictionary::firstWhere('category_id', 3)->id,
            'partnership' => [ 'description' => fake()->paragraph() ],
            'volunteer_id' => Dictionary::firstWhere('category_id', 4)->id,
            'needy_category_ids' => Dictionary::where('category_id', 6)->take(2)->get()->pluck('id')->toArray(),
            'needy_category_target_group_ids' => Dictionary::where('category_id', 6)->take(2)->get()->pluck('id')->toArray(),
            'social_service_ids' => Dictionary::where('category_id', 7)->take(2)->get()->pluck('id')->toArray(),
            'qualitative_results' => fake()->sentence(),
            'social_results' => fake()->sentence(),
            'replicability' => fake()->sentence(),
            'approbation' => [ 'description' => fake()->paragraph() ],
            'expert_opinion' => [ 'description' => fake()->paragraph() ],
            'review' => [ 'description' => fake()->paragraph() ],
            'comment' => [ 'description' => fake()->paragraph() ],
            'video' => fake()->url(),
            'required_resources_description' => fake()->sentence(),
            'photo_file_id' => null,
            'gallery_file_ids' => [],
            'is_best_practice' => true,
            'is_remote_format_possible' => false,
        ];
    }
}
