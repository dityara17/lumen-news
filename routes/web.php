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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// category
$router->post('insert-category','CategoryController@store');
$router->get('get-category','CategoryController@getAllCategories');


//post

$router->get('get-post','PostController@getPosts');
$router->get('get-post/{id}','PostController@getPost');
$router->delete('delete-post/{id}','PostController@destoryPosts');
$router->post('insert-post','PostController@store');
$router->put('edit-post/{id}','PostController@update');
