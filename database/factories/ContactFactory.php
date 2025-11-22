<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'name' => fake()->lastName(),
            'first_name' => fake()->optional()->firstName(),
            'email' => fake()->optional()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'position' => fake()->optional()->randomElement([
                'CEO',
                'CTO',
                'CFO',
                'Marketing Manager',
                'Project Manager',
                'Sales Director',
                'Operations Manager',
                'HR Manager',
                'Developer',
                'Designer',
                'Accountant',
                'Secretary',
            ]),
            'is_primary' => fake()->boolean(20), // 20% chance of being primary
            'notes' => fake()->optional()->text(200),
        ];
    }

    /**
     * Indicate that the contact is primary.
     */
    public function primary(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_primary' => true,
        ]);
    }
}
