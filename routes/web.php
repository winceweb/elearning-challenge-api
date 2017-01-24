<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', ['middleware' => 'cors', function () use ($app) {
    return $app->version();
}]);

$app->post('oauth/access_token', ['middleware' => 'cors', function() use ($app){
     return response()->json($app->make('oauth2-server.authorizer')->issueAccessToken());
}]);

$app->group(['prefix' => 'api/v1', 'middleware' => 'cors'], function($app)
{
  // Category
	$app->post('category','CategoryController@createCategory');
	$app->put('category/{id}','CategoryController@updateCategory');
	$app->delete('category/{id}','CategoryController@deleteCategory');
	$app->get('category','CategoryController@index');

  //Users
  $app->get('users', 'UserController@index');
  $app->get('getUser', 'UserController@getUser');
  $app->post('users', 'UserController@store');
  $app->get('users/{id}', 'UserController@show');
  $app->put('users/{id}', 'UserController@update');
  $app->delete('users/{id}', 'UserController@destroy');

  // Lessons
  $app->get('lesson', 'LessonController@index');
  $app->get('lesByCat/{id}', 'LessonController@byCategory');
  $app->post('lesson', 'LessonController@store');
  $app->get('lesson/{id}', 'LessonController@show');
  $app->put('lesson/{id}', 'LessonController@update');
  $app->delete('lesson/{id}', 'LessonController@destroy');

  // Problematics
  $app->get('problematic', 'ProblematicController@index');
  $app->get('problematic/{id}', 'ProblematicController@show');

  $app->get('liste/oeuvre/{$idUser}', 'UserProblematicController@index');

  //  Problematics's Lesson
  $app->get('lesson/{lesson_id}/problematic', 'LessonProblematicController@index');
  $app->post('lesson/{lesson_id}/problematic', 'LessonProblematicController@store');
  $app->put('lesson/{lesson_id}/problematic/{problematic_id}', 'LessonProblematicController@update');
  $app->delete('lesson/{lesson_id}/problematic/{problematic_id}', 'LessonProblematicController@destroy');

  // Ratings système
  $app->post('/{id}/ratings', 'LessonRatingsController@store');
  $app->delete('/{lessonId}/ratings/{ratingId}','LessonRatingsController@destroy');

});
