<?php

namespace Database\Factories\Job;

use App\Models\Job\JobReportingPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReportingPeriodFactory extends Factory
{
    protected $model = JobReportingPeriod::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'total' => fake()->randomDigitNotZero(),
            'year' => fake()->year(),
            'families' => fake()->randomDigitNotZero(),
            'children' => fake()->randomDigitNotZero(),
            'men' => fake()->randomDigitNotZero(),
            'women' => fake()->randomDigitNotZero(),
        ];
    }
}
