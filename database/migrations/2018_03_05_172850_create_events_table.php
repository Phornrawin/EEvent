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
            $table->longText('detail');
            $table->string('precondition', 128)->default('');
            $table->string('location', 200);
            $table->string('code')->unique();
            $table->unsignedInteger('category_id');
            $table->float('price')->default(0);
            $table->dateTime('payment_time');
            $table->dateTime('start_time');
            $table->integer('cur_capacity')->default(0);
            $table->integer('max_capacity')->default(12);
            $table->string('image_path')->nullable();
            $table->timestamps();
            $table->foreign('organizer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
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
