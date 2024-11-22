<?php

use App\Models\StatusOrder;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('phone');
            $table->string('address');
            $table->text('note');
            $table->boolean('payment_method')->comment("0:thanh toán sau khi nhận hàng; 1 :Thanh toán onlline");
            $table->decimal('total');
            $table->foreignIdFor(StatusOrder::class)->constrained()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
