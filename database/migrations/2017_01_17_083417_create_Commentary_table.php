<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentaryTable extends Migration {

	public function up()
	{
		Schema::create('Commentary', function(Blueprint $table) {
			$table->integer('idCommentary', true);
			$table->text('description');
			$table->integer('idProblematic')->unsigned();
			$table->integer('idUser')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Commentary');
	}
}
