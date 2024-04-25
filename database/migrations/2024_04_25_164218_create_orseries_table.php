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
        Schema::create('orseries', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->float('a')->nullable();
            $table->float('b')->nullable();
            $table->float('c')->nullable();
            $table->float('d')->nullable();
            $table->float('e')->nullable();
            $table->string('f')->nullable();
            $table->string('g')->nullable();
            $table->float('pipes_count')->nullable();
            $table->float('pipe_area')->nullable();
            $table->float('volume')->nullable();
            $table->float('pump_flow')->nullable();
            $table->float('water_consumption')->nullable();
            $table->text('Notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orseries');
    }
};
