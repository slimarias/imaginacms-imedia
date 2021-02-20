<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Storage;

/** @var Router $router */
$router->group(['prefix' => '/storage','middleware' => ['logged.in']], function (Router $router) {

  $router->get('/assets/media/{criteria}', [
    'as' => 'public.media.media.show',
    'uses' => 'Frontend\MediaController@show'
  ]);
  
});
/*
$router->get('storage/assets/media/{path}',[
    'as' => 'public.media.media.show',
    'uses' => 'Frontend\MediaController@show',
]);*/
