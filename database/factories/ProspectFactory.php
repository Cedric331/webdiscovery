<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prospect>
 */
class ProspectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Prospect::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => fake()->optional()->randomElement(
                Customer::exists() ? Customer::pluck('id')->toArray() : []
            ),
            'name' => fake()->optional()->lastName(),
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
            'notes' => fake()->optional()->text(500),
            'status' => fake()->randomElement(['new', 'in_progress', 'qualified', 'converted', 'lost']),
            'prospect_date' => fake()->optional()->date(),
        ];
    }

    /**
     * Indicate that the prospect is converted.
     */
    public function converted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'converted',
        ]);
    }

    /**
     * Indicate that the prospect is lost.
     */
    public function lost(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'lost',
        ]);
    }

    /**
     * Indicate that the prospect is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
        ]);
    }

    /**
     * Indicate that the prospect is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }
}
