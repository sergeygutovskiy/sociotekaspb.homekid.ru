<?php

namespace Database\Factories\Job;

use App\Models\Dictionary;
use App\Models\Job\SocialProject;
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
            'participant' => [ 'description' => fake()->paragraph() ],
            'implementation_period' => fake()->sentence(),
            'implementation_level_id' => Dictionary::firstWhere('category_id', 8)->id,
            'rnsu_category_ids' => Dictionary::where('category_id', 9)->take(2)->get()->pluck('id')->toArray(),
            'public_work_ids' => Dictionary::where('category_id', 10)->take(2)->get()->pluck('id')->toArray(),
            'service_type_ids' => Dictionary::where('category_id', 11)->take(2)->get()->pluck('id')->toArray(),
            'service_name_ids' => Dictionary::where('category_id', 12)->take(2)->get()->pluck('id')->toArray(),
            'need_recognition_ids' => Dictionary::where('category_id', 13)->take(2)->get()->pluck('id')->toArray(),
        ];
    }
}
