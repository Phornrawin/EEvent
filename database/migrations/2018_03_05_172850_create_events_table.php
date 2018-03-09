<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->unsignedInteger('organizer_id');
            $table->string('detail');
            $table->string('precondition', 128)->nullable();
            $table->string('location', 86);
            $table->string('code')->unique();
            $table->string('category', 32);
            $table->float('price')->default(0);
            $table->dateTime('payment_time');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('cur_capacity')->default(0);
            $table->integer('max_capacity');
            $table->string('image_path')->default('default.jpg');
            $table->timestamps();
            $table->foreign('organizer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
