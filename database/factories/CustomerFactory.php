<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->lastName(),
            'first_name' => fake()->optional()->firstName(),
            'email' => fake()->optional()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'company_name' => fake()->optional()->company(),
            'address' => fake()->optional()->address(),
            'website' => fake()->optional()->url(),
            'activity' => fake()->optional()->randomElement([
                'IT Services',
                'Web Development',
                'E-commerce',
                'Marketing',
                'Consulting',
                'Real Estate',
                'Healthcare',
                'Education',
                'Finance',
                'Retail',
                'Manufacturing',
                'Hospitality',
                'Legal Services',
                'Architecture',
                'Engineering',
            ]),
            'additional_info' => fake()->optional()->text(500),
        ];
    }
}
