<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_tenant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id');
            $table->foreignId('tenant_id');
            $table->timestamps();

            $table->unique(['document_id', 'tenant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_tenant');
    }
};