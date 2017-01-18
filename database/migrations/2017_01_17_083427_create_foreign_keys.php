<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Mark', function(Blueprint $table) {
			$table->foreign('idUser')->references('idUser')->on('User')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Mark', function(Blueprint $table) {
			$table->foreign('idLesson')->references('idLesson')->on('Lesson')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Mark', function(Blueprint $table) {
			$table->foreign('idProblematic')->references('idProblematic')->on('Problematic')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Lesson', function(Blueprint $table) {
			$table->foreign('idUser')->references('idUser')->on('User')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Lesson', function(Blueprint $table) {
			$table->foreign('idCategory')->references('idCategory')->on('Category')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Commentary', function(Blueprint $table) {
			$table->foreign('idProblematic')->references('idProblematic')->on('Problematic')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Commentary', function(Blueprint $table) {
			$table->foreign('idUser')->references('idUser')->on('User')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Problematic', function(Blueprint $table) {
			$table->foreign('idLesson')->references('idLesson')->on('Lesson')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Problematic', function(Blueprint $table) {
			$table->foreign('idUser')->references('idUser')->on('User')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('Mark', function(Blueprint $table) {
			$table->dropForeign('Mark_idUser_foreign');
		});
		Schema::table('Mark', function(Blueprint $table) {
			$table->dropForeign('Mark_idLesson_foreign');
		});
		Schema::table('Mark', function(Blueprint $table) {
			$table->dropForeign('Mark_idProblematic_foreign');
		});
		Schema::table('Lesson', function(Blueprint $table) {
			$table->dropForeign('Lesson_idUser_foreign');
		});
		Schema::table('Lesson', function(Blueprint $table) {
			$table->dropForeign('Lesson_idCategory_foreign');
		});
		Schema::table('Commentary', function(Blueprint $table) {
			$table->dropForeign('Commentary_idProblematic_foreign');
		});
		Schema::table('Commentary', function(Blueprint $table) {
			$table->dropForeign('Commentary_idUser_foreign');
		});
		Schema::table('Problematic', function(Blueprint $table) {
			$table->dropForeign('Problematic_idLesson_foreign');
		});
		Schema::table('Problematic', function(Blueprint $table) {
			$table->dropForeign('Problematic_idUser_foreign');
		});
	}
}