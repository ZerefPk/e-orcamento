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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('cod')->unique();
            $table->string('description');
            $table->unsignedBigInteger('budget_unit_id');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('budget_unit_id')
                ->references('id')
                ->on('budget_units')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        //
        Schema::dropIfExists('projects');
    }
};
