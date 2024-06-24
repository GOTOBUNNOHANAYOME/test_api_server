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
            $table->bigInteger('operating')->index()->comment('CashFlowsFromOperatingActivities');
            $table->bigInteger('investing')->index()->comment('CashFlowsFromInvestingActivities');
            $table->bigInteger('financing')->index()->comment('CashFlowsFromFinancingActivities');
            $table->bigInteger('cash')->index()->comment('CashAndEquivalents');
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
