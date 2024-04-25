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
        Schema::create('dtseries', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->float('a')->nullable();
            $table->float('c')->nullable();
            $table->float('d')->nullable();
            $table->float('e')->nullable();
            $table->float('g')->nullable();
            $table->float('h')->nullable();
            $table->float('j')->nullable();
            $table->float('k')->nullable();
            $table->float('l')->nullable();
            $table->float('m')->nullable();
            $table->string('n')->nullable();
            $table->float('p')->nullable();
            $table->float('q')->nullable();
            $table->float('r')->nullable();
            $table->string('s')->nullable();
            $table->string('t')->nullable();
            $table->float('max_flow')->nullable();
            $table->float('brass_area')->nullable();
            $table->text('Notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtseries');
    }
};
