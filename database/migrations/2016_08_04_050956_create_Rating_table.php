<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value')->unsigned();
            $table->integer('rateable_id')->unsigned();
            $table->integer('idUser')->unsigned();
            $table->string('rateable_type');
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
        Schema::drop('Rating');
    }
}
