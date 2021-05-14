<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearnPathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learn_paths', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title');
            $table->string('titleEng');
            $table->string('slug');
            $table->text('description');
            $table->text('descriptionEng');
            $table->integer('price');
            $table->integer('priceOffPercent');
            $table->integer('durationHours')->default(0);
            $table->integer('durationMinutes')->default(0);
            $table->string('img')->nullable();
            $table->unsignedBigInteger('library_id')->nullable();
            $table->foreign('library_id')->on('libraries')
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
        Schema::dropIfExists('learn_paths');
    }
}
