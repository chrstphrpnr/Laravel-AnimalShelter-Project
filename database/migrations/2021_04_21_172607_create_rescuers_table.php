<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescuers', function (Blueprint $table) {
            $table->id();
            $table->string('rescuer_fname');
            $table->string('Lname');
            $table->integer('Age');
            $table->string('Gender');
            $table->string('Address');
            $table->string('Contact');
            $table->string('email')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('rescuers');
    }
}


