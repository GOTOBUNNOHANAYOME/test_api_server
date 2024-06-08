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
        Schema::create('quants_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->integer('status');
            $table->string('refresh_token')->nullable();
            $table->timestamp('refresh_token_expired_at')->nullable();
            $table->string('id_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quants_methods');
    }
};
