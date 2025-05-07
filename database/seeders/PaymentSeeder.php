<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        Order::truncate();
        Payment::truncate();
        User::factory()
        ->count(10)
        ->create()
        ->each(function ($user) {
            $order = $user->orders()->create(Order::factory()->make()->toArray());
    
            $remainingAmount = $order->total_amount;
            $paymentCount = rand(1, 3);
            $payments = [];
    
            for ($i = 0; $i < $paymentCount; $i++) {
                $amount = $i === $paymentCount - 1
                    ? $remainingAmount
                    : rand(0.2 * $order->total_amount, 0.6 * $remainingAmount);
    
                $remainingAmount -= $amount;
    
                // Trạng thái ngẫu nhiên
                $status = fake()->randomElement(['pending', 'success', 'failed']);
    
                $payments[] = new Payment([
                    'vnp_TxnRef' => $order->order_code . '-' . ($i + 1),
                    'vnp_Amount' => $amount,
                    'vnp_ResponseCode' => $status === 'success' ? '00' : '01',
                    'vnp_TransactionNo' => $status === 'success' ? fake()->numerify('########') : null,
                    'vnp_BankCode' => fake()->optional()->randomElement(['VCB', 'ACB', 'TCB']),
                    'status' => $status,
                ]);
            }
    
            $order->payments()->saveMany($payments);
    
            // Tính tổng tiền của các payment thành công
            $paidAmount = collect($payments)
                ->where('status', 'success')
                ->sum('vnp_Amount');
    
            // Cập nhật trạng thái đơn hàng
            if ($paidAmount >= $order->total_amount) {
                $order->status = 'complete';
            } elseif ($paidAmount > 0) {
                $order->status = 'paid';
            } else {
                $order->status = 'pending';
            }
    
            $order->save();
        });
    
    }
}
