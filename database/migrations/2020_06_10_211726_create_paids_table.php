<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paids', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('factorId');                 // factor id
            $table->integer('type');                    // 1 == course | 2 == learn path
            $table->unsignedBigInteger('item_id');      // (course->id | learn path->id) as item_id
            $table->unsignedBigInteger('user_id');      // purchased user
            $table->bigInteger('price');                // paid price
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('paids');
    }
}
