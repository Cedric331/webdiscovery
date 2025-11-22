<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->optional()->dateTimeBetween('-6 months', '+1 month');
        $endDate = $startDate ? fake()->optional()->dateTimeBetween($startDate, '+6 months') : null;

        return [
            'customer_id' => Customer::factory(),
            'user_id' => fake()->optional()->randomElement(
                User::exists() ? User::pluck('id')->toArray() : []
            ),
            'name' => fake()->words(3, true),
            'description' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['planning', 'in_progress', 'on_hold', 'completed', 'cancelled']),
            'start_date' => $startDate?->format('Y-m-d'),
            'end_date' => $endDate?->format('Y-m-d'),
            'budget' => fake()->optional()->randomFloat(2, 1000, 100000),
            'billed_amount' => fake()->randomFloat(2, 0, 50000),
        ];
    }

    /**
     * Indicate that the project is in planning.
     */
    public function planning(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'planning',
        ]);
    }

    /**
     * Indicate that the project is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
        ]);
    }

    /**
     * Indicate that the project is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }
}
