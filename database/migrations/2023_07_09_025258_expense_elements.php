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
        Schema::create('expense_elements', function(Blueprint $table){
            $table->id();
            $table->string('cod');
            $table->string('description');
            $table->unsignedBigInteger('financial_account_id');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('financial_account_id')
                ->references('id')
                ->on('financial_accounts')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('expense_elements');
    }
};
