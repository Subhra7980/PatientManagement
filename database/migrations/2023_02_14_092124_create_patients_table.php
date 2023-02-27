<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patientGenId')->unique();
            $table->string('patientFName');
            $table->string('patientMName')->nullable();
            $table->string('patientLName')->nullable();
            $table->string('patientEmailId')->unique();
            $table->string('patientContactNo')->unique();
            $table->string('patientAltContactNo')->nullable();
            $table->unsignedBigInteger('addressId')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
