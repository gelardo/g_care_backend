<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathologyBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathology_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_test_id')->constrained('book_tests')->cascadeOnDelete();
            $table->foreignId('pathology_id')->constrained('pathologies')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pathology_bookings');
    }
}
