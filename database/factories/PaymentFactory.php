<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $order = Order::factory()->create();
        return [
            'order_id' => $order->id,
            'vnp_TxnRef' => $order->order_code,
            'vnp_Amount' => $order->total_amount,
            'vnp_ResponseCode' => $this->faker->optional()->randomElement(['00', '01', '02', '97']),
            'vnp_TransactionNo' => $this->faker->optional()->numerify('########'),
            'vnp_BankCode' => $this->faker->optional()->randomElement(['VCB', 'ACB', 'TCB']),
            'status' => $this->faker->randomElement(['pending', 'success', 'failed']),
        ];
    }
}
