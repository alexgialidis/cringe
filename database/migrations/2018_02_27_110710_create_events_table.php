<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('provider_id')->unsigned();
            $table->string('title');
            $table->date('date');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->integer('min_age');
            $table->integer('max_age');
            $table->string('category');
            $table->integer('sold');
            $table->integer('availability');
            $table->string('city');
            $table->string('address');
            $table->string('number');
            $table->string('zip');
            $table->decimal('lat', 9, 6);
            $table->decimal('long', 9, 6);
            $table->integer('views_guests');
            $table->integer('views_humans');
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
        Schema::dropIfExists('events');
    }
}
