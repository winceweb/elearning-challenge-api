<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	public function up()
	{
		Schema::create('User', function(Blueprint $table) {
			$table->integer('idUser', true);
			$table->string('name', 50);
			$table->string('email', 250)->unique();;
			$table->integer('image')->unsigned();
			$table->string('password', 250);
			$table->boolean('isTeacher');
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('User');
	}
}
