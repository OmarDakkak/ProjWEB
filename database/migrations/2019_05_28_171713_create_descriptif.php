<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptifs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semestre');
            $table->string('module');
            $table->string('VH');
            $table->string('coordonnateur');
            $table->string('specialite');
            $table->string('grade');
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
        Schema::dropIfExists('descriptifs');
    }
}
