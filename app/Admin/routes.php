<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/users', UserController::class);
    $router->resource('/categories', CategoryController::class);
    $router->resource('/video-testimonies', VideoTestimonyController::class);
    $router->resource('/written-testimonies', WrittenTestimonyController::class);
    $router->resource('/comments', CommentController::class);

});
