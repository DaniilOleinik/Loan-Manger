<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'loan_principal' => $this->faker->randomFloat(4, 1, 100000),
            'monthly_payment' => $this->faker->randomFloat(4, 1, 100000),
            'annual_rate' => 5,
            'total_payment_number' => $this->faker->randomDigitNotZero(),
            'payment_number' => 0,
        ];
    }
}
