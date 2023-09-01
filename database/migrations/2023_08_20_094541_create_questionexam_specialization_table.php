<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionexam_specialization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id')->references('id')->on('specializations');
            $table->unsignedBigInteger('questionexam_id');
            $table->foreign('questionexam_id')->references('id')->on('questionexams');
            $table->date('date');
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
        Schema::dropIfExists('questionexam_specialization');
    }
};
