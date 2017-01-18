<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryTable extends Migration {

	public function up()
	{
		Schema::create('Category', function(Blueprint $table) {
			$table->string('title', 100);
			$table->integer('idCategory', true);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Category');
	}
}
