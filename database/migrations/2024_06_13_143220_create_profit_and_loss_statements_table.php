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
            $table->bigInteger('net_sales')->index()->comment('NetSales');
            $table->bigInteger('operating_profit')->index()->comment('OperatingProfit');
            $table->bigInteger('ordinary_profit')->index()->comment('OrdinaryProfit');
            $table->bigInteger('profit')->index()->comment('Profit');
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
