<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblematicTable extends Migration {

	public function up()
	{
		Schema::create('Problematic', function(Blueprint $table) {
			$table->integer('idProblematic', true);
			$table->text('movieUrl');
			$table->text('caption');
			$table->string('entitled', 255);
			$table->integer('idLesson')->unsigned();
			$table->integer('idUser')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Problematic');
	}
}