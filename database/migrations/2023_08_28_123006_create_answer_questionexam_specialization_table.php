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
        Schema::create('a_q_specialization', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_correct')->default(0);
            $table->unsignedBigInteger('answer_id');
            $table->foreign('answer_id')->references('id')->on('answers');
            $table->unsignedBigInteger('questionexam_specialization_id');
            $table->foreign('questionexam_specialization_id')->references('id')->on('questionexam_specialization');
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
        Schema::dropIfExists('answer_questionexam_specialization');
    }
};
