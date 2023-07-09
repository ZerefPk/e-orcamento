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
        //
        Schema::create('predicted_units', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('budget_unit_id');
            $table->unsignedBigInteger('accounting_year_id');
            $table->decimal('expected_budget', 20,2);
            $table->integer('percentage');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('budget_unit_id')
                ->references('id')
                ->on('budget_units')
                ->onDelete('restrict');

            $table->foreign('accounting_year_id')
                ->references('id')
                ->on('accounting_years')
                ->onDelete('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
