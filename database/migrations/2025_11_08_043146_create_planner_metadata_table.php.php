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
        Schema::create('planner_metadata',function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');
            $table->date('date');
            $table->longText('main_focus')->nullable();
            $table->text('goals')->nullable();
            $table->text('mood')->nullable();
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
