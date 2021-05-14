<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourseLearnpath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_learn_path', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('learn_path_id');
            $table->foreign('learn_path_id')->on('learn_paths')
                ->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->on('courses')
                ->references('id')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('course_learn_path');
    }
}
