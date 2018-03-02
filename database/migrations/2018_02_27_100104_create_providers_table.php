<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('surname');
            $table->string('company');

            $table->string('afm');
            
            $table->string('city');
            $table->string('address');
            $table->string('number');
            $table->string('zip');

            $table->decimal('lat', 9, 6); 
            $table->decimal('long', 9, 6);

            $table->boolean('lock');

            $table->rememberToken();
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
        Schema::drop('providers');
    }
}
