<?php

namespace Database\Factories;

use App\Models\Dictionary;
use App\Models\RnsuCategoryGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class RnsuCategoryGroupFactory extends Factory
{
    protected $model = RnsuCategoryGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => fake()->name(),
            'image_path' => 'https://picsum.photos/40/40',
            'rnsu_ids' => fake()->randomElements(Dictionary::where('category_id', 9)->pluck('id'), 2),
        ];
    }
}
