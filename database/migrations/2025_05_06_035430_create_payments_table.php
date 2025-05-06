<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('vnp_TxnRef')->unique(); // Mã tham chiếu của giao dịch tại hệ thống của merchant (chính là unique code của order)
            $table->integer('vnp_Amount'); // Số tiền thanh toán
            $table->string('vnp_ResponseCode')->nullable(); // Mã phản hồi kết quả thanh toán của VNPAY
            $table->string('vnp_TransactionNo')->nullable(); // Mã giao dịch ghi nhận tại của VNPAY
            $table->string('vnp_BankCode')->nullable(); // Mã phương thức thanh toán của VNPAY
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
