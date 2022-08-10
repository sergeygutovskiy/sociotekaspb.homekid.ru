<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Dictionary;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone' => fake()->phoneNumber(),
            'site' => fake()->url(),
            'email' => fake()->email(),
            
            'name' => fake()->sentence(),
            'full_name' => fake()->sentence(12),

            'owner' => fake()->name(),
            'responsible' => fake()->name(),
            'responsible_phone' => fake()->phoneNumber(),

            'organization_type_id' => Dictionary::firstWhere('category_id', 1)->id,
            'district_id' => Dictionary::firstWhere('category_id', 2)->id,

            'education_license' => [
                'number' => 1,
                'date' => Carbon::now()->format('d.m.Y'),
                'type' => fake()->sentence(),
            ],
            'medical_license' => [
                'number' => 2,
                'date' => Carbon::now()->format('d.m.Y'),
            ],
            'is_has_innovative_platform' => true,
        ];
    }
}
