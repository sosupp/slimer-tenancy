<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS landlord');

        Schema::connection('pgsql')->create('landlord.tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // or subdomain
            $table->string('key')->nullable()->unique();
            $table->string('subdomain')->nullable()->unique();
            $table->string('domain')->nullable()->unique();
            $table->string('db')  ->nullable(); // for per-db strategy
            $table->string('schema')->nullable(); // for per-schema strategy
            $table->json('meta')->nullable();
            $table->string('owner')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default('active');
            $table->boolean('is_deployed')->default(false);
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('landlord.tenants');
        DB::statement('DROP SCHEMA IF EXISTS landlord CASCADE');
    }
};
