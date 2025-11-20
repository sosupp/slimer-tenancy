<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('landlords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type')->nullable();
            $table->string('status')->default('active');
            $table->integer('logged_in')->default(0);
            $table->string('telegram_id')->nullable();
            $table->string('telegram_token')->nullable();
            $table->rememberToken();
            $table->timestamp('default_pass_reset_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('landlords_password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('landlords');
        Schema::dropIfExists('landlords_password_reset_tokens');
    }
};