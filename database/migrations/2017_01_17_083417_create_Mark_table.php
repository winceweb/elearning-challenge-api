<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarkTable extends Migration {

	public function up()
	{
		Schema::create('Mark', function(Blueprint $table) {
			$table->integer('value');
			$table->integer('idMark', true);
			$table->integer('idUser')->unsigned();
			$table->integer('idProblematic')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Mark');
	}
}
