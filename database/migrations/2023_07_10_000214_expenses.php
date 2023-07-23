<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        //
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->enum('type_expense', [
                'FOLHA DE PAGAMENTO',
                'MATERIAL PERMANENTE',
                'MATERIAL DE CONSUMO',
                'SERVIÇOS',
                'IMPOSTO',
            ]);
            $table->enum('type', [
                'CONTRATAÇÃO',
                'RENOVAÇÃO',
            ])->nullable();
            $table->string('description');
            $table->string('justification')->nullable();
            $table->enum('unit_measurement', [
                'UNIDADE',
                'MÊS',
                'SERVIÇO',
                'HORA',
                'DIA',
            ]);
            $table->decimal('installments', 10, 2)->default(1);
            $table->decimal('installment_value', 15, 2);
            $table->decimal('total_contract_value', 15, 2); //12
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
                '12',
            ])->nullable(); //9
            $table->decimal('previous_residual', 15, 2)->default(0.00); //9
            $table->decimal('margin', 3, 2)->default(0.00); //25
            $table->decimal('new_installment_value', 15, 2); //1,25
            $table->decimal('renovation', 15, 2)->default(0.00); //1,25 * 3 = 3,75
            $table->decimal('current_budget', 15, 2); //12,75
            $table->decimal('residual', 15, 2)->default(0.00); // 33,75
            $table->unsignedBigInteger('expense_element_id');
            $table->unsignedBigInteger('accounting_year_id');
            $table->timestamps();
            $table->foreign('expense_element_id')
                ->references('id')
                ->on('expense_elements')
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
    public function down(): void {
        //
        Schema::dropIfExists('expenses');
    }
};
