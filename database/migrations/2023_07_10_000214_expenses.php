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
        Schema::create('expenses', function(Blueprint $table){
            $table->id();
            $table->enum('type_expense', [
                'FOLHA DE PAGAMENTO', 
                'MATERIAL PERMANENTE',
                'MATERIAL DE CONSUMO',
                'SERVIÇOS',
                'IMPOSTO',
            ]);
            $table->string('description');
            $table->string('justification')->nullable();
            $table->enum('unit_measurement', [
                'UNIDADE',
                'MÊS',
                'SERVIÇO',
                'HORA',
                'DIA'
            ]);
            $table->decimal('amount', 10, 2);
            $table->decimal('installment_value', 15, 2);
            $table->decimal('total_contract_value', 15, 2);
            $table->enum('hiring_month', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                '11',
                '12'
            ])->nullable();
            $table->enum('renewal_month', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                '11',
                '12'
            ])->nullable();
            $table->decimal('previous_residual', 15, 2)->default(0.00);
            $table->decimal('margin', 3, 2)->default(0.00);
            $table->decimal('renovation', 15, 2)->default(0.00);
            $table->decimal('new_installment', 15, 2);
            $table->decimal('current_budget', 15, 2);
            $table->decimal('residual', 15, 2)->default(0.00);
            $table->unsignedBigInteger('expense_element_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('accounting_year_id');
            $table->unsignedBigInteger('budget_unit_id');
            $table->timestamps();
            $table->foreign('expense_element_id')
                ->references('id')
                ->on('expense_elements')
                ->onDelete('restrict');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('restrict');
            $table->foreign('accounting_year_id')
                ->references('id')
                ->on('accounting_years')
                ->onDelete('restrict');
            $table->foreign('budget_unit_id')
                ->references('id')
                ->on('budget_units')
                ->onDelete('restrict');
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('expenses');
    }
};
