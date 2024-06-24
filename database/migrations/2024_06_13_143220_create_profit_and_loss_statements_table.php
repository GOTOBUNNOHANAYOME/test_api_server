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
        Schema::create('profit_and_loss_statements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained();
            $table->integer('net_sales')->comment('NetSales');
            $table->integer('operating_profit')->comment('OperatingProfit');
            $table->integer('ordinary_profit')->comment('OrdinaryProfit');
            $table->integer('profit')->comment('Profit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profit_and_loss_statements');
    }
};
