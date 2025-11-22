<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Meeting;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 month', '+2 months');
        $endDate = (clone $startDate)->modify('+1 hour');

        return [
            'customer_id' => fake()->optional()->randomElement(
                Customer::exists() ? Customer::pluck('id')->toArray() : []
            ),
            'prospect_id' => fake()->optional()->randomElement(
                Prospect::exists() ? Prospect::pluck('id')->toArray() : []
            ),
            'user_id' => fake()->optional()->randomElement(
                User::exists() ? User::pluck('id')->toArray() : []
            ),
            'title' => fake()->sentence(3),
            'description' => fake()->optional()->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => fake()->optional()->randomElement([
                fake()->address(),
                fake()->url(),
                'Office',
                'Client Office',
                'Video Conference',
            ]),
            'type' => fake()->randomElement(['physical', 'remote', 'hybrid']),
            'notes' => fake()->optional()->text(500),
            'is_completed' => fake()->boolean(30), // 30% chance of being completed
        ];
    }

    /**
     * Indicate that the meeting is a video call.
     */
    public function video(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'video',
            'location' => fake()->url(),
        ]);
    }

    /**
     * Indicate that the meeting is physical.
     */
    public function physical(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'physical',
            'location' => fake()->address(),
        ]);
    }

    /**
     * Indicate that the meeting is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_completed' => true,
        ]);
    }
}
