<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title');
            $table->string('titleEng');
            $table->string('slug');
            $table->text('description');
            $table->text('descriptionEng');
            $table->date('releaseDate');
            // $table->date('updatedDate');
            $table->integer('durationHours');
            $table->integer('durationMinutes');
            $table->integer('price');
            $table->integer('priceOffPercent');
            $table->integer('views');
            $table->integer('skillLevel');
            $table->integer('partNumbers');
            $table->string('img')->nullable();
            $table->string('previewFile')->nullable();
            $table->string('previewSubtitle')->nullable();
            $table->string('courseFile')->nullable();
            $table->string('exerciseFile')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('library_id');
            $table->foreign('library_id')->on('libraries')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('courses');
    }
}
