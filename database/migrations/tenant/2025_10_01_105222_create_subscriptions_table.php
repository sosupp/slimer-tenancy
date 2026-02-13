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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('plan_id');
            $table->string('reference')->nullable();
            $table->decimal('amount');
            $table->string('status')->default('active');
            $table->string('payment_method');
            $table->string('payment_provider');
            $table->string('payment_provider_reference')->nullable();
            $table->string('payment_provider_status')->nullable();
            $table->string('payment_provider_channel')->nullable();
            $table->decimal('payment_provider_fee')->default(0);
            $table->string('payment_status')->default('pending');
            $table->json('extras')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('start_date')->default(now());
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
