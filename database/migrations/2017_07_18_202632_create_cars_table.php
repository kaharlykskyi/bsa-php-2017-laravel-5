<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');

            $table->string('color')->nullable();
            $table->string('model')->nullable();
            $table->string('registration_number')->nullable();
            $table->integer('year')->nullable();
            $table->integer('mileage')->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });

        // Insert some data
        /*DB::table('cars')->insert(
            array(
                'color' => 'blue',
                'model' => 'BMW M6',
                'registration_number' => 'BMW133',
                'year' => '2016',
                'mileage' => '14612',
                'price' => '135135',
                'user_id' => null,
            )
        );*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}