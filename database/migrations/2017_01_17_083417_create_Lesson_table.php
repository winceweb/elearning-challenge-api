<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLessonTable extends Migration {

	public function up()
	{
		Schema::create('Lesson', function(Blueprint $table) {
			$table->integer('idLesson', true);
			$table->datetime('endDate');
			$table->datetime('startDate');
			$table->string('subject', 255);
			$table->text('content');
			$table->integer('idUser')->unsigned();
			$table->integer('idCategory')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Lesson');
	}
}
