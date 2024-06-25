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
        Schema::disableForeignKeyConstraints();

        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_id')->constrained('labs');
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->string('status');
            $table->enum('visit_type', ['home', 'lab']); // Replace 'type1' and 'type2' with actual visit types
            $table->unsignedInteger('capacity')->default(1);
            $table->unsignedInteger('current_bookings')->default(0);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
