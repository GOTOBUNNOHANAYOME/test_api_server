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
        Schema::create('cash_flow_statements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained();
            $table->integer('operating')->comment('CashFlowsFromOperatingActivities');
            $table->integer('investing')->comment('CashFlowsFromInvestingActivities');
            $table->integer('financing')->comment('CashFlowsFromFinancingActivities');
            $table->integer('cash')->comment('CashAndEquivalents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_flow_statements');
    }
};
